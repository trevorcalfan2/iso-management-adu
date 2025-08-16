<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\ISO;
use App\Models\Task;
use App\Models\Notification;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener los conteos generales
        $users_count = User::count();
        $roles_count = Role::count();
        $isos_count = ISO::count();
        $tasks_count = Task::where('status', 'pending')->count();

        // Obtener los últimos 5 usuarios y archivos ISO
        $recent_users = User::latest()->take(5)->get();
        $recent_isos = ISO::latest()->take(5)->get();

        // Retornar la vista del dashboard con los datos
        return view('dashboard', compact('users_count', 'roles_count', 'isos_count', 'tasks_count', 'recent_users', 'recent_isos'));
    }
}
