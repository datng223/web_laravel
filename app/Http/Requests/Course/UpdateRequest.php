<?php

namespace App\Http\Requests\Course;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => [
                'bail',
                'required',
                'string',
                Rule::unique(Course::class, 'name')->ignore($this->course),
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':Attribute không được để trống',
            'unique' => ':Attribute đã được dùng',
        ];
    }

    public function attribute(): array
    {
        return [
            'name' => 'Name',
        ];
    }
}
