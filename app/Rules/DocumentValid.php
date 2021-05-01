<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class DocumentValid implements Rule
{
    private ?string $userType;

    /**
     * Create a new rule instance.
     *
     * @param  string|null  $userType
     */
    public function __construct(?string $userType)
    {
        $this->userType = $userType;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if (!$this->userType) {
            return false;
        }

        if ($this->userType === User::PERSON) {
            return strlen($value) === 11;
        }

        if ($this->userType === User::COMPANY) {
            return strlen($value) === 14;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Invalid type for the user document.';
    }
}
