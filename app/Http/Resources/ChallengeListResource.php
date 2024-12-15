<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChallengeListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'difficulty' => $this->difficulty,
            'category' => $this->category,
            'access_type' => $this->access_type,
            'is_accessible' => $this->is_accessible ?? false,
            'required_challenge_id' => $this->when($this->access_type === 'sequential', $this->required_challenge_id),
        ];
    }
}