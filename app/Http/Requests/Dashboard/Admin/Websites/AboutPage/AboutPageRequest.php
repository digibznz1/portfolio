<?php

namespace App\Http\Requests\Dashboard\Admin\Websites\AboutPage;

use Illuminate\Foundation\Http\FormRequest;

class AboutPageRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'status'                  => ['boolean'],
            'hero_badge'              => ['nullable', 'array'],
            'hero_badge.*'            => ['nullable', 'string', 'max:255'],
            'hero_title'              => ['required', 'array'],
            'hero_title.*'            => ['required', 'string', 'max:500'],
            'hero_description'        => ['nullable', 'array'],
            'hero_description.*'      => ['nullable', 'string'],
            'hero_image'              => ['nullable', 'image', 'max:3048'],
            'hero_stat_number'        => ['nullable', 'array'],
            'hero_stat_number.*'      => ['nullable', 'string', 'max:50'],
            'hero_stat_label'         => ['nullable', 'array'],
            'hero_stat_label.*'       => ['nullable', 'string', 'max:255'],
            'hero_stat_description'   => ['nullable', 'array'],
            'hero_stat_description.*' => ['nullable', 'string'],
            'vision_title'            => ['nullable', 'array'],
            'vision_title.*'          => ['nullable', 'string', 'max:255'],
            'vision_description'      => ['nullable', 'array'],
            'vision_description.*'    => ['nullable', 'string'],
            'mission_title'           => ['nullable', 'array'],
            'mission_title.*'         => ['nullable', 'string', 'max:255'],
            'mission_description'     => ['nullable', 'array'],
            'mission_description.*'   => ['nullable', 'string'],
            'mission_cta'             => ['nullable', 'array'],
            'mission_cta.*'           => ['nullable', 'string', 'max:255'],
            'leadership_title'        => ['nullable', 'array'],
            'leadership_title.*'      => ['nullable', 'string', 'max:255'],
            'leadership_subtitle'     => ['nullable', 'array'],
            'leadership_subtitle.*'   => ['nullable', 'string'],
            'cta_title'               => ['nullable', 'array'],
            'cta_title.*'             => ['nullable', 'string', 'max:500'],
            'cta_btn_primary'         => ['nullable', 'array'],
            'cta_btn_primary.*'       => ['nullable', 'string', 'max:255'],
            'cta_btn_secondary'       => ['nullable', 'array'],
            'cta_btn_secondary.*'     => ['nullable', 'string', 'max:255'],
        ];
    }
}
