<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserConfirm extends Model
{
    protected $table = 'confirm_users';


    private function getToken() {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    public function createToken($id) {
        $token = $this->getToken();

        DB::table($this->table)
            ->insert([
               'user_id' => $id,
                'token' => $token
            ]);
        return $token;
    }

    public function tokenUpdate($id) {
        $token = $this->getToken();

        DB::table($this->table)->where('user_id', $id)
            ->update([
                'token' => $token,
            ]);
        return $token;
    }

    public function getActivationByToken($token)
    {
        return DB::table($this->table)->where('token', $token)->first();
    }

    public function delToken($token) {
        return DB::table($this->table)->where('token', $token)->delete();
    }

    public function activateUser($token) {
        $user_info = $this->getActivationByToken($token);
        if($user_info === null) return null;

        $activate = User::find($user_info->user_id);
        $activate->active = 1;
        $activate->save();

        $this->delToken($token);
        return $activate;
    }


}
