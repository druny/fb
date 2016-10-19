<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Tag;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        $this->middleware('roles');
    }

    public function index()
    {
        $tags = Tag::all();
        return view('admin.tag.index', ['tags' => $tags]);
    }


    public function create()
    {

        return view('admin.tag.create');
    }


    public function store(Requests\CheckTag $request)
    {
        $category = new Tag($request->all());
        $category->name;
        $category->description;
        $category->save();

        return redirect()->route('tags.index');
    }


    public function edit($tag)
    {
        $tag = Tag::tag($tag)->firstOrFail();
        return view('admin.tag.edit', ['tag' => $tag]);
    }


    public function update(Requests\CheckTag $request, $name)
    {
        $tag = Tag::tag($name)->firstOrFail();
        $tag->fill($request->all());
        $tag->save();
        return redirect()->route('tags.edit', $tag->name);
    }


    public function destroy($name)
    {
        $category = Tag::tag($name);
        $category->delete();
        return redirect()->route('categories.index');
    }
}
