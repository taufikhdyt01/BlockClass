<?php

namespace App\Http\Resources;

use App\Http\Helpers\SlugGenerator;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ClassResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'banner' => $this->banner ? URL::to(Storage::url($this->banner)) : null,
            'detail' => $this->detail,
            'access_code' => $this->access_code,
            'status' => $this->status,
            'total_students' => $this->users->where('role', 'user')->count(),
            'total_chapters' => $this->chapters()->count(),
            'is_enrolled' => $this->users->contains('id', auth()->id()),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}