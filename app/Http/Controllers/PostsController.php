<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Intervention\Image\Facades\Image;


class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = $users->isEmpty() ? Post::where('user_id', '!=' , auth()->user()->id)->with('user')->latest()->paginate(self::PAGINATE_VALUE)
                                   : Post::whereIn('user_id', $users)->latest()->with('user')->paginate(self::PAGINATE_VALUE);
        return view('posts.index', compact('posts'));
    }


    public function create() {
        return view('posts.create');
    }

    public function store() {

        $data = \request()->validate([
           'caption' => 'required',
           'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(900,900);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(Post $post) {
        $liked = Like::where(['post_id' => $post->id, 'user_id' => auth()->user()->id])->get()->isNotEmpty(); // Лайкнут ли пользователем пост
        return view('posts.show', compact('post', 'liked'));

    }
}
