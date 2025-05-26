<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_id = DB::table('roles')->where('name', 'Admin')->value('id');
        $employee = DB::table('employees')->where('email', 'ali@gmail.com')->first();
        DB::table('users')->insert([
            [
                'name' =>$employee->firstName,
                'email'=>'admin@admin.com',
                'password' => Hash::make('password'),
                'role_id'=> $role_id,
                'employee_id'=> $employee->employee_id,
            ],
        ]);
    }
}
