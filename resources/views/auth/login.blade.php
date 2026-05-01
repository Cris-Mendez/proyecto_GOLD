<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Login - GOLD CLUB</title>
</head>

<body class="bg-custom">
    <div class="container">
        <h2 class="header-title">GOLD<br>CLUB</h2>

        @if ($errors->has('loginError'))
            <div class="error">{{ $errors->first('loginError') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required autofocus>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="button-container">
                <button type="submit" class="btn-primary">SIGN IN</button>
                <a href="{{ route('register') }}" class="btn-primary">SIGN UP</a>
            </div>
        </form>
    </div>
</body>

</html>
