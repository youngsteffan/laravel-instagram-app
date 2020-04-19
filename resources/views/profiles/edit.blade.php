<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#js-select-profile-image')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@extends('layouts.app')

@section('content')

<div class="container">

    <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-8 m-auto">
                <div class="row"><h2>Edit profile</h2></div>
                <div class="form-group row">
                    <label for="title" class="col-form-label text-md-right">Title</label>
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $user->profile->title }}"  autocomplete="title" autofocus>

                    @error('title')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="description" class="col-form-label text-md-right">Description</label>
                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? $user->profile->description }}"  autocomplete="description" autofocus>

                    @error('description')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="url" class="col-form-label text-md-right">URL</label>
                    <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') ?? $user->profile->url}}"  autocomplete="url" autofocus>

                    @error('url')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="image" class="col-form-label text-md-right">Profile Image</label>
                    <input id="image" type="file" class="form-control-file" name="image" onchange="readURL(this);">

                    @error('image')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-group row">
                    <img src="/storage/{{ $user->profile->image }}" alt="" id="js-select-profile-image" class="w-100" style="max-width: 150px;">
                </div>

                <div class="form-group row mt-2">
                    <button class="btn btn-primary">Save Profile</button>
                </div>
            </div>
        </div>
    </form>

</div>


@endsection
