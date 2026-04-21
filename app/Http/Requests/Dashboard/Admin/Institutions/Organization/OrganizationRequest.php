<?php

namespace App\Http\Requests\Dashboard\Admin\Institutions\Organization;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrganizationRequest extends FormRequest
{
	public function authorize(): bool
    {
    	return in_array(request()->method(), ['PUT', 'PATCH']) ? permissionAdmin('update-organizations') : permissionAdmin('create-organizations');

    }//end of authorize

    public function rules(): array
    {   
        $rules = [
            'name'     => ['required','string','min:2','max:30'],
            'status'   => ['boolean'],
            'admin_id' => ['nullable','exists:admins,id'],
            'organization_type_id' => ['required','exists:organization_types,id'],
        ];

        if (in_array(request()->method(), ['PUT', 'PATCH'])) {

            $organization = request()->route()->parameter('organization');

            $rules['email']    = ['required','email','min:2','max:40', Rule::unique('organizations')->ignore($organization->id)];
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
            'password' => trans('admin.auth.password')
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