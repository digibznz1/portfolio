<?php

namespace App\Http\Requests\Dashboard\Admin\Websites\Packages;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'         => ['required', 'array'],
            'name.*'       => ['required', 'string', 'max:255'],
            'subtitle'     => ['nullable', 'array'],
            'subtitle.*'   => ['nullable', 'string', 'max:255'],
            'price'        => ['nullable', 'string', 'max:50'],
            'price_unit'   => ['nullable', 'array'],
            'price_unit.*' => ['nullable', 'string', 'max:50'],
            'features'     => ['nullable', 'array'],
            'button_text'  => ['nullable', 'array'],
            'button_text.*'=> ['nullable', 'string', 'max:255'],
            'button_style' => ['nullable', 'in:outline,filled'],
            'is_featured'  => ['nullable', 'boolean'],
            'index'        => ['nullable', 'integer'],
            'status'       => ['nullable', 'boolean'],
        ];
    }
}
