<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorUpdateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'hex' => ['sometimes','regex:/^#[0-9A-Fa-f]{6}$/','unique:colors,hex,' . $this->color->id],
        ];
    }
}
