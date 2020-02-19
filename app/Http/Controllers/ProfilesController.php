<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{

    public function index($user)
    {
        $user = User::findOrFail($user);
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        return view('profiles.index', compact('user', 'follows'));

    }


    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));

    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => ['nullable', 'url'],
            'image' => '',
        ]);

        if (request('image')) {

            $imagePath = request('image')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(900,900);
            $image->save();
            $data = array_merge($data, ['image' => $imagePath]);

        }

        auth()->user()->profile->update($data);
        return redirect("/profile/{$user->id}");

    }

    public function followings(User $user)
    {
        $followings = $user->following;
        return view('profiles.followings', compact('followings', 'user'));
    }

    public function followers(User $user)
    {
        $followers = $user->profile->followers;
        return view('profiles.followers', compact('followers', 'user'));
    }


}
