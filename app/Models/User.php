<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $attributes = ['role_id' => 2];
    protected $fillable = [
        'name', 'surname', 'login', 'email', 'password',  'role_id', 'active', 'age', 'city',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function role() {
        return $this->belongsTo('App\Models\Role');
    }

    public function confirm_users() {
        return $this->belongsTo('App\Models\EmailConfirm');
    }

    public function feeds() {
        return $this->belongsTo('App\Models\Feed');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function hasAnyRole($roles) {
        if(is_array($roles)) {
            foreach($roles as $role) {
                if($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    protected function hasRole($role) {
        return $this->role()->where('role', $role)->first();
    }

    public function setRoleIdAttribute($value)
    {
        if ($this->isAdmin()) {
            $this->attributes['role_id'] = $value;
        }
    }
    public function getActiveStatus($column, $value) {
        return DB::table('users')
            ->where($column, $value)
            ->first();
    }

    public function setIsActiveAttribute($value)
    {
        if ($this->isAdmin()) {
            $this->attributes['is_active'] = $value;
        }
    }

    public function isAdmin() {
        if (Auth::check() && Auth::user()->hasAnuRole('Admin')) {
            return true;
        }
        return false;
    }

    public function scopeLogin($query, $login) {
        return $query->where('login', $login)->firstOrFail();
    }



}
