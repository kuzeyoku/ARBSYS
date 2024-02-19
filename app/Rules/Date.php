<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Date implements Rule
{
    public $value;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($value)
    {
        $this->value = $value;
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
        return $this->value > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute geçmiş tarih olamaz';
    }
}
