<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PaymentRule implements Rule
{

    public $tutar = [];
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tutar)
    {
        $this->tutar = $tutar;
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
        foreach ($this->tutar as $value) {
            if ($value == null) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Tutar Boş Geçilemez';
    }
}
