<?php

namespace App\Http\Requests\Dashboard\Admin\Websites\Packages;

use Illuminate\Foundation\Http\FormRequest;

class PricingSettingRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'hero_badge'          => ['nullable', 'array'],
            'hero_badge.*'        => ['nullable', 'string', 'max:255'],
            'hero_title'          => ['required', 'array'],
            'hero_title.*'        => ['required', 'string'],
            'hero_description'    => ['nullable', 'array'],
            'hero_description.*'  => ['nullable', 'string'],
            'custom_badge'        => ['nullable', 'array'],
            'custom_badge.*'      => ['nullable', 'string', 'max:255'],
            'custom_title'        => ['nullable', 'array'],
            'custom_title.*'      => ['nullable', 'string'],
            'custom_description'  => ['nullable', 'array'],
            'custom_description.*'=> ['nullable', 'string'],
            'custom_image'        => ['nullable', 'image', 'max:3048'],
            'custom_btn_text'     => ['nullable', 'array'],
            'custom_btn_text.*'   => ['nullable', 'string', 'max:255'],
            'custom_plan_title'   => ['nullable', 'array'],
            'custom_plan_title.*' => ['nullable', 'string', 'max:255'],
            'comparison_title'    => ['nullable', 'array'],
            'comparison_title.*'  => ['nullable', 'string', 'max:255'],
        ];
    }
}
