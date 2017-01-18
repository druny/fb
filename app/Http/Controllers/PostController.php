<?php

namespace App\Http\Controllers;

use App\Helpers\PaginateHelper;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
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
        $post = Post::slug($slug);
        $comments = Comment::id($post->id)->get();

        return view('posts.showOne', [
                'post' => $post,
                'comments' => $comments,
            ]
        );
    }

    //Display posts by category
    public function showPostsByCategory(Request $request, $slug) {
        $categoryPosts = Category::slug($slug)->firstOrFail()->posts;
        $posts = PaginateHelper::paginate($categoryPosts, config('post.pagination'));
        return view('posts.index', ['posts' => $posts, 'path' => $request->url()]);
    }

    //Display posts by tag
    public function showPostsByTag(Request $request, $tag) {
        $tagPosts = Tag::tag($tag)->firstOrFail()->posts;
        $posts = PaginateHelper::paginate($tagPosts, config('post.pagination'));
        return view('posts.index', ['posts' => $posts, 'path' => $request->url()]);
    }
}
