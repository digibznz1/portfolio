<?php

namespace App\Http\Requests\Dashboard\Admin\Websites\Members;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'      => ['required', 'array'],
            'name.*'    => ['required', 'string', 'max:255'],
            'position'  => ['required', 'array'],
            'position.*'=> ['required', 'string', 'max:255'],
            'bio'       => ['nullable', 'array'],
            'bio.*'     => ['nullable', 'string'],
            'image'     => ['nullable', 'image', 'max:3048'],
            'index'     => ['nullable', 'integer'],
            'status'    => ['nullable', 'boolean'],
        ];
    }
}
