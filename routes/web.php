<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\ISOController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ISOVersionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Mostrar formulario para solicitar el link de restablecimiento
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

// Enviar email con el link
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

// Mostrar formulario para restablecer contraseña usando token
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

// Procesar el cambio de contraseña
Route::post('password/reset', [ResetPasswordController::class, 'reset'])
    ->name('password.update');










// Rutas de configuración del sistema (solo para administradores)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('configuration', [ConfigurationController::class, 'index'])->name('configuration.index');
    Route::get('configuration/edit', [ConfigurationController::class, 'edit'])->name('configuration.edit');
    Route::post('configuration', [ConfigurationController::class, 'update'])->name('configuration.update');
});

// Rutas de gestión de comentarios (solo para administradores o usuarios autorizados)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('comments', CommentController::class);
});

// Rutas de gestión de versiones ISO (solo para administradores)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('iso-versions', ISOVersionController::class);
});

// Rutas de gestión de alertas (solo para administradores)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('notifications', NotificationController::class);
});

// Ruta de login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Ruta del dashboard (solo para usuarios autenticados)
Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Ruta de registro (solo para administradores)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Rutas de gestión de usuarios (solo para administradores)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('users', UserController::class);  // CRUD de usuarios
});

// Rutas de gestión de archivos ISO (solo para administradores)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('isos', ISOController::class);
});

// Rutas de gestión de tareas (solo para administradores)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('tasks', TaskController::class);
});

// Rutas de gestión de procesos (solo para administradores)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('processes', ProcessController::class);
});

// Rutas de gestión de roles (solo para administradores)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('roles', RoleController::class);
});

// Redirigir al login si no está autenticado
Route::get('/', function() {
    return redirect()->route('login');
});

