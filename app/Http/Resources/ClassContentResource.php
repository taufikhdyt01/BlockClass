<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassContentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'access' => $this->access,
            'order' => $this->order,
            'required_chapter_id' => $this->required_chapter_id,
            'posts' => $this->posts->map(function($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'type' => $post->type,
                    'access' => $post->access,
                    'required_post_id' => $post->required_post_id,
                    'points' => $post->points,
                    'order' => $post->order,
                ];
            }),
        ];
    }
}