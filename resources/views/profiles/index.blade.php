@extends('layouts.app')

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#js-select-profile-image')
                    .attr('src', e.target.result)
                    .show();
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function readURLForEdit(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#js-edit-profile-image')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success" onclick="$(this).fadeOut();">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
            </div>
        @endif
        <div class="row m-auto">
            <div class="col-3 p-5">
                <img src="{{$user->profile->profileImage()}}"
                     class="rounded-circle w-100" alt="">
            </div>
            <div class="col-9 pt-5">
                <div class="d-flex justify-content-between align-items-baseline">
                    <div class="d-flex align-items-center mb-2">
                        <h3>{{$user->username}}</h3>
                        @can('update', $user->profile)
                            <i id="edit-icon" data-toggle="modal" data-target="#editProfileModal" class="fas fa-user-edit ml-2"></i>
                        @endcan
                        @cannot('update', $user->profile)
                        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                        @endcannot
                    </div>
                </div>
                <div class="d-flex">
                    <div class="pr-3" ><strong>{{ $user->posts->count() }}</strong> posts</div>
                    <div class="pr-3" ><strong id="followers">{{ $user->profile->followers->count() }}</strong> <a href="/profile/{{ $user->id }}/followers" style="color: #000; text-outline: none; text-decoration: none">followers</a></div>
                    <div class="pr-3"><strong>{{ $user->following->count() }}</strong> <a href="/profile/{{ $user->id }}/followings" style="color: #000; text-outline: none; text-decoration: none">following</a></div>
                </div>

                <div class="pt-4 pb-1 font-weight-bold">{{$user->profile->title}}</div>
                <div class="pb-1">
                    {{$user->profile->description}}
                </div>
                <div><a href="{{$user->profile->url}}">{{$user->profile->url}}</a></div>
            </div>
        </div>
            <hr width="100%">
            @if ($user->posts->isNotEmpty())
                @can('update', $user->profile)
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <a href="" data-toggle="modal" data-target="#addPostModal">
                        <img src="https://img.icons8.com/all/500/add.png" alt="" width="45" height="45">
                    </a>
                </div>
                @endcan
                <div class="row pt-4">
                    @foreach($user->posts as $post)
                            <div class="col-4 pb-4">
                                <a href="/p/{{ $post->id }}">
                                    <img src="/storage/{{ $post->image }}" alt="" class="w-100 profile-image" style="max-width: 550px;">
                                </a>
                            </div>
                    @endforeach
                </div>
                @elseif ($user->id == auth()->user()->id)
                <div class="row pt-4">
                    <div class="col-12 d-flex justify-content-center mb-2">
                        <div>You can upload your first photo</div>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <a href="" data-toggle="modal" data-target="#addPostModal">
                            <img src="https://img.icons8.com/all/500/add.png" alt="" width="45" height="45">
                        </a>
                    </div>
                </div>
                @else
                <div class="row pt-4">
                    <div class="col-12 d-flex justify-content-center mb-2">
                        <div>{{$user->username}} has no published photos yet</div>
                    </div>
                </div>
            @endif
    </div>

    <div class="modal fade bd-example-modal-lg" id="addPostModal" tabindex="-1" role="dialog" aria-labelledby="addPostModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPostModalLabel">New post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/p" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-10 m-auto">
                                <div class="form-group row">
                                    <label for="caption" class="col-form-label text-md-right">Caption</label>
                                    <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}"  autocomplete="caption" autofocus>

                                    @error('caption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label for="image" class="col-form-label text-md-right">Image</label>
                                    <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" onchange="readURL(this);">

                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <img src="" alt="image" id="js-select-profile-image" class="w-100" style="display: none; max-width: 200px;">
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-8 m-auto">
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
                                    <input id="image" type="file" class="form-control-file" name="image" onchange="readURLForEdit(this);">

                                    @error('image')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <img src="/storage/{{ $user->profile->image }}" alt="" id="js-edit-profile-image" class="w-100 rounded-circle" style="max-width: 150px;">
                                </div>

                                <div class="form-group row mt-2">
                                    <button class="btn btn-primary">Save Profile</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
