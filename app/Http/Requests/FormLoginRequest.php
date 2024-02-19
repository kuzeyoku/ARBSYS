<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormLoginRequest extends FormRequest
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
            "email" => "required|email",
            "password" => "required|min:6",
            "g-recaptcha-response" => "required",
            "rememberMe" => "nullable|boolean"
        ];
    }

    public function attributes()
    {
        return [
            "email" => "E-posta",
            "password" => "Şifre",
            "g-recaptcha-response" => "Robot Doğrulaması"
        ];
    }

    public function messages()
    {
        return [
            "g-recaptcha-response.required" => "Robot Doğrulaması Başarısız",
        ];
    }
}
