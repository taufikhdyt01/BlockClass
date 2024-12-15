<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChallengeDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
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
            'required_challenge_id' => $this->when($this->access_type === 'sequential', $this->required_challenge_id),
            'function_name' => $this->function_name,
            'initial_xml' => $this->initial_xml,
            'hints' => $this->hints,
            'constraints' => $this->constraints,
            'test_cases' => TestCaseResource::collection($this->testCases)
        ];
    }
}