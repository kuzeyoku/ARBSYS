<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            "gender" => "nullable",
            "borndate" => "required",
            "phone" => "required",
            "email" => ["required", "email", "unique:users"],
            "password" => "required",
            "rpassword" => "required|same:password",
            "address" => "nullable",
            "registration_no" => "required|max:6",
            "iban" => "nullable",
            "meeting_address" => "nullable",
        ];
    }

    public function attributes()
    {
        return [
            "name" => "Ad Soyad",
            "gender" => "Cinsiyet",
            "borndate" => "Doğum Tarihi",
            "phone" => "Telefon",
            "email" => "E-Posta",
            "password" => "Şifre",
            "rpassword" => "Şifre Tekrar",
            "address" => "Adres",
            "registration_no" => "Sicil No",
            "iban" => "IBAN",
            "meeting_address" => "Toplanti Yeri (Adresi)",
        ];
    }
}
