<?php

namespace App\Http\Resources;

use App\Http\Helpers\SlugGenerator;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassResource extends JsonResource
{
    public function toArray($request)
    {
        $title = $this->title ?? '';

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'banner' => $this->banner,
            'detail' => $this->detail,
            'access_code' => $this->access_code,
            'status' => $this->status,
            'total_students' => $this->users->where('role', 'student')->count(),
            'total_teachers' => $this->users->where('role', 'teacher')->count(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}