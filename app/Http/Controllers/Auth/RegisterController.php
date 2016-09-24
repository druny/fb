<?php

namespace App\Http\Controllers\Auth;

use App\Mail\ConfirmRegister;
use App\UserConfirm;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Mail;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:100',
            'surname' => 'required|',
            'login' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return  User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => '2',
            'active' => '0',
        ]);


    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        $this->sendVerificationMail($user);

        $data['msg'] = 'Зайдите на введенную вами почту и продолжите регистрацию';
        return response()->view('errors.error', $data);

    }

    public function sendVerificationMail($user) {

        $userConfirm = new UserConfirm();
        $token = $userConfirm->createToken($user->id);
        if($token) {
            $link = '/register/confirm/' . $token;
            Mail::to($user->email)->send(new ConfirmRegister($link));
        }
    }

    public function confirm($token) {
        $userConfirm = new UserConfirm();
        $active = $userConfirm->activateUser($token);
        if($active == null) {
            $data['msg'] = 'Аккаунт уже подтвержден или ссылка не корректна';
            return response()->view('errors.error', $data);
        }
        
        $data['msg'] = 'Аккаунт успешно подтвержден';
        return response()->view('errors.error', $data);
    }
}
