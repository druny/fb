<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['title', 'short', 'text', 'slug', 'img'];


    public function getSlug($slug)
    {
        return Post::where('slug', $slug)->firstOrFail();
    }
}
