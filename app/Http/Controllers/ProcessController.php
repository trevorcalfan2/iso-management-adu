<?php
// app/Http/Controllers/ProcessController.php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    // Mostrar la lista de procesos
    public function index()
    {
        $processes = Process::all();
        return view('processes.index', compact('processes'));
    }

    // Mostrar el formulario para crear un nuevo proceso
    public function create()
    {
        $roles = Role::all();  // Roles que se pueden asociar a los procesos
        return view('processes.create', compact('roles'));
    }

    // Almacenar un nuevo proceso
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:processes',
            'description' => 'nullable|string',
        ]);

        // Crear un nuevo proceso
        $process = Process::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Asignar roles al proceso
        $process->roles()->sync($request->roles);

        return redirect()->route('processes.index');
    }

    // Mostrar el formulario para editar un proceso
    public function edit($id)
    {
        $process = Process::findOrFail($id);
        $roles = Role::all();
        return view('processes.edit', compact('process', 'roles'));
    }

    // Actualizar un proceso
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:processes,name,' . $id,
            'description' => 'nullable|string',
        ]);

        // Actualizar proceso
        $process = Process::findOrFail($id);
        $process->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Actualizar roles asociados al proceso
        $process->roles()->sync($request->roles);

        return redirect()->route('processes.index');
    }

    // Eliminar un proceso
    public function destroy($id)
    {
        $process = Process::findOrFail($id);
        $process->delete();
        return redirect()->route('processes.index');
    }
}
