<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRegisterRequest extends FormRequest
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
            "email" => "required|email|unique:users",
            "borndate" => "nullable",
            "gender" => "nullable",
            "g-recaptcha-response" => "required",
            "phone" => "required|numeric|digits:10|unique:users",
            "password" => "required|min:6",
            "password_confirm" => "required|same:password",
        ];
    }

    public function attributes()
    {
        return [
            "name" => "Ad Soyad",
            "email" => "E-Posta",
            "g-recaptcha-response" => "Robot Doğrulaması",
            "phone" => "Telefon",
            "password" => "Şifre",
            "password_confirm" => "Şifre Tekrar",
        ];
    }

}
