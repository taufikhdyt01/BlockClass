<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SubmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'challenge_id' => 'required|exists:challenges,id',
            'xml' => 'required|string',
            'status' => 'required|in:accepted,wrong answer,runtime error',
            'score' => 'required|numeric|min:0|max:100',
            'time_spent' => 'required|integer',
            'test_results' => 'required|array',
            'test_results.*.test_case_id' => 'required|exists:test_cases,id',
            'test_results.*.passed' => 'required|boolean',
            'test_results.*.output' => 'nullable|string',
            'test_results.*.console_output' => 'nullable|string',
        ];
    }

    public function failedValidation(Validator $validator): JsonResponse
    {
        $errors = $validator->errors()->toArray();

        throw new HttpResponseException(response_failed(message: 'Validation failed', data: $errors, status: Response::HTTP_BAD_REQUEST));
    }
}
