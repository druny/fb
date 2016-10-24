<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $table = 'feed';
    protected $fillable = ['tag_id'];

    public function users() {
        return $this->belongsToMany('App\Models\User');
    }

    public function tags() {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function scopeId($query, $id) {
        return $query->where('user_id', $id);
    }

    public function scopeUserId($query, $id) {
        return $query->where('user_id', $id);
    }

}
