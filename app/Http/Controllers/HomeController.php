<?php

namespace App\Http\Controllers;

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
        var_dump(Auth::guard('admins')->attempt(['name' => 'Андрей', 'email' => 'druny1955@rambler.ru', 'password' => 'password']));
        
        return view('home', $data);

    }

    public function test() {

        if(Auth::check()) {
            echo "Вы авторизованы";
        } else {
            echo "Вы не авторизованы";
            //return redirect()->intended('dashboard');

        }
    }
}
