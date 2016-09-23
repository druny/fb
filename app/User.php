<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'login', 'email', 'password',  'role_id', 'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getRoleType($role_id) {

        $role = DB::table('users')
            ->select('roles.role')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->where('users.role_id', '=', $role_id)
            ->get();
        return $role;
    }

    public function getActiveStatus($column, $value) {
        return DB::table('users')
            ->where($column, $value)
            ->first();
    }
}
