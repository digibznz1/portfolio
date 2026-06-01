<?php

namespace App\Http\Requests\Dashboard\Admin\Websites\Appointments;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function authorize(): bool { return permissionAdmin('status-appointments'); }

    public function rules(): array
    {
        return [
            'id'     => ['required', 'numeric', 'exists:appointments,id'],
            'status' => ['required', 'in:pending,confirmed,cancelled'],
        ];
    }
}
