<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChallengeResource extends JsonResource
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
            'access_code' => $this->access_code,
            'required_challenge_id' => $this->required_challenge_id,
            'function_name' => $this->function_name,
            'initial_xml' => $this->initial_xml,
            'hints' => $this->hints,
            'constraints' => $this->constraints,
            'test_cases' => TestCaseResource::collection($this->whenLoaded('testCases')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}