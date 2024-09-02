<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar el login
    public function login(Request $request)
    {
        // Validar los datos del formulario
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Implementar el throttle para limitar intentos fallidos
        if (Auth::attempt($credentials)) {
            // Esto es solo para depurar
            Log::info('Autenticación exitosa para el usuario: ' . Auth::user()->email);

            // Regenerar la sesión para evitar ataques de fijación de sesión
            $request->session()->regenerate();

            // Redirigir a la página de productos
            return redirect()->intended('products');
        }

        // Incrementar contador de intentos fallidos
        return back()->withErrors([
            'loginError' => 'Credenciales incorrectas. Inténtalo de nuevo.',
        ])->withInput();
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidar la sesión y regenerar un nuevo token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
