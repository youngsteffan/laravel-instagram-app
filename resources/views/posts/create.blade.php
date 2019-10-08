@extends('layouts.app')

@section('content')

<div class="container">

    <form action="/p" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row">
            <div class="col-8 m-auto">
                <div class="row"><h2>Add new post</h2></div>
                <div class="form-group row">
                    <label for="caption" class="col-form-label text-md-right">Post Caption</label>
                    <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}"  autocomplete="caption" autofocus>

                    @error('caption')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="image" class="col-form-label text-md-right">Post Image</label>
                    <input id="image" type="file" class="form-control-file" name="image">

                    @error('image')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-group row mt-2">
                    <button class="btn btn-primary">Add New Post</button>
                </div>
            </div>
        </div>
    </form>

</div>


@endsection