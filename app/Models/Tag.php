<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = ['name', 'description'];

    public function posts() {
        return $this->belongsToMany('App\Models\Post');
    }

    public function feeds() {
        return $this->belongsToMany('App\Models\Feed');
    }

    public function scopeId($query, $id) {
        return $query->where('id', $id);
    }

    public function scopeTag($query, $tag) {
        return $query->where('name', $tag);
    }


}
