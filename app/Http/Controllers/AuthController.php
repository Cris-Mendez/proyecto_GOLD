<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use App\Models\EmployeeCode;

class AuthController extends Controller
{
    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Registrar un nuevo usuario
public function register(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'email' => 'required|email|unique:users',
        'code' => 'required|exists:employee_codes,code|unique:users,employee_code_id',
        'password' => 'required|min:6|confirmed',
    ], [
        'email.unique' => 'El correo electrónico ya existe en el sistema.',
        'code.exists' => 'El código de empleado no es válido.',
        'code.unique' => 'El código de empleado ya ha sido usado.',
    ]);

    // Obtener el ID del código de empleado
    $employeeCode = EmployeeCode::where('code', $request->code)->first();

    // Crear un nuevo usuario
    $user = new User;
    $user->email = $request->email;
    $user->employee_code_id = $employeeCode->id; // Asignar la relación correctamente
    $user->password = Hash::make($request->password);
    $user->save();

    // Actualizar el estado del código de empleado
    $employeeCode->is_used = true;
    $employeeCode->save();

    // Enviar mensaje de éxito a la sesión
    Session::flash('success', 'Registrado con éxito. Inicie sesión.');

    // Redirigir al formulario de login
    return redirect()->route('login');
}

    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

     // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
  }



