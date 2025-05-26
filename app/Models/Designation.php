<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $primaryKey='designation_id';
    use HasFactory;
    public function employee()
    {
        return $this->hasMany(Employee::class,'designation_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }
}
