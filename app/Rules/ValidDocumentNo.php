<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidDocumentNo implements Rule
{
    public $documentNo;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($documentNo)
    {
        $this->documentNo = $documentNo;
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
        return !empty($this->documentNo);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Arabuluculuk dosya numarası boş geçilemez!';
    }
}
