<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProcessRole extends Model
{
    protected $fillable = ['user_id','process_id','iso_role_id'];

    public function role() { return $this->belongsTo(IsoRole::class, 'iso_role_id'); }
    public function process() { return $this->belongsTo(Process::class); }
    public function user() { return $this->belongsTo(User::class); }
}
