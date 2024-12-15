<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaderboardChallengeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user->username,
            'score' => $this->score,
            'time_spent' => $this->formatted_time_spent,
            'submission_time' => $this->submission_time->format('Y-m-d H:i:s'),
        ];
    }
}