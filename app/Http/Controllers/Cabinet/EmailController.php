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

    //When a user clicked on a link transmitted, he will see there, must enter the password, and then change email
    public function confirm(Request $request, $token) {
        $current_user_id = $request->user()->id;
        $email =  EmailConfirm::token($token);
        $email->user_id;

        if($email->user_id === $current_user_id) {

            $user = User::login($request->user()->login);
            // На этом месте думал, делать ли отправку верификации на новый мэйл или нет

        } else {
            $msg = 'Данные не сходятся :/';
        }
        var_dump($msg);
    }

    //'Put' method for verification password and then changing on new email
    public function confirmEmail() {

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
