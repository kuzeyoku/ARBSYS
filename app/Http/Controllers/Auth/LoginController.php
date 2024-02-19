<?php

namespace App\Http\Controllers\Auth;

use App\Models\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FormLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use RoleOptions;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }


    protected function login(FormLoginRequest $request)
    {
        if (!$this->recaptcha($request)) {
            return redirect()->back()->withError("Robot doğrulaması başarısız.")->withInput();
        }
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->rememberMe)) {
            if (Auth::user()->is_active == 0) {
                Auth::logout();
                return redirect()->back()->withError("Kullanıcı pasif durumda.");
            }
            $request->session()->regenerate();

            if (Auth::user()->remainingDay <= 0 && Auth::user()->role_id != 1) {
                User::whereId(Auth::user()->id)->update(['restriction' => 1]);
            } else {
                User::whereId(Auth::user()->id)->update(['restriction' => 0]);
            }
            if (Auth::user()->role_id == RoleOptions::ADMIN) {
                return redirect()->route("admin.home")->withSuccess("Giriş başarılı. Hoşgeldiniz - " . Auth::user()->name);
            }
            if (Auth::user()->role_id == RoleOptions::MEDIATOR) {
                return redirect()->route("home")->withSuccess("Giriş başarılı. Hoşgeldiniz - " . Auth::user()->name);
            }
        } else {
            return redirect()->back()->withError("E-posta adresi veya şifre hatalı.")->withInput();
        }
    }

    protected function recaptcha(FormLoginRequest $request)
    {
        if (config("recaptcha.status") === true) {
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . config("recaptcha.secret_key") . "&response=" . $request->input("g-recaptcha-response") . "&remoteip=" . $request->ip());
            $recaptcha = json_decode($response);
            return $recaptcha->success;
        }
        return true;
    }
}
