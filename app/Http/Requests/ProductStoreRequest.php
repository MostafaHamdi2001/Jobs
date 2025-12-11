<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // اسمح للكل — أو عدلها حسب البيرميشن
    }

    public function rules(): array
    {
        return [
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'active'   => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title_en.required' => 'English title is required',
            'title_ar.required' => 'Arabic title is required',
            'active.required'   => 'Active status is required',
        ];
    }
}
