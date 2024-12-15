<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class UpdateClassRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'banner' => 'sometimes|required|image|mimes:jpeg,png,jpg|max:2048',
            'detail' => 'sometimes|required|string',
            'access_code' => 'sometimes|required|string|max:255',
            'status' => ['sometimes', 'required', Rule::in(['active', 'inactive'])]
        ];
    }

    public function failedValidation(Validator $validator): JsonResponse
    {
        $errors = $validator->errors()->toArray();

        throw new HttpResponseException(
            response_failed(
                message: 'Validation failed', 
                data: $errors, 
                status: Response::HTTP_BAD_REQUEST
            )
        );
    }
}