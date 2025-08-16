<?php

// app/Models/Comment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = [
        'user_id', 'iso_id', 'process_id', 'task_id', 'comment', 'created_at'
    ];

    // Relación con el usuario (pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el archivo ISO (pertenece a un archivo ISO)
    public function iso()
    {
        return $this->belongsTo(ISO::class);
    }

    // Relación con el proceso (pertenece a un proceso)
    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    // Relación con la tarea (pertenece a una tarea)
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // Verificar si el comentario fue creado por un administrador
    public function isAdminComment()
    {
        return $this->user->isAdmin();
    }
}
