<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Http\Resources\MaterialResource;

class MaterialController extends Controller
{
    /**
     * Get a list of materials or a specific material by ID.
     */
    public function index(Request $request)
    {
        $materials = Material::with('files')->paginate(10);

        return response()->json([
            'message' => 'Materials retrieved successfully',
            'data' => MaterialResource::collection($materials),
            'pagination' => [
                'total' => $materials->total(),
                'per_page' => $materials->perPage(),
                'current_page' => $materials->currentPage(),
                'last_page' => $materials->lastPage(),
                'from' => $materials->firstItem(),
                'to' => $materials->lastItem(),
                'next_page_url' => $materials->nextPageUrl(),
                'prev_page_url' => $materials->previousPageUrl(),
            ],
        ]);
    }

    /**
     * Get a single material by ID.
     */
    public function show($slug)
    {
        $material = Material::with('files')->findOrFail($slug);

        return response()->json([
            'message' => 'Material retrieved successfully',
            'data' => new MaterialResource($material),
        ]);
    }
}