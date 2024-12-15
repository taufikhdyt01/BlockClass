<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubmissionListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'score' => $this->score,
            'time_spent' => $this->formatted_time_spent,
            'submitted_at' => $this->submitted_at->format('Y-m-d H:i:s'),
        ];
    }
}