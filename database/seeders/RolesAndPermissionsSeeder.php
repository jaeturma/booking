<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'validate bookings',
            'issue certificates',
            'manage offices',
            'manage services',
            'manage survey questions',
        ];
        foreach ($permissions as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }

        $roles = [
            'admin'          => array_column(Permission::all()->toArray(), 'name'),
            'administration' => ['issue certificates', 'validate bookings'],
            'validator'      => ['validate bookings'],
            'employee'       => [],
        ];
        foreach ($roles as $name => $perms) {
            $role = Role::firstOrCreate(['name' => $name]);
            $role->syncPermissions($perms);
        }
    }
}
