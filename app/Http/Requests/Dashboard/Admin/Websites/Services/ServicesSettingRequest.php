<?php

namespace App\Http\Requests\Dashboard\Admin\Websites\Services;

use Illuminate\Foundation\Http\FormRequest;

class ServicesSettingRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'badge'               => ['nullable', 'array'],
            'badge.*'             => ['nullable', 'string', 'max:255'],
            'title'               => ['required', 'array'],
            'title.*'             => ['required', 'string', 'max:500'],
            'description'         => ['nullable', 'array'],
            'description.*'       => ['nullable', 'string'],
            'image'               => ['nullable', 'image', 'max:3048'],
            'section_title'       => ['nullable', 'array'],
            'section_title.*'     => ['nullable', 'string', 'max:255'],
            'cta_title'           => ['nullable', 'array'],
            'cta_title.*'         => ['nullable', 'string', 'max:500'],
            'cta_description'     => ['nullable', 'array'],
            'cta_description.*'   => ['nullable', 'string'],
            'cta_btn_primary'     => ['nullable', 'array'],
            'cta_btn_primary.*'   => ['nullable', 'string', 'max:255'],
            'cta_btn_secondary'   => ['nullable', 'array'],
            'cta_btn_secondary.*' => ['nullable', 'string', 'max:255'],
        ];
    }
}
