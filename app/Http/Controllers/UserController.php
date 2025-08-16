<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Mostrar la lista de usuarios
    public function index()
    {
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    // Mostrar el formulario para crear un nuevo usuario
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    // Almacenar un nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Crear usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Asignar roles al usuario
        $user->roles()->sync($request->roles);

        return redirect()->route('users.index');
    }

    // Mostrar el formulario para editar un usuario
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    // Actualizar un usuario
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Actualizar usuario
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        // Actualizar roles
        $user->roles()->sync($request->roles);

        return redirect()->route('users.index');
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}
