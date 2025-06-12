<?php

namespace Database\Seeders;
use App\Models\User;
use Spatie\Permission\Models\Role;
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
        // Get or create Admin role
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $employee = DB::table('employees')->where('email', 'ali@gmail.com')->first();
        $user = User::create([
            'name'        => $employee->firstName,
            'email'       => 'admin2@admin.com',
            'password'    => Hash::make('password'),
            'employee_id' => $employee->employee_id,
        ]);
        // Assign role using Spatie
        $user->assignRole($adminRole);
    }
}
