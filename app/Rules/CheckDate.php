<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckDate implements Rule
{
    public $date = "";
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($date)
    {
        $this->date = $date;
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
        if (strtotime($this->date) >= strtotime(date('d-m-Y'))) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Seçilen Tarih Eski Olamaz.';
    }
}
