<?php

namespace App\Http\Requests\Dashboard\Organization\Auth\Account;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
	public function authorize(): bool
    {
        return auth('organization')->check();

    }//end of authorize

    public function rules(): array
    {
        $organization = auth('organization')->id();

        $rules = [
            'name'        => ['required','string','min:2','max:30', Rule::unique('organizations')->ignore((int) $organization)],
            'email'       => ['required','email','min:2','max:30', Rule::unique('organizations')->ignore((int) $organization)],
            'image'       => ['nullable','image'],
            'description' => ['nullable'],
        ];

        return $rules;

    }//end of rules

    public function attributes(): array
    {
        return [
            'name'  => trans('admin.global.name'),
            'email' => trans('admin.global.email'),
            'image' => trans('admin.global.image'),
            'phone' => trans('admin.global.phone'),
        ];

    }//end of attributes

}//end of class