<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
                'unique:App\Models\Course,name',
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
