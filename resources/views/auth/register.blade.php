<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
</head>
<body>
    <div class="container">
        <h2>GOLD <br>CLUB</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="email"></label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                @if ($errors->has('email'))
                    <div class="alert alert-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            <div>
                <label for="code"></label>
                <input type="text" id="code" name="code" placeholder="Employee Code" required>
                @if ($errors->has('code'))
                    <div class="alert alert-danger">
                        {{ $errors->first('code') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="password"></label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                @if ($errors->has('password'))
                    <div class="alert alert-danger">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="password_confirmation"></label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" required>
            </div>

            <div class="button-container">
            <button type="submit" class="btn btn-primary">CHECK IN</button>
            <a href="{{ route('login') }}" class="btn btn-secondary">SING IN</a>
            </div>
        </form>
        
    </div>
</body>
</html>
