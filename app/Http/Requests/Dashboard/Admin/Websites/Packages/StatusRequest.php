<?php

namespace App\Http\Requests\Dashboard\Admin\Websites\Packages;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function authorize(): bool { return permissionAdmin('status-packages'); }

    public function rules(): array
    {
        return ['id' => ['required', 'numeric', 'exists:packages,id']];
    }
}
