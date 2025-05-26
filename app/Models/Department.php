<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    //protected $table='department';
    protected $primaryKey='department_id';
   // protected $fillable = ['name','email'];

   public function employee()
   {
       return $this->hasMany(Employee::class,'department_id');
   }
   public function designation()
   {
       return $this->hasMany(Designation::class,'department_id');
   }



}
