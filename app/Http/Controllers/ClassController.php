<?php

namespace App\Http\Controllers;

use App\Http\Helpers\SlugGenerator;
use App\Http\Requests\StoreClassRequest;
use App\Http\Requests\UpdateClassRequest;
use App\Http\Resources\ClassContentResource;
use App\Http\Resources\ClassResource;
use App\Models\ClassRoom;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();

        $classes = ClassRoom::with(['users'])
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")->orWhere('detail', 'like', "%{$search}%");
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderByRaw(
                "EXISTS (
            SELECT 1 FROM user_classes
            WHERE user_classes.class_id = classes.id
            AND user_classes.user_id = ?) DESC",
                [$userId],
            )
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response_success('Classes retrieved successfully', [
            'classes' => ClassResource::collection($classes),
            'pagination' => [
                'total' => $classes->total(),
                'per_page' => $classes->perPage(),
                'current_page' => $classes->currentPage(),
                'last_page' => $classes->lastPage(),
                'from' => $classes->firstItem(),
                'to' => $classes->lastItem(),
                'next_page_url' => $classes->nextPageUrl(),
                'prev_page_url' => $classes->previousPageUrl(),
            ],
        ]);
    }

    public function show(Request $request, ClassRoom $class)
    {
        $class->load(['chapters.posts' => function($query) {
            $query->orderBy('order', 'asc');
        }]);

        $chapters = $class->chapters()->orderBy('order', 'asc')->paginate(10);
        
        $responseData = [
            'class' => [
                'id' => $class->id,
                'title' => $class->title,
                'detail' => $class->detail,
                'total_students' => $class->users()->count(),
                'total_chapters' => $class->chapters()->count()
            ],
            'chapters' => ClassContentResource::collection($chapters),
            'pagination' => [
                'total' => $chapters->total(),
                'per_page' => $chapters->perPage(),
                'current_page' => $chapters->currentPage(),
                'last_page' => $chapters->lastPage(),
                'from' => $chapters->firstItem(),
                'to' => $chapters->lastItem(),
                'next_page_url' => $chapters->nextPageUrl(),
                'prev_page_url' => $chapters->previousPageUrl(),
            ],
        ];

        return response_success('Class content retrieved successfully', $responseData);
    }

    public function store(StoreClassRequest $request)
    {
        try {
            $validated = $request->validated();

            if ($request->hasFile('banner')) {
                try {
                    $cloudinaryImage = $request->file('banner')->storeOnCloudinary('class-banners');
                    $validated['banner'] = $cloudinaryImage->getSecurePath();
                } catch (\Exception $e) {
                    \Log::error('Banner upload failed: ' . $e->getMessage());
                    return response_failed(
                        message: 'Failed to upload banner', 
                        data: ['error' => $e->getMessage()], 
                        status: Response::HTTP_INTERNAL_SERVER_ERROR
                    );
                }
            }

            $validated['slug'] = SlugGenerator::generateUniqueSlug($request->title, ClassRoom::class);

            $class = ClassRoom::create($validated);
            $class->load('users');

            return response_success(
                message: 'Class created successfully', 
                data: resource_collection(new ClassResource($class)), 
                status: Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            return response_failed(
                message: 'Failed to create class', 
                data: ['error' => $e->getMessage()], 
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function update(UpdateClassRequest $request, ClassRoom $class)
    {
        try {
            $validated = $request->validated();

            if ($request->hasFile('banner')) {
                try {
                    // Delete old banner from Cloudinary if it exists
                    if ($class->banner) {
                        $publicId = $this->getPublicIdFromUrl($class->banner);
                        if ($publicId) {
                            Cloudinary::destroy($publicId);
                        }
                    }

                    // Upload new banner
                    $cloudinaryImage = $request->file('banner')->storeOnCloudinary('class-banners');
                    $validated['banner'] = $cloudinaryImage->getSecurePath();
                } catch (\Exception $e) {
                    \Log::error('Banner update failed: ' . $e->getMessage());
                    return response_failed(
                        message: 'Failed to update banner', 
                        data: ['error' => $e->getMessage()], 
                        status: Response::HTTP_INTERNAL_SERVER_ERROR
                    );
                }
            }

            if (isset($validated['title'])) {
                $validated['slug'] = SlugGenerator::generateUniqueSlug($validated['title'], ClassRoom::class);
            }

            $class->update($validated);
            $class->load('users');

            return response_success(
                message: 'Class updated successfully', 
                data: resource_collection(new ClassResource($class))
            );
        } catch (\Exception $e) {
            return response_failed(
                message: 'Failed to update class', 
                data: ['error' => $e->getMessage()], 
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function destroy(ClassRoom $class)
    {
        try {
            if ($class->chapters()->exists()) {
                return response_failed(
                    message: 'Unable to delete class', 
                    data: ['error' => 'Class has associated chapters. Please delete chapters first.'], 
                    status: Response::HTTP_BAD_REQUEST
                );
            }

            // Delete banner from Cloudinary if it exists
            if ($class->banner) {
                $publicId = $this->getPublicIdFromUrl($class->banner);
                if ($publicId) {
                    Cloudinary::destroy($publicId);
                }
            }

            $class->users()->detach();
            $class->delete();

            return response_success(message: 'Class deleted successfully', status: Response::HTTP_OK);
        } catch (\Exception $e) {
            return response_failed(
                message: 'Failed to delete class', 
                data: ['error' => $e->getMessage()], 
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function enrollWithAccessCode(Request $request, ClassRoom $class)
    {
        try {
            $request->validate([
                'access_code' => 'required|string',
            ]);

            if ($class->status !== 'active') {
                return response_failed(message: 'This class is not active', status: Response::HTTP_BAD_REQUEST);
            }

            if ($class->access_code !== $request->access_code) {
                return response_failed(message: 'Invalid access code', status: Response::HTTP_UNAUTHORIZED);
            }

            $isEnrolled = $class->users()->where('user_id', auth()->id())->exists();

            if ($isEnrolled) {
                return response_failed(message: 'You are already enrolled in this class', status: Response::HTTP_BAD_REQUEST);
            }

            // Enroll the user
            $class->users()->attach(auth()->id());
            $class->load('users');

            return response_success(message: 'Successfully enrolled in the class', data: new ClassResource($class), status: Response::HTTP_OK);
        } catch (\Exception $e) {
            return response_failed(message: 'Failed to enroll in class', data: ['error' => $e->getMessage()], status: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Helper method to extract public ID from Cloudinary URL
     */
    private function getPublicIdFromUrl($url)
    {
        if (empty($url)) return null;
        
        // Extract the public ID from the Cloudinary URL
        // Example URL: https://res.cloudinary.com/your-cloud-name/image/upload/v1234567890/class-banners/abcdef123456
        $pattern = '/\/v\d+\/(.+)\.\w+$/';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
