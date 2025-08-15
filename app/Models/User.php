<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name','email','password','is_admin','is_active'];
    protected $hidden = ['password','remember_token'];
    protected $casts = [
        'email_verified_at'=>'datetime',
        'is_admin'=>'boolean',
        'is_active'=>'boolean',
    ];

    public function profile(){ return $this->hasOne(UserProfile::class); }

    // relación N-N con iso_roles
    public function isoRoles() {
        return $this->belongsToMany(IsoRole::class, 'user_iso_roles', 'user_id', 'iso_role_id')->withTimestamps();
    }

    public function processRoles(){ return $this->hasMany(UserProcessRole::class); }

    // helpers
    public function hasIsoRoleCode(string $code): bool {
        return $this->isoRoles()->where('code',$code)->exists();
    }

    public function isProcessOwnerOf(int $processId): bool {
        return $this->processRoles()
            ->where('process_id',$processId)
            ->whereHas('role', fn($q)=>$q->where('code','PROCESS_OWNER'))
            ->exists();
    }
}
