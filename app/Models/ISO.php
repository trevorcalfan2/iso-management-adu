<?php
// app/Models/ISO.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ISO extends Model
{
    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = [
        'name', 'description', 'file_path', 'process_id', 'expiration_date', 'status', 'version'
    ];

    // Relación con procesos (muchos a muchos)
    public function processes()
    {
        return $this->belongsToMany(Process::class, 'process_iso')->withTimestamps();
    }

    // Relación con tareas (muchos a muchos)
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_iso')->withTimestamps();
    }

    // Relación con usuarios (muchos a muchos)
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_iso')->withTimestamps();
    }

    // Relación con versiones de archivo ISO (uno a muchos)
    public function versions()
    {
        return $this->hasMany(ISOVersion::class);
    }

    // Relación con comentarios (uno a muchos)
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relación con alertas (uno a muchos)
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Verificar si el archivo ISO está vencido
    public function isExpired()
    {
        return $this->expiration_date < now() && $this->status === 'active';
    }
}
