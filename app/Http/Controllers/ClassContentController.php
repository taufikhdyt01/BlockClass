<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassRoom;
use App\Http\Resources\ClassContentResource;

class ClassContentController extends Controller
{
    public function index(Request $request, $slug)
    {
        $class = ClassRoom::with(['chapters.posts' => function($query) {
            $query->orderBy('order', 'asc');
        }])
        ->where('slug', $slug)
        ->firstOrFail();

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
}