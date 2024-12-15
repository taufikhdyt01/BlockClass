<?php

namespace App\Http\Controllers;

use App\Http\Helpers\SlugGenerator;
use App\Http\Requests\StoreClassRequest;
use App\Http\Requests\UpdateClassRequest;
use App\Http\Resources\ClassResource;
use App\Models\ClassRoom;
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

    public function store(StoreClassRequest $request)
    {
        try {
            $validated = $request->validated();

            if ($request->hasFile('banner')) {
                $bannerPath = $request->file('banner')->store('class-banners', 'public');
                $validated['banner'] = $bannerPath;
            }

            $validated['slug'] = SlugGenerator::generateUniqueSlug($request->title, ClassRoom::class);

            $class = ClassRoom::create($validated);
            $class->load('users');

            return response_success(message: 'Class created successfully', data: resource_collection(new ClassResource($class)), status: Response::HTTP_CREATED);
        } catch (\Exception $e) {
            if (isset($bannerPath) && Storage::disk('public')->exists($bannerPath)) {
                Storage::disk('public')->delete($bannerPath);
            }

            return response_failed(message: 'Failed to create class', data: ['error' => $e->getMessage()], status: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateClassRequest $request, ClassRoom $class)
    {
        try {
            $validated = $request->validated();

            if ($request->hasFile('banner')) {
                if ($class->banner && Storage::disk('public')->exists($class->banner)) {
                    Storage::disk('public')->delete($class->banner);
                }

                $bannerPath = $request->file('banner')->store('class-banners', 'public');
                $validated['banner'] = $bannerPath;
            }

            if (isset($validated['title'])) {
                $validated['slug'] = SlugGenerator::generateUniqueSlug($validated['title'], ClassRoom::class);
            }

            $class->update($validated);
            $class->load('users');

            return response_success(message: 'Class updated successfully', data: resource_collection(new ClassResource($class)));
        } catch (\Exception $e) {
            if (isset($bannerPath) && Storage::disk('public')->exists($bannerPath)) {
                Storage::disk('public')->delete($bannerPath);
            }

            return response_failed(message: 'Failed to update class', data: ['error' => $e->getMessage()], status: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(ClassRoom $class)
    {
        try {
            if ($class->chapters()->exists()) {
                return response_failed(message: 'Unable to delete class', data: ['error' => 'Class has associated chapters. Please delete chapters first.'], status: Response::HTTP_BAD_REQUEST);
            }

            if ($class->banner && Storage::disk('public')->exists($class->banner)) {
                Storage::disk('public')->delete($class->banner);
            }

            $class->users()->detach();
            $class->delete();

            return response_success(message: 'Class deleted successfully', status: Response::HTTP_OK);
        } catch (\Exception $e) {
            return response_failed(message: 'Failed to delete class', data: ['error' => $e->getMessage()], status: Response::HTTP_INTERNAL_SERVER_ERROR);
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
}
