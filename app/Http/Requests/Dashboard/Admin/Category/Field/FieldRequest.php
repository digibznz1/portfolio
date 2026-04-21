<?php

namespace App\Http\Requests\Dashboard\Admin\Category\Field;

use Illuminate\Foundation\Http\FormRequest;

class FieldRequest extends FormRequest
{
    public function authorize(): bool
    {
    	return in_array(request()->method(), ['PUT', 'PATCH']) ? permissionAdmin('update-fields') : permissionAdmin('create-fields');

    }//end of authorize

    public function rules(): array
    {   
        $rules = [
            'name'      => ['required','string','min:2','max:250'],
            'status'    => ['boolean'],
            'admin_id'  => ['nullable','exists:admins,id'],
            'parent_id' => ['required','exists:categories,id'],
        ];

        return $rules;

    }//end of rules

    public function attributes(): array
    {
        return [
            'name'     => trans('admin.global.name'),
            'status'   => trans('admin.global.status'),
            'parent_id'=> trans('admin.models.standards'),
        ];

    }//end of attributes

    protected function prepareForValidation()
    {
        return $this->merge([
            'admin_id' => auth('admin')->id(),
        ]);

    }//end of prepare for validation

}//end of class