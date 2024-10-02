@extends('layout.layout');

@section('posts')
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6 offset-md-2 p-4 shadow" id="changePasswordForm">
                <div class="col-md-12">
                    @if (session('changeSuccess'))
                        <div class="alert alert-success">
                            {{ session('changeSuccess') }}
                        </div>
                    @endif
                </div>
                <div class="col-md-12">
                    @if (session('changeError'))
                        <div class="alert alert-danger">
                            {{ session('changeError') }}
                        </div>
                    @endif
                </div>
                <h4 class=" text-secondary m-3">Change Your Password</h4>
                <form class="p-3" action="{{ route('changePasswordProcess', Auth::id()) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" name="current_password" placeholder="Current Password"
                        class="form-control mt-2 @error('current_password')
                     is-invalid
                    @enderror">
                    <hr class="text-success">
                    <input type="text" name="new_password" placeholder="New Password"
                        class="form-control mt-2 @error('new_password')
                     is-invalid
                    @enderror">
                    <input type="text" name="new_password_confirmation"
                        class="form-control mt-2 @error('new_password_confirmation')
                     is-invalid
                    @enderror"
                        placeholder="Confirm Password">
                    <button type="submit" class="btn btn-success mt-2 w-50 py-2 fw-bolder">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
