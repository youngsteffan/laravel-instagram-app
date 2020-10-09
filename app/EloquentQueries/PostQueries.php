<?php


namespace App\EloquentQueries;


use App\Helpers\ConfigHelper;
use App\Post;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class PostQueries
{

    public function getLatestPosts()
    {
        try {
            return Post::where('user_id', '!=' , auth()->user()->id)->with('user')->latest()->get();
        } catch (QueryException $queryException) {
            Log::warning('Error get user', [$queryException]);
            throw new \Exception('Error get user', 503);
        }

    }

    public function getUsersLatestPosts($users)
    {
        try {
            return Post::whereIn('user_id', $users)->latest()->with('user')->get();
        } catch (QueryException $queryException) {
            Log::warning('Error get user', [$queryException]);
            throw new \Exception('Error get user', 503);
        }
    }

    public function storePost($data, $imagePath)
    {
        try {
            return auth()->user()->posts()->create([
                'caption' => $data['caption'],
                'image' => $imagePath,
            ]);
        } catch (QueryException $queryException) {
            Log::warning('Error get user', [$queryException]);
            throw new \Exception('Error get user', 503);
        }
    }


}
