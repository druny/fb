<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailConfirm extends Model
{
    protected $table = 'confirm_emails';

    protected $fillable = ['user_id', 'email', 'token'];

    public function users() {
        return $this->hasMany('App\Models\User');
    }

    public function scopeId($query, $id) {
        return $query->where('user_id', $id)->firstOrFail();
    }

    public function scopeToken($query, $token) {
        return $query->where('token', $token)->firstOrFail();
    }
}
