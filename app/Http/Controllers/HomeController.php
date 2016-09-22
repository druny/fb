<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['user'] = Auth::user();
        Mail::to('druny195@rambler.ru')->send(new ForgotPassword);
        return view('home', $data);

    }

    public function test() {

        if(Auth::check()) {
            echo "Вы авторизованы";

            //return redirect()->route('test2', ['id' => 2]);
        } else {
            echo "Вы не авторизованы";
            //return redirect()->intended('dashboard');

        }
    }
}
