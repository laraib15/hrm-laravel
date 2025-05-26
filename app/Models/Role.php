<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
   //protected $primaryKey='role_id';
    use HasFactory;
    public function users()
{
    return $this->hasMany(User::class);
}
    public function Permissions()
    {
    	return $this->belongsToMany(Permission::class);
    }
}
