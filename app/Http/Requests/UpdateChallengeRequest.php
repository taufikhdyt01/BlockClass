<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class UpdateChallengeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'difficulty' => ['sometimes', 'required', Rule::in(['easy', 'medium', 'hard'])],
            'category' => 'sometimes|required|string|max:255',
            'access_type' => ['sometimes', 'required', Rule::in(['public', 'private', 'sequential'])],
            'access_code' => 'required_if:access_type,private|nullable|string|max:255',
            'required_challenge_id' => 'required_if:access_type,sequential|nullable|exists:challenges,id',
            'function_name' => 'sometimes|required|string|max:255',
            'initial_xml' => 'sometimes|required|string',
            'hints' => 'nullable|array',
            'constraints' => 'sometimes|required|array',
            'test_cases' => 'sometimes|required|array|min:1',
            'test_cases.*.id' => 'sometimes|exists:test_cases,id',
            'test_cases.*.input' => 'required|array',
            'test_cases.*.expected_output' => 'required',
            'test_cases.*.is_sample' => 'required|boolean'
        ];
    }

    public function failedValidation(Validator $validator): JsonResponse
    {
        $errors = $validator->errors()->toArray();

        throw new HttpResponseException(response_failed(message: 'Validation failed', data: $errors, status: Response::HTTP_BAD_REQUEST));
    }
}