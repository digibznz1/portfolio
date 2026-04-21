<?php

namespace App\Http\Requests\Dashboard\Admin\Evaluation\SelfEvaluation\SelfEvaluationFile;

use Illuminate\Foundation\Http\FormRequest;

class SelfEvaluationFileRequest extends FormRequest
{
	public function authorize(): bool
    {
    	return in_array(request()->method(), ['PUT', 'PATCH']) ? permissionAdmin('update-self_evaluation_files') : permissionAdmin('create-self_evaluation_files');

    }//end of authorize

    public function rules(): array
    {   
        $rules = [
            'file'        => [in_array(request()->method(), ['PUT', 'PATCH']) ? 'nullable' : 'required','file'],
            'description' => ['nullable'],
            'status'      => ['boolean'],
            'admin_id'    => ['nullable','exists:admins,id'],
        ];

        return $rules;

    }//end of rules

    public function attributes(): array
    {
        return [
            'file'        => trans('admin.files.file'),
            'description' => trans('admin.global.description'),
            'status'      => trans('admin.global.status'),
        ];

    }//end of attributes

    protected function prepareForValidation()
    {
        return $this->merge([
            'admin_id' => auth('admin')->id(),
        ]);

    }//end of prepare for validation

}//end of class