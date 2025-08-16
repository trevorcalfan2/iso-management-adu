<?php
// app/Http/Controllers/ConfigurationController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    // Mostrar la página de configuración
    public function index()
    {
        // Aquí puedes cargar configuraciones almacenadas en la base de datos o un archivo
        $config = config('app');  // Ejemplo: cargar configuración general de Laravel

        return view('configuration.index', compact('config'));
    }

    // Mostrar el formulario para editar la configuración
    public function edit()
    {
        // Obtener configuraciones del sistema para editarlas
        return view('configuration.edit');
    }

    // Actualizar la configuración
    public function update(Request $request)
    {
        // Validación de los campos que se actualizarán
        $request->validate([
            'setting_name' => 'required|string|max:255',
            'setting_value' => 'required|string',
        ]);

        // Aquí guardarías los cambios en la base de datos o en un archivo de configuración
        // Por ejemplo, guardar en una tabla 'settings' o modificar el archivo config/app.php

        // Ejemplo de actualización de un parámetro de configuración
        config([ 'app.name' => $request->setting_value ]);

        // Retornar un mensaje de éxito
        return redirect()->route('configuration.index')->with('success', 'Configuración actualizada exitosamente');
    }
}
