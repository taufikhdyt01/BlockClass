<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ClassResource;
use App\Models\ClassRoom;

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
}