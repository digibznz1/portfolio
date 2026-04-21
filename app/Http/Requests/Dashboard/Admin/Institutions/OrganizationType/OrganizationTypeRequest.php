<?php

namespace App\Http\Requests\Dashboard\Admin\Institutions\OrganizationType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrganizationTypeRequest extends FormRequest
{
	public function authorize(): bool
    {
        return in_array(request()->method(), ['PUT', 'PATCH']) ? permissionAdmin('update-organization_types') : permissionAdmin('create-organization_types');

    }//end of authorize

    public function rules(): array
    {
        $rules = [
            'status'    => ['nullable'],
            'admin_id'  => ['nullable','exists:organization_types,id'],
        ];

        if (in_array(request()->method(), ['PUT', 'PATCH'])) {

            $organizationType = request()->route()->parameter('organization_type');

            $rules['name'] = ['required','string','min:2','max:30', Rule::unique('organization_types')->ignore($organizationType->id)];

        } else {

            $rules['name'] = ['required','string','unique:organization_types','min:2','max:30'];

        }//end of if

        return $rules;

    }//end of rules

    public function attributes(): array
    {
        return [
            'name' 	   => trans('admin.global.name'),
            'status'   => trans('admin.global.status'),
            'admin_id' => trans('admin.models.admin'),
        ];

    }//end of rules

    protected function prepareForValidation()
    {
        return $this->merge([
            'admin_id' => auth('admin')->id(),
        ]);

    }//end of prepare for validation

}//end of class