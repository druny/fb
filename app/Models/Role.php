<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{

    public function __construct()
    {
        $this->roles = DB::table('roles')->get();
    }

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public static function getRoleId($role) {
        return DB::table('roles')->where('name', $role)->first()->id;
    }
}
