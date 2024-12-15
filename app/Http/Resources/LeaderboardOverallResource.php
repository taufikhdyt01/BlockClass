<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaderboardOverallResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->username,
            'total_score' => (int)$this->total_score,
            'completed_challenges' => (int)$this->completed_challenges,
        ];
    }
}