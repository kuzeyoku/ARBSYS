<?php

namespace App\Http\Controllers\Auth;

use Throwable;
use RoleOptions;
use Carbon\Carbon;
use App\Mail\NewUserMail;
use App\Mail\WelcomeMail;
use App\Models\User\User;
use App\Models\User\Mediator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\FormRegisterRequest;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function register(FormRegisterRequest $request)
    {
        if (!$this->recaptcha($request))
            return redirect()->back()->withError("Robot doğrulaması başarısız.")->withInput();
        try {
            $data = [
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "password" => bcrypt($request->password),
                "borndate" => Carbon::parse($request->borndate)->format("d/m/Y"),
                "gender" => $request->gender,
                "role_id" => RoleOptions::MEDIATOR,
                "end" => Carbon::now()->addDays(7),
            ];
            $user = User::create($data);
            Mediator::create([
                "user_id" => $user->id,
            ]);
            //Mail::to("info@arbsys.com.tr")->send(new NewUserMail($data));
            //Mail::to($request->email)->send(new WelcomeMail($user));
            return redirect()->route("login")->withSuccess("Kayıt işlemi başarılı. Giriş Yapabilirsiniz.");
        } catch (Throwable $e) {
            return redirect()->back()->withError("Kayıt işlemi başarısız.")->withInput();
        }
    }

    protected function recaptcha(FormRegisterRequest $request): bool
    {
        if (config("recaptcha.status") === true) {
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . config("recaptcha.secret_key") . "&response=" . $request->input("g-recaptcha-response") . "&remoteip=" . $request->ip());
            $recaptcha = json_decode($response);
            return $recaptcha->success;
        }
        return true;
    }
}
