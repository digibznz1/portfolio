<?php

namespace App\Http\Requests\Dashboard\Admin\Evaluation\SelfEvaluation;

use App\Admin\SelfEvaluation\AlertTypeEnums;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class SelfEvaluationRequest extends FormRequest
{
	public function authorize(): bool
    {
    	return in_array(request()->method(), ['PUT', 'PATCH']) ? permissionAdmin('update-self_evaluations') : permissionAdmin('create-self_evaluations');

    }//end of authorize

    public function rules(): array
    {   
        $rules = [
            'name'                 => ['required','string','min:2','max:250'],
            'alert'                => ['nullable','string'],
            'alert_type'           => ['nullable', new Enum(AlertTypeEnums::class)],
            'alert_value'          => ['nullable'],
            'explain'              => ['nullable','string'],
            'degree'               => ['required', 'numeric'],
            'status'               => ['boolean'],
            'standard_id'          => ['required','exists:categories,id'],
            'category_id'          => ['required','exists:categories,id'],
            'admin_id'             => ['nullable','exists:admins,id'],
            'organization_type_id' => ['required','exists:organization_types,id'],
        ];

        return $rules;

    }//end of rules

    public function attributes(): array
    {
        return [
            'name'                 => trans('admin.evaluations.self_evaluations.name'),
            'description'          => trans('admin.global.description'),
            'alert'                => trans('admin.evaluations.self_evaluations.alert'),
            'explain'              => trans('admin.evaluations.self_evaluations.explain'),
            'degree'               => trans('admin.evaluations.self_evaluations.degree'),
            'standard_id'          => trans('admin.models.standards'),
            'category_id'          => trans('admin.models.fields'),
            'organization_type_id' => trans('admin.models.organization_type'),
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