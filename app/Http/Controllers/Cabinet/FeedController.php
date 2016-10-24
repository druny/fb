<?php

namespace App\Http\Controllers\Cabinet;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Feed;
use Illuminate\Support\Facades\Auth;
use App\Helpers\PaginateHelper;

class FeedController extends Controller
{

    public function index()
    {


        $feeds = Feed::id(Auth::id())->get();

        if($feeds) {

            $tags = [];
            foreach ($feeds as $feed) {
                $tags[] = $feed->tag_id;
            }
            $posts = Post::whereHas('tags', function($query) use ($tags) {
                $query->whereIn('tag_id', $tags);
            })->orderBy('id', 'desc')->paginate(2);

            return view('cabinet.feed.index', ['posts' => $posts]);

        } else {
            return view('errors.error', ['msg' => 'Ваша лента пуста']);
        }

         //На данном моменте думал как правильней реализовать ленту новостей
    }

    public function feed(Request $request) {
        if($request->tag == NULL) {
           if ($this->destroy($request->user()->id)) {
               return redirect()->route('cabinet.index')->with('success', 'Вы успешно отписались от всех новостей');
           } else {
               return redirect()->route('cabinet.index')->with('warning', 'Вы не подписаны ни на один тег');
           }
        }
        
        $this->store($request);
        return redirect()->route('cabinet.index')->with('success', 'Данные успешно обновлены');
    }


    public function store(Request $request)
    {
        $this->destroy($request->user()->id);
        foreach ($request->tag as $tag) {
            $feed = new Feed($request->all());
            $feed->user_id = $request->user()->id;
            $feed->tag_id = $tag;
            $feed->save();
        }
    }


    public function destroy($id)
    {
        $tags = Feed::userId($id);
        if ($tags) {
            $tags->delete();
            return true;
        }
        return false;

    }
}
