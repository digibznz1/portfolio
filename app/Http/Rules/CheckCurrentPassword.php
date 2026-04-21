<?php

namespace App\Http\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;

class CheckCurrentPassword implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = auth('admin')->user();

        if (! $user || ! Hash::check($value, $user->password)) {
            $fail('Current Password Miss match');
        }
    }
}