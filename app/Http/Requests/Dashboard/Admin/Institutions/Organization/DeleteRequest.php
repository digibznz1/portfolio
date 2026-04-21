<?php

namespace App\Http\Requests\Dashboard\Admin\Institutions\Organization;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
	public function authorize(): bool
    {
        return permissionAdmin('delete-organizations');

    }//end of authorize

    public function rules(): array
    {
        return [
            'ids.*' => ['required', 'numeric', 'exists:organizations,id'],
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