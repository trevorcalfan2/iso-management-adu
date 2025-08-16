<?php
// app/Http/Controllers/RoleController.php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Mostrar la lista de roles
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    // Mostrar el formulario para crear un nuevo rol
    public function create()
    {
        return view('roles.create');
    }

    // Almacenar un nuevo rol
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
        ]);

        // Crear un nuevo rol
        Role::create([
            'name' => $request->name,
        ]);

        return redirect()->route('roles.index');
    }

    // Mostrar el formulario para editar un rol
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('roles.edit', compact('role'));
    }

    // Actualizar un rol
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
        ]);

        // Actualizar rol
        $role = Role::findOrFail($id);
        $role->update([
            'name' => $request->name,
        ]);

        return redirect()->route('roles.index');
    }

    // Eliminar un rol
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index');
    }
}
