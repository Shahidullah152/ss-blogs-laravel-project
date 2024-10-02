<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SS BLOGS - Login</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            font-size: 5vw;
        }

        p {
            font-size: 2.5vw;
            font-weight: bold;
            /* width: 600px; */
        }

        input {
            border: none;
            outline: none;
            padding: 10px 20px;
            border: 1px solid blue;
            border-radius: 10px;
        }

        input:focus {
            /* outline: 1px solid blue; */
            box-shadow: 0px 0px 10px rgba(117, 117, 163, 0.473);
        }

        #form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .form-col {
            border-radius: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-lg-2">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="col-md-7 text-center">
                <img src="{{ asset('img/logo.png') }}" class="img-fluid" width="250px" alt="">
                <p>
                    Enter Your New Password For : <span class="text-primary">SS BLOGS</span>
                </p>
            </div>
            <div class="col-md-5 shadow-lg form-col">
                <div class="text-center">
                    <h4 class="text-primary fs-1 fw-bold">Reset Password</h4>
                    <span class="text-secondary">For : <b class="text-success">SS Blogs</b></span>
                </div>

                <form action="{{ route('resetPasswordProcess') }}" id="form" class="py-4 px-2" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="text" class="@error('new_password') is-invalid @enderror form-control py-2"
                        name="new_password" placeholder="New Password">
                    @error('new_password')
                        <span class="text-danger invalid-feedback">{{ $message }}</span>
                    @enderror
                    <input type="text"
                        class="@error('new_password_confirmation') is-invalid @enderror form-control py-2"
                        name="new_password_confirmation" placeholder="Confirm Password">
                    @error('new_password_confirmation')
                        <span class="text-danger invalid-feedback">{{ $message }}</span>
                    @enderror
                    <input type="submit" class="btn btn-primary py-2 fw-bolder fs-4" value="Reset">
                    <a href="{{ route('login.page') }}" class="text-decoration-none text-center">login
                        ?</a>
                    <hr>
                    <a href="{{ route('registerPage') }}" class="btn btn-success fs-5 fw-bold py-2">
                        Create New Accounts
                    </a>
                </form>
            </div>
        </div>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>