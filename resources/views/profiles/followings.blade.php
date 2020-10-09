@extends('layouts.app')

@section('content')

    <div class="container">
        @if ($followings->isNotEmpty())
        <div class="col-5 offset-2 d-flex justify-content-center">
            <p class="lead"> {{  $user->id == auth()->user()->id ? 'Your' : $user->username}} followings:</p>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <ul class="list-group">
                    @foreach($followings as $following)

                        <li class="list-group-item">
                            <div class="col-md-12 d-flex justify-content-center">
                                <div class="col-md-3 my-auto">
                                    <a href="/profile/{{ $following->user->id }}" class="font-weight-bold"
                                       style="color: #000; text-outline: none; text-decoration: none">
                                        <img src="/storage/{{ $following->image ?: '/profile/default.png'}}" alt=""
                                             class="rounded-circle w-75">
                                    </a>
                                </div>
                                <div class="col-md-3 my-auto">
                                    <a href="/profile/{{ $following->user->id }}"
                                       style="color: #000; text-outline: none; text-decoration: none">
                                        {{ $following->user->username }}
                                    </a>
                                </div>
                                @can('update', $user->profile)
                                    <div class="col-md-2 offset-md-4 col my-auto">
                                        <button type="button" class="btn btn-danger py-1 px-2"><small>delete</small>
                                        </button>
                                    </div>
                                @endcan
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @else
            <div class="row d-flex justify-content-center">
                <div class="col-2 d-flex flex-column justify-content-between">
                    <p class="lead">No followings yet</p>
                    <div><a href="{{ URL::previous() }}">Back</a></div>
                </div>
            </div>
        @endif
    </div>


@endsection
