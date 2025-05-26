<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $primaryKey='employee_id';


    public function user()
    {
        return $this->hasOne(User::class,'employee_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }
    public function designation()
    {
        return $this->belongsTo(Designation::class,'designation_id');
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class,'employee_id');
    }
    public function leaves()
    {
        return $this->hasMany(Leave::class,'employee_id');
    }
}
