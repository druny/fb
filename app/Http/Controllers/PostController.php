<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Validator;

class PostController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(2);
        return view('posts.index', ['posts' => $posts]);
    }

    public function show($slug)
    {
        $posts = new Post();
        $post = $posts->getSlug($slug);

        return view('posts.showOne', ['post' => $post]);

    }
}
