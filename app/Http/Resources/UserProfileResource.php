<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this['user']->id,
            'username' => $this['user']->username,
            'name' => $this['user']->name,
            'email' => $this['user']->email,
            'avatar' => $this['user']->avatar ? $this['user']->avatar : null,
            'total_challenges' => $this['total_challenges'],
            'completed_challenges' => $this['completed_challenges'],
            'total_score' => $this['total_score'],
            'challenge_history' => $this['challenge_history']->map(function ($submission) {
                return [
                    'challenge_id' => $submission['challenge_id'],
                    'title' => $submission['title'],
                    'difficulty' => $submission['difficulty'],
                    'best_score' => $submission['best_score'],
                    'status' => $submission['status'],
                    'completed_at' => $submission['completed_at'],
                ];
            }),
        ];
    }
}