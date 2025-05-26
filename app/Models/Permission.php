<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
   // protected $primaryKey='permission_id';
    use HasFactory;
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
