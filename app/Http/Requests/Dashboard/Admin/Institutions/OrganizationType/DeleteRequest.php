<?php

namespace App\Http\Requests\Dashboard\Admin\Institutions\OrganizationType;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
	public function authorize(): bool
    {
        return permissionAdmin('delete-organization_types');

    }//end of authorize

    public function rules(): array
    {
        return [
            'ids.*' => ['required', 'numeric', 'exists:organization_types,id'],
        ];

    }//end of rules

    public function attributes(): array
    {
        return [
            'ids.*' => trans('admin.global.items'),
        ];        

    }//end of attributes

    protected function prepareForValidation()
    {
        return request()->merge([
            'ids'   => json_decode(request()->record_ids),
        ]);

    }//end of prepare for validation

}//end of class