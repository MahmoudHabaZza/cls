<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            "name" => ['required','min:5','max:255'],
            "description" => ['nullable','max:2000'],
            "level" => ['required',"numeric","in:0,1,2"],
            "price" => ['required','numeric','max:20000'],
            "sessions_count" => ['required','numeric'],
            "thumbnail" => ['required']
        ];
    }
}
