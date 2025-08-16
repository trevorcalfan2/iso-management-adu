<?php
// app/Http/Controllers/ISOController.php

namespace App\Http\Controllers;

use App\Models\ISO;
use App\Models\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ISOController extends Controller
{
    // Mostrar la lista de archivos ISO
    public function index()
    {
        $isos = ISO::with('process')->get();
        return view('isos.index', compact('isos'));
    }

    // Mostrar el formulario para crear un nuevo archivo ISO
    public function create()
    {
        $processes = Process::all();
        return view('isos.create', compact('processes'));
    }

    // Almacenar un nuevo archivo ISO
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,docx,doc|max:10240', // Tamaño máximo de 10MB
            'process_id' => 'required|exists:processes,id',
            'expiry_date' => 'required|date|after:today',
        ]);

        // Subir el archivo
        $filePath = $request->file('file')->store('isos', 'public');

        // Crear el archivo ISO
        ISO::create([
            'name' => $request->name,
            'file_path' => $filePath,
            'process_id' => $request->process_id,
            'expiry_date' => $request->expiry_date,
            'status' => 'active',
        ]);

        return redirect()->route('isos.index');
    }

    // Mostrar el formulario para editar un archivo ISO
    public function edit($id)
    {
        $iso = ISO::findOrFail($id);
        $processes = Process::all();
        return view('isos.edit', compact('iso', 'processes'));
    }

    // Actualizar un archivo ISO
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,docx,doc|max:10240',
            'process_id' => 'required|exists:processes,id',
            'expiry_date' => 'required|date|after:today',
        ]);

        $iso = ISO::findOrFail($id);

        // Verificar si se ha subido un nuevo archivo
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('isos', 'public');
            // Eliminar el archivo anterior si existe
            Storage::disk('public')->delete($iso->file_path);
        } else {
            $filePath = $iso->file_path; // Mantener el archivo existente
        }

        // Actualizar el archivo ISO
        $iso->update([
            'name' => $request->name,
            'file_path' => $filePath,
            'process_id' => $request->process_id,
            'expiry_date' => $request->expiry_date,
        ]);

        return redirect()->route('isos.index');
    }

    // Eliminar un archivo ISO
    public function destroy($id)
    {
        $iso = ISO::findOrFail($id);

        // Eliminar el archivo desde el almacenamiento
        Storage::disk('public')->delete($iso->file_path);

        // Eliminar el registro en la base de datos
        $iso->delete();

        return redirect()->route('isos.index');
    }
}
