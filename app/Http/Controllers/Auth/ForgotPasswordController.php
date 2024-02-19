<?php

namespace App\Http\Controllers\Auth;

use App\Models\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\FormForgotPasswordRequest;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{

    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(FormForgotPasswordRequest $request)
    {
        if (!$this->recaptcha($request)) {
            return redirect()->back()->withError("Robot doğrulaması başarısız.")->withInput();
        }

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );
        if ($response == Password::RESET_LINK_SENT) {
            return redirect()->back()->withSuccess("Şifre Sıfırlama Bağlantısı Mail Adresinize Gönderildi.");
        } else {
            return redirect()->back()->withErrors(['email' => __($response)]);
        }
    }


    protected function recaptcha(FormForgotPasswordRequest $request)
    {
        if (config("recaptcha.status") === true) {
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . config("recaptcha.secret_key") . "&response=" . $request->input("g-recaptcha-response") . "&remoteip=" . $request->ip());
            $recaptcha = json_decode($response);
            return $recaptcha->success;
        }
        return true;
    }
}
