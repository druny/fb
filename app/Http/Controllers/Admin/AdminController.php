<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Validator;
use App\Helpers\ImageHelper;

class AdminController extends Controller
{
    public function __construct()
    {

        $this->middleware('roles');
    }

    public function index(Request $request)
    {
        $posts = Post::orderBy('id', 'desc')->paginate(config('post.pagination'));
        return view('admin.home', ['posts' => $posts]);
    }


    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.create', ['categories' => $categories, 'tags' => $tags ]);
    }


    public function store( Requests\CheckOfPost $request )
    {
        $post = new Post($request->all());

       if($request->hasFile('img'))  {
            $post->img = ImageHelper::upload($request->file('img'));
        }

        $post->save();
        $post->tags()->attach($request->tags);
        return redirect()->route('admin.index');
    }


    public function show($id)
    {
        echo 'GET	/photos/{photo}	show	photos.show';
    }


    public function edit(Request $request, $slug)
    {

        $posts = new Post();
        $post = $posts->getSlug($slug);
        $categories = Category::all();
        return view('admin.edit', ['post' => $post, 'categories' => $categories]);
    }


    public function update(Requests\CheckOfPost $request, $slug)
    {

        $posts = new Post();
        $post = $posts->getSlug($slug);

        $img_name = $post->img;
        $post->fill($request->all());

        if($request->hasFile('img')) {
            $post->img = ImageHelper::upload($request->file('img'));
            if($img_name) {
                ImageHelper::delete($img_name);
            }
        }

        $post->save();
        return redirect()->route('admin.edit', $post->slug);
    }


    public function destroy(Request $request, $slug)
    {
        $posts = new Post();
        $post = $posts->getSlug($slug);

        if($post->img) {
            ImageHelper::delete($post->img);
        }
        $post->delete();
        return redirect()->route('admin.index');
    }
}
