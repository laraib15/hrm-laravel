<?php

namespace Database\Seeders;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $marketing_id = DB::table('departments')->where('name', 'Marketing')->value('department_id');
        $hr_id = DB::table('departments')->where('name', 'HR')->value('department_id');
        $finance_id = DB::table('departments')->where('name', 'Finance')->value('department_id');
        $it_id = DB::table('departments')->where('name', 'IT')->value('department_id');
        $operations_id = DB::table('departments')->where('name', 'Operations')->value('department_id');

DB::table('designations')->insert([
    [
        'name' => 'Marketing Manager',
        'description' => 'Manages the marketing department',
        'department_id' => $marketing_id

    ],
    [
        'name' => 'Marketing Coordinator',
        'description' => 'Coordinates marketing efforts',
        'department_id' => $marketing_id

    ],
    [
        'name' => 'Digital Marketing Manager',
        'description' => 'responsible for overall digital marketing strategy',
        'department_id' => $marketing_id

    ],
    [
        'name' => 'HR Manager',
        'description' => 'Manages the human resources department',
        'department_id' => $hr_id

    ],
    [
        'name' => 'HR Coordinator',
        'description' => 'Coordinates human resources efforts',
        'department_id' => $hr_id

    ],
    [
        'name' => 'Finance Manager',
        'description' => 'Manages the finance department',
        'department_id' => $finance_id

    ],
    [
        'name' => 'Finance Analyst',
        'description' => 'Analyses financial data',
        'department_id' => $finance_id

    ],
    [
        'name' => 'IT Manager',
        'description' => 'Manages the IT department',
        'department_id' => $it_id

    ],
    [
        'name' => 'IT Analyst',
        'description' => 'Analyses IT data',
        'department_id' => $it_id

    ],
    [
        'name' => 'Graphic Designer',
        'description' => 'Designs graphics for the company',
        'department_id' => $it_id

    ],
    [
        'name' => 'Developer',
        'description' => 'Develops software solutions',
        'department_id' => $it_id

    ],
    [
        'name' => 'Operations Manager',
        'description' => 'oversee operational activities',
        'department_id' => $operations_id

    ],
    [
        'name' => 'Production Manager',
        'description' => 'oversees the production process',
        'department_id' =>$operations_id,

    ],
]);
    }
}
