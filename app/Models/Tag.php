<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    public function post() {
        return $this->belongsTo('App\Models\Post');
    }
}