@extends('layouts.app')

@section('content')
    <div class="container m-auto">
        <div class="row mt-5">
            <div class="col-6 offset-1">
                <img src="/storage/{{ $post->image }}" alt="" class="w-100" style="max-width: 550px;">
            </div>

            <div class="col-4">
                <div class="d-flex align-items-center mb-2">
                    <img src="/storage/{{ $post->user->profile->image }}" alt="" class="w-100 rounded-circle mr-2"
                         style="max-width: 60px;">
                    <a href="/profile/{{ $post->user->profile->id }}" class="font-weight-bold"
                       style="color: #000; text-outline: none; text-decoration: none">{{ $post->user->username }}</a>
                    <a href="" class="pl-2 font-weight-bold">Follow</a>
                </div>

                <hr>

                <div>
                    <p><span class="mr-2"><a href="/profile/{{ $post->user->profile->id }}" class="font-weight-bold"
                                             style="color: #000; text-outline: none; text-decoration: none">{{ $post->user->username }}</a></span>{{ $post->caption }}
                    </p>
                </div>

            </div>
        </div>

    </div>
    </div>
@endsection
