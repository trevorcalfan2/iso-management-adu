<?php
// app/Http/Controllers/ISOVersionController.php

namespace App\Http\Controllers;

use App\Models\ISOVersion;
use App\Models\ISO;
use Illuminate\Http\Request;

class ISOVersionController extends Controller
{
    // Mostrar la lista de versiones
    public function index()
    {
        $isoVersions = ISOVersion::all();  // Obtener todas las versiones de ISO
        return view('admin.iso_versions.index', compact('isoVersions'));
    }

    // Mostrar el formulario para crear una nueva versión de ISO
    public function create()
    {
        $isos = ISO::all();  // Obtener todos los archivos ISO
        return view('admin.iso_versions.create', compact('isos'));
    }

    // Almacenar una nueva versión de ISO
    public function store(Request $request)
    {
        $request->validate([
            'iso_id' => 'required|exists:isos,id',
            'version_number' => 'required|string',
            'release_date' => 'required|date',
            'file_path' => 'required|string',
            'changes' => 'nullable|string',
        ]);

        ISOVersion::create($request->all());  // Crear la nueva versión de ISO
        return redirect()->route('admin.iso-versions.index')->with('success', 'Versión de ISO creada con éxito.');
    }

    // Mostrar el formulario para editar una versión de ISO
    public function edit(ISOVersion $isoVersion)
    {
        $isos = ISO::all();  // Obtener todos los archivos ISO
        return view('admin.iso_versions.edit', compact('isoVersion', 'isos'));
    }

    // Actualizar una versión de ISO
    public function update(Request $request, ISOVersion $isoVersion)
    {
        $request->validate([
            'iso_id' => 'required|exists:isos,id',
            'version_number' => 'required|string',
            'release_date' => 'required|date',
            'file_path' => 'required|string',
            'changes' => 'nullable|string',
        ]);

        $isoVersion->update($request->all());  // Actualizar la versión de ISO
        return redirect()->route('admin.iso-versions.index')->with('success', 'Versión de ISO actualizada con éxito.');
    }

    // Eliminar una versión de ISO
    public function destroy(ISOVersion $isoVersion)
    {
        $isoVersion->delete();  // Eliminar la versión de ISO
        return redirect()->route('admin.iso-versions.index')->with('success', 'Versión de ISO eliminada con éxito.');
    }
}
