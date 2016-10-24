<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests;
use Validator;


class CategoryController extends Controller
{

    public function __construct()
    {

        $this->middleware('roles');
    }

    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', ['categories' => $categories]);
    }


    public function create()
    {

        return view('admin.category.create');
    }


    public function store(Requests\CheckCategory $request)
    {
        $category = new Category($request->all());
        $category->name;
        $category->slug;
        $category->description;
        $category->save();

        return redirect()->route('categories.index');
    }


    public function edit($slug)
    {
        $category = Category::slug($slug)->firstOrFail();

        return view('admin.category.edit', ['category' => $category]);
    }


    public function update(Requests\CheckCategory $request, $slug)
    {
        $category = Category::slug($slug);
        $category->fill($request->all());
        $category->save();
        return redirect()->route('categories.edit', $category->slug);
    }


    public function destroy($slug)
    {
        $category = Category::slug($slug);
        $category->delete();
        return redirect()->route('categories.index');
    }
}
