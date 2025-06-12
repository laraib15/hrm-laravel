<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
   public function run()
{
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    $modules = [
        'department' => ['view', 'edit'],
        'employee' => ['view', 'edit'],
        'payroll' => ['manage'],
        'roles' => ['manage'],
        'permissions' => ['manage'],
    ];

    foreach ($modules as $module => $actions) {
        foreach ($actions as $action) {
            Permission::firstOrCreate(['name' => "$module.$action"]);
        }
    }

    $admin = Role::firstOrCreate(['name' => 'admin']);
    $admin->syncPermissions(Permission::all());

    $staff = Role::firstOrCreate(['name' => 'staff']);
    $staff->syncPermissions([
        'department.view',
        'employee.view',
    ]);
}
}
