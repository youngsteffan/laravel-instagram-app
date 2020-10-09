<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Services\PostService;
use App\Like;
use App\Post;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class PostsController extends Controller
{

    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = $this->postService->getPosts();
        return view('posts.index', compact('posts'));
    }


    public function create() {
        return view('posts.create');
    }

    public function store(PostRequest $request) {

/*        $data = \request()->validate([
           'caption' => 'required',
           'image' => 'required|image|max:10240'
        ]);*/

        $data = $request->validated();

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id)->withSuccess('Successfully posted');
    }

    public function show(Post $post) {
        $liked = Like::where(['post_id' => $post->id, 'user_id' => auth()->user()->id])->get()->isNotEmpty(); // Лайкнут ли пользователем пост
        return view('posts.show', compact('post', 'liked'));

    }

    public function destroy($id) {
        $post = Post::find($id);
        if (unlink(storage_path('app/public/' . $post->image))) {
            $userId = $post->user_id;
            $post->delete();
            return redirect('/profile/' . $userId)->withSuccess('Post removed');
        }
    }
}
