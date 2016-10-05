<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserConfirm;
use App\Mail\ConfirmRegister;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/cabinet';

    protected $adminRedirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);

    }
    public function username()
    {
        return 'login';
    }
    public function redirectPath()
    {
        if (property_exists($this, 'redirectTo')) {
            if (Auth::user()->hasAnyRole('Admin')) {
                $this->redirectTo = property_exists($this, 'adminRedirectTo') ? $this->adminRedirectTo : $this->redirectTo;
            }
            return $this->redirectTo;
        }
        return '/cabinet';
    }
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        if($this->getActiveStatus($request)) {
            $credentials = $this->credentials($request);

            if ($this->guard()->attempt($credentials, $request->has('remember'))) {
                return $this->sendLoginResponse($request);
            }

            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            $this->incrementLoginAttempts($request);

            return $this->sendFailedLoginResponse($request);
        } else {
            return back()->with('warning', 'Ваш аккаунт не подтвержден. На ваш электронный ящик было отправлено письмо для подтверждения');
        }
    }

    public function getActiveStatus(Request $request) {
        $getStatus = new User();
        $status = $getStatus->getActiveStatus('login', $request->login);
        $status->active;

        $userConfirm = new UserConfirm();
        $token = $userConfirm->updateToken($status->id);

        if($status->active == 0) {
            Mail::to($status->email)->send(new ConfirmRegister($token));
            return false;
        }
         return true;
    }
}
