<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = ['name', 'description'];

    public function posts() {
        return $this->belongsToMany('App\Models\Post');
    }

    public function scopeTag($query, $tag) {
        return $query->where('name', $tag);
    }
}
