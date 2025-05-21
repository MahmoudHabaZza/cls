<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnrollmentOverviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'enrolled_from' => ['nullable', 'date'],
            'enrolled_to' => ['nullable', 'date', 'after_or_equal:enrolled_from'],
            'progress_min' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'progress_max' => ['nullable', 'numeric', 'min:0', 'max:100', 'gte:progress_min'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'user_name' => ['nullable', 'string'],
            'user_email' => ['nullable', 'email'],
            'course_name' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'level' => ['nullable', 'string'], 
            'price' => ['nullable', 'numeric', 'min:0'],
            'min_price' => ['nullable', 'numeric', 'min:0'],
            'max_price' => ['nullable', 'numeric', 'min:0', 'gte:min_price'],
            'sessions_count' => ['nullable', 'integer', 'min:0'],
            'thumbnail' => ['nullable', 'string'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100']
        ];
    }
}
