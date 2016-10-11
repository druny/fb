<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Validator;

class PostController extends Controller
{

    public function __construct()
    {

    }


    //Home Page
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(config('post.pagination'));
        return view('posts.index', ['posts' => $posts]);
    }

    //Display of single post by Slug
    public function show($slug)
    {
        $posts = new Post();
        $post = $posts->getSlug($slug);
        return view('posts.showOne', ['post' => $post]);
    }


    //Display posts by category
    public function showPostsByCategory(Request $request, $category) {
        $posts = Category::slug($category)->firstOrFail()->posts;
        dd($posts);
        return view('posts.index', ['posts' => $posts]);
    }
}
