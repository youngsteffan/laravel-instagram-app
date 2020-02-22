@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row m-auto">
            <div class="col-3 p-5">
                <img src="{{$user->profile->profileImage()}}"
                     class="rounded-circle w-100" alt="">
            </div>
            <div class="col-9 pt-5">
                <div class="d-flex justify-content-between align-items-baseline">
                    <div class="d-flex align-items-center mb-2">
                        <h2>{{$user->username}}</h2>
                        @cannot('update', $user->profile)
                        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                        @endcannot
                    </div>
                    @can('update', $user->profile)
                    <a href="/p/create">Add new post</a>
                    @endcan
                </div>

                @can('update', $user->profile)
                <div>
                    <a href="/profile/{{$user->id}}/edit">Edit profile</a>
                </div>
                @endcan


                <div class="d-flex">
                    <div class="pr-3" ><strong>{{ $user->posts->count() }}</strong> posts</div>
                    <div class="pr-3" ><strong id="followers">{{ $user->profile->followers->count() }}</strong> <a href="/profile/{{ $user->id }}/followers" style="color: #000; text-outline: none; text-decoration: none">followers</a></div>
                    <div class="pr-3"><strong>{{ $user->following->count() }}</strong> <a href="/profile/{{ $user->id }}/followings" style="color: #000; text-outline: none; text-decoration: none">following</a></div>
                </div>

                <div class="pt-4 pb-1 font-weight-bold">{{$user->profile->title}}</div>
                <div class="pb-1">
                    {{$user->profile->description}}
                </div>
                <div><a href="#">{{$user->profile->url}}</a></div>
            </div>
        </div>

        <div class="row pt-4">

            @foreach($user->posts as $post)
                    <div class="col-4 pb-4">
                        <a href="/p/{{ $post->id }}">
                            <img src="/storage/{{ $post->image }}" alt="" class="w-100" style="max-width: 550px;">
                        </a>
                    </div>
            @endforeach

        </div>

    </div>
@endsection
