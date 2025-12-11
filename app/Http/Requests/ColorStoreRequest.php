<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorStoreRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'hex' => ['required','unique:colors,hex','regex:/^#[0-9A-Fa-f]{6}$/'],
        ];
    }
}
