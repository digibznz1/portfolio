<?php

namespace App\Http\Requests\Dashboard\Admin\Managements\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
{
	public function authorize(): bool
    {
    	return in_array(request()->method(), ['PUT', 'PATCH']) ? permissionAdmin('update-admins') : permissionAdmin('create-admins');

    }//end of authorize

    public function rules(): array
    {   
        $rules = [
            'name'     => ['required','string','min:2','max:30'],
            'status'   => ['boolean'],
            'role_id'  => ['nullable','string','exists:roles,id'],
            'admin_id' => ['nullable','exists:admins,id'],
        ];

        if (in_array(request()->method(), ['PUT', 'PATCH'])) {

            $admin = request()->route()->parameter('admin');

            $rules['email']    = ['required','email','min:2','max:40', Rule::unique('admins')->ignore($admin->id)];
            $rules['image']    = ['nullable','image'];
            $rules['password'] = ['nullable','min:6','max:30'];

        } else {

            $rules['email']    = ['required','string','unique:admins','min:2','max:40'];
            $rules['image']    = ['nullable','image'];
            $rules['password'] = ['required','min:6','max:30'];

        } //end of if

        return $rules;

    }//end of rules

    public function attributes(): array
    {
        return [
            'status'   => trans('admin.global.status'),
            'name'     => trans('admin.global.name'),
            'email'    => trans('admin.global.email'),
            'image'    => trans('admin.global.image'),
            'phone'    => trans('admin.global.phone'),
            'password' => trans('admin.auth.password'),
            'roles.*'  => trans('admin.models.roles')
        ];

    }//end of attributes

    protected function prepareForValidation()
    {
        return $this->merge([
            'admin_id' => auth('admin')->id(),
            'status'   => request()->has('status'),
        ]);

    }//end of prepare for validation

}//end of class