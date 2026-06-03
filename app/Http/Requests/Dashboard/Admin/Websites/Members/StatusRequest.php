<?php

namespace App\Http\Requests\Dashboard\Admin\Websites\Members;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function authorize(): bool { return permissionAdmin('status-members'); }

    public function rules(): array
    {
        return ['id' => ['required', 'numeric', 'exists:members,id']];
    }
}
