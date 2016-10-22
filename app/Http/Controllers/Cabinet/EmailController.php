<?php

namespace App\Http\Controllers\Cabinet;


use App\Models\EmailConfirm;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Requests;
use App\Models\UserConfirm;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\ConfirmMail;
use App\Mail\ConfirmNewMail;

class EmailController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles');
    }


    public function change()
    {
        return view('cabinet.email.change');
    }


    public function update(Request $request)
    {
        $this->validate($request, [
        'email' => 'min:2|max:255',
        ]);
        if(Auth::user()->email === $request->email) {
            if(Hash::check($request->password, Auth::user()->password)) {
                $this->sendVerificationMail($request);
                return back()->with('success','Зайдите на введенную вами почту' );
            }
            return back()->with('warning', 'Не верный пароль');
        }

        return back()->with('warning', 'Не верный текущий E-mail');

    }

    //When a user clicked on a link transmitted, he will see there, must be authenticate  , and then change email
    public function confirm(Request $request, $token) {
        $current_user_id = $request->user()->id;
        $email =  EmailConfirm::token($token);
        $email->user_id;

        if($email->user_id == $current_user_id) {

            if($email->is_confirm == 0) {
                $email->is_confirm = 1;
                $email->save();
                $user = User::login($request->user()->login);

                Mail::to($email->email)->send(new ConfirmNewMail($user, $token));
                $msg = 'Осталось только войти на новую почту и завешить подтверждение';
            } else {
                $msg =  'Вы уже подтвердили данное сообщение, перейдите на новый email';
            }


        } else {
            $msg = 'Данные не сходятся :/';
        }
        return view('mail.status', ['msg' => $msg]);
    }

    //Method for verification  and  changing on new email
    public function confirmNewEmail(Request $request, $token) {
        $current_user_id = $request->user()->id;
        $email =  EmailConfirm::token($token);
        $email->user_id;

        if($email->user_id == $current_user_id) {

            if($email->is_confirm == 1) {
                $user = User::login($request->user()->login);
                $user->email = $email->email;
                $user->save();
                $email->delete();
                $msg = 'Почта успешно изменена!!!';
            } else {
                $msg =  'Для начала подтвердите смену на старой пойте';
            }


        } else {
            $msg = 'Данные не сходятся :/';
        }
        return view('mail.status', ['msg' => $msg]);
    }

    //Check any model in DB and then send message
    public function sendVerificationMail(Request $request)
    {
        $token = $this->getEmailToken($request);
        if($token) {
            Mail::to($request->email)->send(new ConfirmMail($this->getToken()));
        }
    }

    //Directs the desired method
    public function getEmailToken($request) {

        if( EmailConfirm::id($request->user()->id) ) {
            return $this->updateToken($request);
        } else {
            return $this->createToken($request);
        }
    }

    //Save model
    private function createToken($request) {

        $email =  new EmailConfirm();
        $email->user_id = $request->user()->id;
        $email->token = $this->getToken();
        $email->email = $request->new_email;
        $email->is_confirm = 0;

        if($email->save()) {
            return true;
        }
        return false;
    }

    //Update model
    private function updateToken($request) {

        $email = EmailConfirm::id($request->user()->id);
        $email->token = $this->getToken();
        $email->email = $request->new_email;
        $email->is_confirm = 0;

        if($email->save()) {
            return true;
        }
        return false;
    }

    //Generate token
    public function getToken() {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }


}
