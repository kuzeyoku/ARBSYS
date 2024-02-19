<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormPasswordResetRequest extends FormRequest
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
            "password" => "required",
            "password_confirmation" => "required|same:password",
            "g-recaptcha-response" => "required",
            "token" => "required"
        ];
    }

    public function attributes()
    {
        return [
            "email" => "Email",
            "password" => "Parola",
            "password_confirmation" => "Parola Tekrarı",
        ];
    }

    public function messages()
    {
        return [
            "g-recaptcha-response.required" => "Lütfen robot olmadığınızı doğrulayın."
        ];
    }
}
