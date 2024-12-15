<?php

namespace App\Http\Resources;

use App\Http\Helpers\SlugGenerator;
use App\Models\Material;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'slug' => SlugGenerator::generateUniqueSlug($request->title, Material::class),
            'post_id' => $this->post_id,
            'files' => $this->files->map(function ($file) {
                return [
                    'id' => $file->id,
                    'file_path' => $file->file_path,
                    'option' => $file->option,
                ];
            }),
        ];
    }
}