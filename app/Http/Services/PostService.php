<?php


namespace App\Http\Services;


use App\EloquentQueries\PostQueries;
use App\EloquentQueries\UserQueries;
use App\Post;
use Intervention\Image\Facades\Image;

class PostService
{

    private $postQueries;
    private $userQueries;

    public function __construct(PostQueries $postQueries, UserQueries $userQueries)
    {
        $this->postQueries = $postQueries;
        $this->userQueries = $userQueries;
    }

    public function getPosts()
    {
        $users = $this->userQueries->getUserFollowingsIds();
        return $users->isEmpty() ? $this->postQueries->getLatestPosts() : $this->postQueries->getUsersLatestPosts($users);
    }

    public function createPost($data)
    {
        $imagePath = request('image')->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(900,900);
        if ($image->save()) {
            return $this->postQueries->storePost($data, $imagePath);
        }
        return false;
    }

}
