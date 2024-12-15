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
        $classes = ClassRoom::with(['users'])
            ->when($request->search, function($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('detail', 'like', "%{$search}%");
            })
            ->when($request->status, function($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response_success(
            'Classes retrieved successfully',
            [
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
                ]
            ]
        );
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

            return response_success(
                message: 'Class created successfully',
                data: resource_collection(new ClassResource($class)),
                status: Response::HTTP_CREATED
            );
            
        } catch (\Exception $e) {
            if (isset($bannerPath) && Storage::disk('public')->exists($bannerPath)) {
                Storage::disk('public')->delete($bannerPath);
            }
            
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

            return response_success(
                message: 'Class updated successfully',
                data: resource_collection(new ClassResource($class))
            );
            
        } catch (\Exception $e) {
            if (isset($bannerPath) && Storage::disk('public')->exists($bannerPath)) {
                Storage::disk('public')->delete($bannerPath);
            }

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

            if ($class->banner && Storage::disk('public')->exists($class->banner)) {
                Storage::disk('public')->delete($class->banner);
            }

            $class->users()->detach();
            $class->delete();

            return response_success(
                message: 'Class deleted successfully',
                status: Response::HTTP_OK
            );
            
        } catch (\Exception $e) {
            return response_failed(
                message: 'Failed to delete class',
                data: ['error' => $e->getMessage()],
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}