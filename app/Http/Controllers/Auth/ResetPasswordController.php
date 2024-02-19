<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\FormPasswordResetRequest;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{

    protected $redirectTo = RouteServiceProvider::HOME;

    use ResetsPasswords;

    protected function reset(FormPasswordResetRequest $request)
    {
        if (!$this->recaptcha($request)) {
            return redirect()->back()->withError("Robot doğrulaması başarısız.")->withInput();
        }
        try {
            $response = Password::reset($request->only('email', 'password', 'password_confirmation', "token"), function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                    'remember_token' => Str::random(60),
                ])->save();
            });

            if ($response == Password::PASSWORD_RESET) {
                return redirect()->route("login")->withSuccess("Şifreniz başarıyla güncellendi.");
            } else {
                return redirect()->back()->withError("Bir hata oluştu.")->withInput();
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withError("Bir hata oluştu.")->withInput();
        }
    }

    protected function recaptcha(FormPasswordResetRequest $request)
    {
        if (config("recaptcha.status") === true) {
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . config("recaptcha.secret_key") . "&response=" . $request->input("g-recaptcha-response") . "&remoteip=" . $request->ip());
            $recaptcha = json_decode($response);
            return $recaptcha->success;
        }
        return true;
    }
}
