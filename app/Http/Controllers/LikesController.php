<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Post $post) {

        $like = Like::where(['post_id' => $post->id, 'user_id' => auth()->user()->id])->first();

        if ($like) {
            Like::destroy($like->id);
        } else {
            Like::create(['post_id' => $post->id, 'user_id' => auth()->user()->id]);
        }

        return response()->json(['likes_count' => $post->likes->count()]);
    }
}
