<?php

namespace App\Http\Requests\Dashboard\Admin\Websites\Contacts;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function authorize(): bool { return permissionAdmin('status-contacts'); }

    public function rules(): array
    {
        return [
            'id'     => ['required', 'numeric', 'exists:contacts,id'],
            'status' => ['required', 'in:new,read,replied'],
        ];
    }
}
