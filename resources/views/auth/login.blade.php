<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h2>GOLD <br>CLUB</h2>

        @if ($errors->has('loginError'))
        <div class="alert alert-danger">
            {{ $errors->first('loginError') }}
        </div>
    @endif


        <form method="POST" action="{{ route('login') }}">
            @csrf
        
            <div class="form-group">
                <label for="email"></label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required autofocus>
            </div>
        
            <div class="form-group">
                <label for="password"></label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            </div>
        
            <div class="button-container">
            <button type="submit" class="btn btn-primary">SIGN IN</button>

            <a href="{{ route('register') }}" class="btn btn-primary">SIGN UP</a>
            </div>
        </form>  
    </div>
</body>
</html>

