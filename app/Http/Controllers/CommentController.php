<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Comment;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{


    public function store(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required|exists:posts,id',
            'text' => 'required|min:2'
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->post_id = $request->post_id;
        $comment->text = $request->text;
        if($comment->save()) {
            return redirect()->back()->with('success', 'Комментарий успешно добавлен');
        }
        return redirect()->back()->with('warning', 'Что-то пошло не так');
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
