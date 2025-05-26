<?php

namespace Database\Seeders;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            ['name' => 'IT', 'email' => 'it@example.com', 'phoneNumber' => '1234567890', 'description' => 'Information Technology department'],
            ['name' => 'HR', 'email' => 'hr@example.com', 'phoneNumber' => '0987654321', 'description' => 'Human Resources department'],
            ['name' => 'Marketing', 'email' => 'marketing@example.com', 'phoneNumber' => '5678901234', 'description' => 'Marketing department'],
            ['name' => 'Finance', 'email' => 'finance@example.com', 'phoneNumber' => '4321098765', 'description' => 'Finance department'],
            ['name' => 'Operations', 'email' => 'operations@example.com', 'phoneNumber' => '1234506789', 'description' => 'Operations department'],
        ];
        foreach($departments as $department) {
            Department::create($department);
        }
    }

}
