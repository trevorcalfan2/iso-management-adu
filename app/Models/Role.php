<?php
// app/Models/Role.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = [
        'name', 'description', 'permissions'
    ];

    // Relación con usuarios (muchos a muchos)
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user')->withTimestamps();
    }

    // Método para verificar si el rol tiene un permiso específico
    public function hasPermission($permission)
    {
        return in_array($permission, $this->permissions);
    }

    // Aquí puedes agregar métodos para gestionar permisos
    public function addPermission($permission)
    {
        if (!$this->hasPermission($permission)) {
            $permissions = $this->permissions;
            $permissions[] = $permission;
            $this->permissions = $permissions;
            $this->save();
        }
    }

    public function removePermission($permission)
    {
        if ($this->hasPermission($permission)) {
            $permissions = array_diff($this->permissions, [$permission]);
            $this->permissions = $permissions;
            $this->save();
        }
    }
}
