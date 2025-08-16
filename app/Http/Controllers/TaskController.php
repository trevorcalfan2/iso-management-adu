<?php
// app/Http/Controllers/TaskController.php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Process;
use App\Models\ISO;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Mostrar la lista de tareas
    public function index()
    {
        $tasks = Task::with(['user', 'process', 'iso'])->get();
        return view('tasks.index', compact('tasks'));
    }

    // Mostrar el formulario para crear una nueva tarea
    public function create()
    {
        $users = User::all();  // Usuarios a los que se pueden asignar tareas
        $processes = Process::all();  // Procesos relacionados con las tareas
        $isos = ISO::all();  // Archivos ISO relacionados con las tareas
        return view('tasks.create', compact('users', 'processes', 'isos'));
    }

    // Almacenar una nueva tarea
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'process_id' => 'required|exists:processes,id',
            'iso_id' => 'required|exists:isos,id',
            'due_date' => 'required|date',
            'status' => 'required|in:pending,completed',
        ]);

        // Crear la tarea
        Task::create([
            'user_id' => $request->user_id,
            'process_id' => $request->process_id,
            'iso_id' => $request->iso_id,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.index');
    }

    // Mostrar el formulario para editar una tarea
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $users = User::all();
        $processes = Process::all();
        $isos = ISO::all();
        return view('tasks.edit', compact('task', 'users', 'processes', 'isos'));
    }

    // Actualizar una tarea
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'process_id' => 'required|exists:processes,id',
            'iso_id' => 'required|exists:isos,id',
            'due_date' => 'required|date',
            'status' => 'required|in:pending,completed',
        ]);

        // Actualizar la tarea
        $task = Task::findOrFail($id);
        $task->update([
            'user_id' => $request->user_id,
            'process_id' => $request->process_id,
            'iso_id' => $request->iso_id,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.index');
    }

    // Eliminar una tarea
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
