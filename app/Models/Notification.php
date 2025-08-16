<?php
// app/Models/Notification.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = [
        'user_id', 'message', 'type', 'status', 'related_id', 'related_type'
    ];

    // Relación con el usuario (pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación polimórfica con los modelos relacionados (archivos ISO, procesos, tareas)
    public function related()
    {
        return $this->morphTo();
    }

    // Verificar si la notificación está marcada como leída
    public function isRead()
    {
        return $this->status === 'read';
    }

    // Verificar si la notificación está pendiente
    public function isPending()
    {
        return $this->status === 'pending';
    }
}
