@extends('layout.layout');

@section('posts')
    <div class="container">
        <div class="row text-center">
            <div class="col-md-7 offset-md-2 p-2 shadow" id="accountSettingForm">
                <div class="col-md-12">
                    @if (session('accountSuccess'))
                        <div class="alert alert-success">
                            {{ session('accountSuccess') }}
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
                <h4 class=" text-secondary m-3">Change Your Personal information</h4>
                <form class="p-3" action="{{ route('accountSettingProcess', $users->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="password" name="password" placeholder="Password"
                        class="form-control mt-2 @error('password')
                    is-invalid
                        @enderror">
                    <hr>
                    <input type="text" name="userName" placeholder="New : User Name" value="{{ $users->userName }}"
                        class="form-control mt-2 @error('userName')
                    is-invalid
                        @enderror">
                    <input type="text" name="email" placeholder="New : Email" value="{{ $users->email }}"
                        class="form-control mt-2 @error('email')
                    is-invalid
                        @enderror">
                    <input type="date" name="userDateOB"
                        class="form-control mt-2 @error('userDateOB')
                    is-invalid
                        @enderror"
                        value="{{ $users->userDateOB }}">
                    <button type="submit" class="btn btn-success mt-2 w-50 py-2 fw-bolder">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
