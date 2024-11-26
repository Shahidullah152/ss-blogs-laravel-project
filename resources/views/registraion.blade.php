<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SS BLOGS - Login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="registraion.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #register-form {
            border-radius: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-lg-2 position-absolute top-0">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="col-md-6 offset-md-3 shadow-lg" id="register-form">
                <div class="text-center">
                    <img src="img/logo.png" class="img-fluid" width="100px" height="100px" alt="">

                </div>

                <div class="text-center">
                    <h4 class="text-center text-primary fw-bold">Sign Up</h4>
                </div>
                <hr>
                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" id="form"
                    class="py-4 px-2">
                    @csrf
                    <div class="fullname-box d-flex ">
                        <div class="Fname w-100">
                            <label for="" class="form-label">Full Name</label>
                            <input type="text" value="{{ old('userName') }}" name="userName" placeholder="User Name"
                                class="w-100 form-control mt-2  @error('userName') is-invalid @enderror">
                            @error('userName')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="userEmail w-100 ms-2">
                            <label for="" class="form-label">User Image</label>
                            <input type="file" name="userImage" {{ old('userImage') }}
                                class="w-100 form-control mt-2  @error('userImage') is-invalid @enderror">
                            @error('userImage')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="email-pass-box">
                        <label for="" class="form-label">Email or Number</label>
                        <input type="text" value="{{ old('userEmail') }}" name="userEmail"
                            placeholder="Email or Number"
                            class="form-control mt-2  @error('userEmail') is-invalid @enderror">
                        @error('userEmail')
                            <span>{{ $message }}</span>
                        @enderror
                        <div class="Password d-flex justify-content-between ">
                            <div class="password1 w-100 me-2">
                                <label for="" class="form-label">Password</label>
                                <input type="password" value="{{ old('userPassword') }}" name="userPassword"
                                    placeholder="Password"
                                    class="form-control mt-2  @error('userPassword') is-invalid @enderror">
                                @error('userPassword')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="password2 w-100 ">
                                <label for="" class="form-label">Confirm Password</label>
                                <input type="password" name="userPassword_confirmation" placeholder="Confirm Password"
                                    class="form-control mt-2 @error('userPassword_confirmation') is-invalid @enderror">
                                @error('userPassword_confirmation')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <label for="" class="form-label">Date of Birthd</label>
                        <input type="date" name="userDateOB" placeholder=""
                            class="form-control mt-2 @error('userDateOB') is-invalid @enderror">
                        @error('userDateOB')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-check form-check-inline mt-4">
                        <input class="form-check-input @error('userGander') is-invalid @enderror" type="radio"
                            name="userGander" id="inlineRadio1" value="Male">
                        <label class="form-check-label">Male</label>
                    </div>
                    <div class="form-check form-check-inline mt-4">
                        <input class="form-check-input @error('userGander') is-invalid @enderror" type="radio"
                            name="userGander" id="inlineRadio2" value="Female">
                        <label class="form-check-label">Female</label>
                    </div>
                    <div class="form-check form-check-inline mt-4">
                        <input class="form-check-input @error('userGander') is-invalid @enderror" type="radio"
                            name="userGander" id="inlineRadio3" value="Others">
                        <label class="form-check-label">Others</label>
                    </div>
                    <div class="create-btn text-center mt-2">
                        <input type="submit" class="btn btn-success py-2 px-3  fw-bold" value="Register">

                        <a href="{{ route('login.page') }}" class="btn btn-primary py-2 px-3  fw-bold">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>
