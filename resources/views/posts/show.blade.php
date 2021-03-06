@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-6 offset-1">
                <img src="/storage/{{ $post->image }}" alt="" class="w-100" style="max-width: 550px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="font-weight-lighter post-date pt-1"> {{ date('j F Y', strtotime($post->created_at)) }}</div>
                    <div class="d-flex align-items-center">
                        <span class="font-weight-lighter mr-2 post-date" id="js-like-counter">{{ $post->likes->count() }} likes</span>
                        <like-button post-id="{{ $post->id }}" liked="{{ $liked }}"></like-button>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="d-flex align-items-center mb-2">
                    <img src="/storage/{{ $post->user->profile->image }}" alt="" class="w-100 rounded-circle mr-2"
                         style="max-width: 60px;">
                    <a href="/profile/{{ $post->user->profile->id }}" class="font-weight-bold"
                       style="color: #000; text-outline: none; text-decoration: none">{{ $post->user->username }}</a>
                    {{--<a href="" class="pl-2 font-weight-bold">Follow</a>--}}
                    @can('update', $post->user->profile)
                        <form action="/p/{{ $post->id }}" method="post" class="delete-form" style="margin-left: 50%; ">
                            @csrf
                            @method('DELETE')
                            <a href="#" class="js-delete-post" style="color: black;"><i class="fas fa-times"></i></a>
                        </form>
                    @endcan
                </div>
                <hr>
                <div>
                    <p>
                        <span class="mr-2">
                            <a href="/profile/{{ $post->user->profile->id }}" class="font-weight-bold" style="color: #000; text-outline: none; text-decoration: none">{{ $post->user->username }}</a>
                        </span>{{ $post->caption }}
                    </p>
                </div>

                <div>
                    @comments(['model' => $post])
                </div>

            </div>
        </div>
    </div>

@endsection
