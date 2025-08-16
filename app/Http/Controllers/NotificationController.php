<?php

// app/Http/Controllers/NotificationController.php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Mostrar la lista de alertas
    public function index()
    {
        $notifications = Notification::all();
        return view('notifications.index', compact('notifications'));
    }

    // Mostrar el formulario para crear una nueva alerta
    public function create()
    {
        return view('notifications.create');
    }

    // Almacenar una nueva alerta
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        // Crear una nueva alerta
        Notification::create([
            'message' => $request->message,
            'status' => $request->status,
        ]);

        return redirect()->route('notifications.index');
    }

    // Mostrar el formulario para editar una alerta
    public function edit($id)
    {
        $notification = Notification::findOrFail($id);
        return view('notifications.edit', compact('notification'));
    }

    // Actualizar una alerta
    public function update(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        // Actualizar la alerta
        $notification = Notification::findOrFail($id);
        $notification->update([
            'message' => $request->message,
            'status' => $request->status,
        ]);

        return redirect()->route('notifications.index');
    }

    // Eliminar una alerta
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return redirect()->route('notifications.index');
    }
}
