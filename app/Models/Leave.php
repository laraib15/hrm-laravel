<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $primaryKey='leave_id';
    use HasFactory;
    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
