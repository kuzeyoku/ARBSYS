<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EvenLastDigitRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $lastDigit = substr((string) $value, -1);
        return $lastDigit % 2 === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ":attribute son hanesi çift olmalıdır.";
    }
}
