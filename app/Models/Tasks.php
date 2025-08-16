<?php
// app/Models/Task.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = [
        'user_id', 'process_id', 'iso_id', 'due_date', 'status', 'description'
    ];

    // Relación con usuario (pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con proceso (pertenece a un proceso)
    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    // Relación con archivo ISO (pertenece a un archivo ISO)
    public function iso()
    {
        return $this->belongsTo(ISO::class);
    }

    // Verificar si la tarea está completada
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    // Verificar si la tarea está pendiente
    public function isPending()
    {
        return $this->status === 'pending';
    }

    // Verificar si la tarea está retrasada
    public function isOverdue()
    {
        return $this->due_date < now() && !$this->isCompleted();
    }
}
