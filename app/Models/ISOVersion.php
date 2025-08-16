<?php
// app/Models/ISOVersion.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ISOVersion extends Model
{
    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = [
        'iso_id', 'version_number', 'release_date', 'file_path', 'changes'
    ];

    // Relación con archivo ISO (pertenece a un archivo ISO)
    public function iso()
    {
        return $this->belongsTo(ISO::class);
    }

    // Verificar si la versión está activa
    public function isActive()
    {
        return $this->status === 'active';
    }

    // Verificar si la versión ha expirado
    public function isExpired()
    {
        return $this->release_date < now() && $this->status === 'active';
    }
}
