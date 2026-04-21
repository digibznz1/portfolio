<?php

namespace App\Http\Requests\Dashboard\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;

    }//end of authorize

    public function rules(): array
    {
        $rules = [
            'password' => ['required', 'string', 'min:2','max:255'],
            'email'    => ['required', 'email', 'exists:admins,email'],
        ];

        return $rules;

    }//end of rules

    public function attributes(): array
    {
        return [
            'email'     => trans('admin.auth.email'),
            'password'  => trans('admin.auth.password'),
        ];

    }//end of attributes

}//end of Request
