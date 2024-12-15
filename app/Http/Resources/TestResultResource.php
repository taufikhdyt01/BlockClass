<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestResultResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'test_case_id' => $this->test_case_id,
            'passed' => $this->passed,
            'output' => $this->output,
            'console_output' => $this->console_output,
        ];
    }
}