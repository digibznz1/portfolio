<?php

namespace App\Http\Requests\Dashboard\Admin\Category\Standard;

use Illuminate\Foundation\Http\FormRequest;

class StandardRequest extends FormRequest
{
    public function authorize(): bool
    {
    	return in_array(request()->method(), ['PUT', 'PATCH']) ? permissionAdmin('update-standards') : permissionAdmin('create-standards');

    }//end of authorize

    public function rules(): array
    {   
        $rules = [
            'name'     => ['required','string','min:2','max:250'],
            'status'   => ['boolean'],
            'admin_id' => ['nullable','exists:admins,id'],
        ];

        return $rules;

    }//end of rules

    public function attributes(): array
    {
        return [
            'name'     => trans('admin.global.name'),
            'status'   => trans('admin.global.status'),
        ];

    }//end of attributes

    protected function prepareForValidation()
    {
        return $this->merge([
            'admin_id' => auth('admin')->id(),
        ]);

    }//end of prepare for validation

}//end of class