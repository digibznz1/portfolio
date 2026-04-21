<?php

namespace App\Http\Requests\Dashboard\Admin\Evaluation\SelfEvaluation\SelfEvaluationFile;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return permissionAdmin('status-self_evaluation_files');

    }//end of authorize

    public function rules(): array
    {
        return [
            'id' => ['required', 'numeric', 'exists:self_evaluation_files,id'],
        ];

    }//end of rules

    public function attributes(): array
    {
        return [
            'id' => trans('admin.global.item'),
        ];        

    }//end of attributes

}//end of class
