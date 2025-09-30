<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;

class NotOldPassword implements ValidationRule
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (Hash::check($value, $this->user->password)) {
            $fail(__('The new password must be different from the current password.'));
        }
    }
}