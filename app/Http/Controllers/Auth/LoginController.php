<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;  // Añadido para manejar la verificación de la contraseña manualmente (opcional)

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar al usuario
        $credentials = $request->only('email', 'password');

        // Si las credenciales no coinciden
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard'); // Redirige al dashboard si es exitoso
        }

        // Si no se autentica, redirige con error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden.',
        ]);
    }
}
