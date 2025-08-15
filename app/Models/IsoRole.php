<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IsoRole extends Model
{
    protected $table = 'iso_roles';
    protected $fillable = ['code','label'];
}
