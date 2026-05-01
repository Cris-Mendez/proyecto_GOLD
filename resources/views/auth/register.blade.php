<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="bg-custom">
    <div class="container">
        <h2 class="header-title">GOLD <br>CLUB</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <input type="email" name="email" id="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <input type="text" id="code" name="code" placeholder="Employee Code" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="Confirm Password" required>
            </div>

            <div class="button-container">
                <button type="submit" class="btn-primary">CHECK IN</button>
                <a href="{{ route('login') }}" class="btn-primary">SIGN IN</a>
            </div>
        </form>
    </div>
</body>

</html>
