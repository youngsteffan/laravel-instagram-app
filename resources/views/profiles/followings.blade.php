@extends('layouts.app')

@section('content')

<div class="container">

    <div class="col-5 offset-2 d-flex justify-content-center">
        <p class="lead"> {{  $user->username }} followings:</p>
    </div>
    <div class="row d-flex justify-content-center">
    <div class="col-6">
    <ul class="list-group">
    @foreach($followings as $following)

        <li class="list-group-item">
            <div class="col-md-12 d-flex justify-content-center">
            <div class="col-md-3 my-auto"><img src="/storage/{{ $following->image }}" alt="" class="rounded-circle w-75"></div>
            <div class="col-md-3 my-auto">{{ $following->user->username }}</div>
            <div class="col-md-2 offset-md-4 col my-auto"><button type="button" class="btn btn-danger py-1 px-2"><small>delete</small></button></div>
            </div>
        </li>
    @endforeach
    </ul>
    </div>
    </div>
</div>


@endsection
