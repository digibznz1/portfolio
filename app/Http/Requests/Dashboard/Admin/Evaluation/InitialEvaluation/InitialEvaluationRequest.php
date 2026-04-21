<?php

namespace App\Http\Requests\Dashboard\Admin\Evaluation\InitialEvaluation;

use Illuminate\Foundation\Http\FormRequest;

class InitialEvaluationRequest extends FormRequest
{
	public function authorize(): bool
    {
    	return in_array(request()->method(), ['PUT', 'PATCH']) ? permissionAdmin('update-initial_evaluations') : permissionAdmin('create-initial_evaluations');

    }//end of authorize

    public function rules(): array
    {   
        $rules = [
            'question'             => ['required', 'string', 'min:2', 'max:250'],
            'answer'               => ['boolean'],
            'description'          => ['nullable', 'string'],
            'admin_id'             => ['nullable', 'exists:admins,id'],
            'standard_id'          => ['required', 'exists:categories,id'],
            'category_id'          => ['required', 'exists:categories,id'],
            'organization_type_id' => ['required', 'exists:organization_types,id'],
            'self_evaluations.*'   => ['required', 'numeric', 'exists:self_evaluations,id'],
            'status'               => ['boolean'],
        ];

        return $rules;

    }//end of rules

    public function attributes(): array
    {
        return [
            'question'             => trans('admin.evaluations.initial_evaluations.question'),
            'answer'               => trans('admin.evaluations.initial_evaluations.answer'),
            'description'          => trans('admin.global.description'),
            'standard_id'          => trans('admin.models.standards'),
            'category_id'          => trans('admin.models.fields'),
            'organization_type_id' => trans('admin.models.organization_type'),
            'self_evaluations'     => trans('admin.models.self_evaluations'),
            'status'               => trans('admin.global.status'),
        ];

    }//end of attributes

    protected function prepareForValidation()
    {
        return $this->merge([
            'admin_id' => auth('admin')->id(),
        ]);

    }//end of prepare for validation

}//end of class