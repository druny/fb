<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CommentController extends Controller
{


    public function store(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required|exists:posts,id',
            'text' => 'required|min:2'
        ]);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
