<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\EmployeeCode;

class AuthController extends Controller
{
    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Registrar usuario
    public function register(Request $request)
    {
        // Validación
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'code' => 'required|exists:employee_codes,code',
            'password' => 'required|min:6|confirmed',
        ], [
            'email.unique' => 'El correo ya está registrado.',
            'code.exists' => 'El código no es válido.',
        ]);

        // Buscar código
        $employeeCode = EmployeeCode::where('code', $request->code)->firstOrFail();

        // Validar si ya fue usado
        if ($employeeCode->is_used) {
            return back()->withErrors([
                'code' => 'Este código ya ha sido utilizado.'
            ])->withInput();
        }

        // Crear usuario
        $user = new User();
        $user->email = $request->email;
        $user->employee_code_id = $employeeCode->id;
        $user->password = Hash::make($request->password);
        $user->save();

        // Marcar código como usado
        $employeeCode->is_used = true;
        $employeeCode->save();

        // Mensaje de éxito
        Session::flash('success', 'Registrado con éxito. Inicia sesión.');

        return redirect()->route('login');
    }

    // Mostrar login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Login (por si no lo tenías)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard'); // cambia si quieres
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
