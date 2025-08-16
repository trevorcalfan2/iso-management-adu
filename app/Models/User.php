<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'name', 'email', 'password', 'is_admin', 'is_active', 'phone', 'cellphone', 
        'gender', 'bio', 'profile_picture', 'area_id', 'roles', 'configuration'
    ];

    // Campos que deben ser ocultos para la serialización
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Cast de tipos de datos
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
        'is_active' => 'boolean',
        'roles' => 'array',
        'configuration' => 'array',
    ];

    // Relación con roles (muchos a muchos)
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user')->withTimestamps();
    }

    // Relación con procesos (muchos a muchos)
    public function processes()
    {
        return $this->belongsToMany(Process::class, 'process_user')->withTimestamps();
    }

    // Relación con archivos ISO (muchos a muchos)
    public function isos()
    {
        return $this->belongsToMany(ISO::class, 'user_iso')->withTimestamps();
    }

    // Relación con tareas (uno a muchos)
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Relación con alertas (uno a muchos)
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Relación con áreas (pertenece a un área específica)
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    // Relación con la configuración personalizada del usuario
    public function configuration()
    {
        return $this->hasOne(Configuration::class);
    }

    // Método para verificar si el usuario tiene un rol específico
    public function hasRole($roleName)
    {
        return $this->roles->contains('name', $roleName);
    }

    // Método para verificar si el usuario está activo
    public function isActive()
    {
        return $this->is_active;
    }

    // Método para verificar si el usuario es un administrador
    public function isAdmin()
    {
        return $this->is_admin;
    }
}
