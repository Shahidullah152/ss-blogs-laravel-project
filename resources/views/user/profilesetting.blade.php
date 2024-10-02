@extends('layout.layout');

@section('posts')
    <div class="container">
        <div class="row text-center">
            <div class="col-md-7 offset-md-2 p-2 shadow" id="profile-form">
                <div class="col-md-12">
                    @if (session('profileSuccess'))
                        <div class="alert alert-success">
                            {{ session('profileSuccess') }}
                        </div>
                    @endif
                </div>
                <div class="col-md-12">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <div class="profile-img my-3">
                    <img src="{{ asset('/storage/' . $users->userImage) }}" alt="Profile Img"
                        class="img-fluid w-50 img-thumbnail mt-2" id="profile-img">
                </div>
                <form action="{{ route('user.update', $users->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="password" name="password" placeholder="Password"
                        class="form-control mt-2 @error('password')
                    is-invalid
                        @enderror">
                    <hr>
                    <input type="file" id="profileInput"
                        class="form-control mt-2 @error('profileImg')
                    is-invalid
                    @enderror"
                        name="profileImg"
                        onchange="document.querySelector('#profile-img').src=window.URL.createObjectURL(this.files[0])">
                    <button type="submit" class="btn btn-success mt-2 w-50 py-2 fw-bolder">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
