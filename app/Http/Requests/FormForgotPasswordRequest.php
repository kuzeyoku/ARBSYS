<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormForgotPasswordRequest extends FormRequest
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
            'email' => 'required|email',
            "g-recaptcha-response" => "required"
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'Email',
        ];
    }

    public function messages()
    {
        return [
            "g-recaptcha-response.required" => "Lütfen Robot Olmadığınızı Doğrulayın."
        ];
    }
}
