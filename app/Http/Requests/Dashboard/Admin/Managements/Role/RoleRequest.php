<?php

namespace App\Http\Requests\Dashboard\Admin\Managements\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
	public function authorize(): bool
    {
        return in_array(request()->method(), ['PUT', 'PATCH']) ? permissionAdmin('update-roles') : permissionAdmin('create-roles');

    }//end of authorize

    public function rules(): array
    {
        $rules = [
            'permissions.*' => ['nullable'],
            'admin_id'      => ['nullable','exists:admins,id'],
            //'all.*'         => ['nullable'],
        ];

        if (in_array(request()->method(), ['PUT', 'PATCH'])) {

            $role = request()->route()->parameter('role');

            $rules['name'] = ['required','string','min:2','max:30', Rule::unique('roles')->ignore($role->id)];

        } else {

            $rules['name'] = ['required','string','unique:roles','min:2','max:30'];

        } //end of if

        return $rules;

    }//end of rules

    public function attributes(): array
    {
        return [
            'name' 		  => trans('admin.global.name'),
            'permissions' => trans('admin.models.permissions'),
            'admin_id' 	  => trans('admin.models.admin'),
        ];

    }//end of rules

    protected function prepareForValidation()
    {
        return $this->merge([
            'admin_id'   => auth('admin')->id(),
        ]);

    }//end of prepare for validation

}//end of class