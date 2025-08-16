<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Muestra el formulario de registro para un administrador.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Registra un nuevo usuario como administrador.
     */
    public function register(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Crear el usuario como administrador
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => true,  // Establecer como administrador
        ]);

        // Autenticar al usuario después de registrarlo
        auth()->login($user);

        return redirect()->route('dashboard')->with('status', 'Bienvenido, Administrador!');
    }
}
