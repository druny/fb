<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['title', 'short', 'text', 'slug', 'img', 'category_id'];


    public function category() {

        return $this->belongsTo('App\Models\Category');
    }
    public function tags() {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug)->firstOrFail();
    }
}
