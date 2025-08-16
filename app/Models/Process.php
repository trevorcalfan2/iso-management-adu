<?php
// app/Models/Process.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = [
        'name', 'description', 'status', 'owner_id', 'expiration_date'
    ];

    // Relación con usuarios (muchos a muchos)
    public function users()
    {
        return $this->belongsToMany(User::class, 'process_user')->withTimestamps();
    }

    // Relación con roles (muchos a muchos)
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'process_role')->withTimestamps();
    }

    // Relación con archivos ISO (muchos a muchos)
    public function isos()
    {
        return $this->belongsToMany(ISO::class, 'process_iso')->withTimestamps();
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

    // Método para obtener el propietario del proceso (quien lo lidera)
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Método para verificar si el proceso está activo
    public function isActive()
    {
        return $this->status == 'active';
    }
}
