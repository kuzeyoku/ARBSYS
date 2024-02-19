<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SelectedUser implements Rule
{
    public $userCount = 0;

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
        return !$this->userCount == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Bildirim gönderilecek 1 veya birden fazla kişiyi seçin.';
    }
}
