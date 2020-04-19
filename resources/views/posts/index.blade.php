@extends('layouts.app')

@section('content')
    <div class="container m-auto">
        @foreach($posts as $post)
            <div class="row mt-5">
                <div class="col-5 offset-2">
                    <a href="/p/{{ $post->id }}">
                        <img src="/storage/{{ $post->image }}" alt="" class="w-100" style="max-width: 550px;">
                    </a>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="font-weight-lighter post-date pt-1"> {{ date('j F', strtotime($post->created_at)) }}</div>
                        <div class="d-flex align-items-center">
                            <span class="font-weight-lighter mr-4 post-small-text" id="js-like-counter">{{ $post->likes->count() }} likes</span>
                            <span class="font-weight-lighter post-small-text">{{ $post->comments->count() }} comments</span>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="d-flex align-items-center mb-2">
                        <a href="/profile/{{ $post->user->profile->id }}" class="font-weight-bold" style="color: #000; text-outline: none; text-decoration: none">
                        <img src="/storage/{{ $post->user->profile->image }}" alt="" class="w-100 rounded-circle mr-2 "
                             style="max-width: 60px;">
                        <span>{{ $post->user->username }}</span>
                        </a>
                    </div>

                    <hr>

                    <div>
                        <p><span class="mr-2"><a href="/profile/{{ $post->user->profile->id }}" class="font-weight-bold"
                                                 style="color: #000; text-outline: none; text-decoration: none">{{ $post->user->username }}</a></span>{{ $post->caption }}
                        </p>
                    </div>

                </div>
            </div>
        @endforeach
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center mt-4"> {{ $posts->links() }} </div>
                </div>
            </div>
    </div>
@endsection
