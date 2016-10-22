<?php

namespace App\Http\Controllers\Cabinet;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles');
    }



    public function change()
    {
        return view('cabinet.password.change');
    }


    public function update(Request $request)
    {

        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'min:5|confirmed',
        ]);

        $oldPassword = $request->user()->password;

        //Checked equality current and new password
        if($oldPassword === $request->new_password) {
            return redirect()->back()->with('warning', 'Старый и новый пароли не должны совпадать');
        }

        //Verify current password and then update info, or return warning
        if(Hash::check($request->old_password, $oldPassword)) {
            $request->user()->fill([
                'password' => Hash::make($request->new_password_confirmation)
            ])->save();
            return redirect()->back()->with('success', 'Пароль успешно изменен');
        } else {
            return redirect()->back()->with('warning', 'Вы ввели не верный текущий пароль');
        }





    }


}
