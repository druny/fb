<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

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
        return view('admin.create');
    }


    public function store( Requests\CheckOfPost $request )
    {
        $post = new Post($request->all());

        if($request->hasFile('img'))  {
            $post->img = ImageHelper::upload($request->file('img'));
        }
        $post->date = date('m-d-Y');
        $post->time = date('G' + 1 . ':i:s');
        $post->save();
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
        return view('admin.edit', ['post' => $post]);
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
