<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
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