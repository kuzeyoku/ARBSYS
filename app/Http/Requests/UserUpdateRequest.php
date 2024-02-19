<?php

namespace App\Http\Requests;

use App\Rules\EvenLastDigitRule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required",
            "email" => "required|email|unique:users,email," . auth()->id(),
            "phone" => "required",
            "address" => "nullable",
            "identification" => "required|numeric|digits:11|unique:mediators,identification," . auth()->id() . ",user_id", new EvenLastDigitRule,
            "registration_no" => "required",
            "iban" => "required",
            "mediation_center" => "nullable|numeric",
            "meeting_address" => "nullable",
            "meeting_address_proposal" => "nullable|boolean",
        ];
    }

    public function attributes()
    {
        return [
            "name" => "Ad Soyad",
            "email" => "E-posta",
            "phone" => "Telefon",
            "address" => "Adres",
            "identification" => "T.C. Kimlik No",
            "registration_no" => "Sicil No",
            "iban" => "IBAN",
            "mediation_center" => "Arabuluculuk Merkezi",
            "meeting_address" => "Toplantı Adresi",
            "meeting_address_proposal" => "Toplantı Adresi Önerisi",
        ];
    }

    public function messages()
    {
        return [
            "identification.even_last_digit" => "T.C. Kimlik No son hanesi çift olmalıdır."
        ];
    }
}
