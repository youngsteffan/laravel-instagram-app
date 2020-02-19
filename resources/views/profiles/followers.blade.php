@extends('layouts.app')

@section('content')

    <div class="container">
        @if (!empty($followers))
            <div class="col-5 offset-2 d-flex justify-content-center">
                <p class="lead"> {{  $user->username }} followers:</p>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-6">
                    <ul class="list-group">
                        @foreach($followers as $follower)

                            <li class="list-group-item">
                                <div class="col-md-12 d-flex justify-content-center">
                                    <div class="col-md-3 my-auto"><img src="/storage/{{ $follower->image }}" alt=""
                                                                       class="rounded-circle w-75"></div>
                                    <div class="col-md-3 my-auto">{{ $follower->user->username }}</div>
                                    <div class="col-md-2 offset-md-4 col my-auto">
                                        <button type="button" class="btn btn-danger py-1 px-2"><small>delete</small></button>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @else
            <div class="row d-flex justify-content-center">
                <div class="col-2 d-flex flex-column justify-content-between">
                    <p class="lead">No followers yet</p>
                    <div><a href="{{ URL::previous() }}">Back</a></div>
                </div>
            </div>
        @endif
    </div>


@endsection
