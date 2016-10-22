<?php

namespace App\Http\Controllers\Cabinet;


use App\Mail\ConfirmRegister;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ImageHelper;

class CabinetController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles');
    }


    public function index()
    {
        $data['user'] = Auth::user();
        return view('cabinet.index', $data);
    }


    public function edit(Request $request)
    {
        $user = User::login(Auth::user()->login);
        return view('cabinet.settings', ['user' => $user]);
    }

    public function update( Request $request) {
        $this->validate($request, [
            'name' => 'min:2|max:255',
            'surname' => 'min:2|max:255',
            'login' => 'min:5|max:255|unique:users,login,' . Auth::id(),
            'age' => 'min:1|max:200',
            'city' => 'min:1|max:150',
        ]);


        $user = User::login(Auth::user()->login);

        if($request->hasFile('avatar')) {
            ImageHelper::deleteAvatar($user->avatar);
            $user->avatar = ImageHelper::uploadAvatar($request->file('avatar'));

        }
        $user->fill($request->all());
        $user->save();
        return redirect()->back()->with('success', 'Данные успешно обновлены');
    }




}
