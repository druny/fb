<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['text', 'post_id', 'user_id'];

    public $editTime = 60 * 30;

    public function posts() {
        return $this->belongsTo('App\Models\Post');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
