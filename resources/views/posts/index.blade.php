@extends('layouts.app')

@section('content')
    <div class="container m-auto">
        @foreach($posts as $post)
            <div class="row mt-5">
                <div class="col-6 offset-1">
                    <a href="/profile/{{ $post->user->id }}"><img src="/storage/{{ $post->image }}" alt="" class="w-100" style="max-width: 550px;"></a>
                </div>

                <div class="col-4 offset">
                    <div class="d-flex align-items-center mb-2">
                        <img src="/storage/{{ $post->user->profile->image }}" alt="" class="w-100 rounded-circle mr-2"
                             style="max-width: 60px;">
                        <a href="/profile/{{ $post->user->profile->id }}" class="font-weight-bold"
                           style="color: #000; text-outline: none; text-decoration: none">{{ $post->user->username }}</a>
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
