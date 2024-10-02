<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget Password Email</title>
</head>

<body>

    <h1>Hello, {{ $formData['user']->userName }}</h1>

    <h3>
        {{ $formData['mailSubject'] }}
    </h3>

    <p>
        You have requested to reset your password. Please click on the link below to reset your password.
    </p>

    <a href="{{ route('resetPassword', $formData['token']) }}">
        <button>Click Hare</button>
    </a>

</body>

</html>
