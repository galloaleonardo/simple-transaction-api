<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class HasBalance implements Rule
{
    private int $payerId;

    /**
     * Create a new rule instance.
     *
     * @param int $payerId
     */
    public function __construct(int $payerId)
    {
        $this->payerId = $payerId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = User::find($this->payerId);

        if (!$user) {
            return false;
        }

        return $user->wallet->hasBalance($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'User must have balance.';
    }
}
