<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
            'name' =>'Admin',
            'description' =>'manage the whole HRM system'
        ],

        [ 'name' =>'Staff',
        'description' =>'staff can only manage his account'
    ],
        ]);
    }
}
