<?php

namespace Database\Seeders;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department = DB::table('departments')->where('name', 'HR')->first();
$designation = DB::table('designations')->where('name', 'HR Manager')->where('department_id', $department->department_id)->first();
DB::table('employees')->insert([
    'firstName' => 'Ali',
    'lastName' => 'Hassan',
    'gender' => 'male',
    'email' => 'ali@gmail.com',
    'phoneNumber' => '1234567890',
    'address' => '123 Main St',
    'salary' => '70000',
    'is_active' => 1,
    'join_date' => '2022-01-01',
    'department_id' => $department->department_id,
    'designation_id' => $designation->designation_id,
]);
    }
}
