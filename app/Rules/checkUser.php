<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class checkUser implements Rule
{
    public $userCount;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($userCount)
    {
        $this->userCount = $userCount;
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
        return $this->userCount == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Boyle bir kullanici kaydi var lutfen baska bir hesap olusturmayi deneyin!';
    }
}
