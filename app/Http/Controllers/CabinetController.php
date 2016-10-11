<?php

namespace App\Http\Controllers;


use App\Mail\ConfirmRegister;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CabinetController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['user'] = Auth::user();
        return view('cabinet.index', $data);

    }

    public function settings() {
        return view('cabinet.settings');
    }
    public function edit($id)
    {
        //
    }

}
