<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Clear Spatie permission cache
        app()['cache']->forget('spatie.permission.cache');

        DB::table('roles')->insertOrIgnore([
        [
            'id' => 1,
            'name' => 'admin',
            'guard_name' => 'web',
            'created_at' => '2025-08-23 11:02:06',
            'updated_at' => '2025-08-23 11:02:06'
        ],
        [
            'id' => 2,
            'name' => 'validator',
            'guard_name' => 'web',
            'created_at' => '2025-08-23 11:02:06',
            'updated_at' => '2025-08-23 11:02:06'
        ],
        [
            'id' => 3,
            'name' => 'employee',
            'guard_name' => 'web',
            'created_at' => '2025-08-23 11:02:06',
            'updated_at' => '2025-08-23 11:02:06'
        ],
        [
            'id' => 4,
            'name' => 'ca',
            'guard_name' => 'web',
            'created_at' => null,
            'updated_at' => null
        ],
        [
            'id' => 5,
            'name' => 'superadmin',
            'guard_name' => 'web',
            'created_at' => '2025-08-23 11:02:06',
            'updated_at' => '2025-08-23 11:02:06'
        ]
        ]);

        DB::table('permissions')->insertOrIgnore([
        [
            'id' => 1,
            'name' => 'validate bookings',
            'guard_name' => 'web',
            'created_at' => '2025-08-23 11:02:06',
            'updated_at' => '2025-08-23 11:02:06'
        ],
        [
            'id' => 2,
            'name' => 'issue certificates',
            'guard_name' => 'web',
            'created_at' => '2025-08-23 11:02:06',
            'updated_at' => '2025-08-23 11:02:06'
        ],
        [
            'id' => 3,
            'name' => 'manage offices',
            'guard_name' => 'web',
            'created_at' => '2025-08-23 11:02:06',
            'updated_at' => '2025-08-23 11:02:06'
        ],
        [
            'id' => 4,
            'name' => 'manage services',
            'guard_name' => 'web',
            'created_at' => '2025-08-23 11:02:06',
            'updated_at' => '2025-08-23 11:02:06'
        ],
        [
            'id' => 5,
            'name' => 'manage survey questions',
            'guard_name' => 'web',
            'created_at' => '2025-08-23 11:02:06',
            'updated_at' => '2025-08-23 11:02:06'
        ]
        ]);

        DB::table('role_has_permissions')->insertOrIgnore([
        [
            'permission_id' => 1,
            'role_id' => 1
        ],
        [
            'permission_id' => 2,
            'role_id' => 1
        ],
        [
            'permission_id' => 3,
            'role_id' => 1
        ],
        [
            'permission_id' => 4,
            'role_id' => 1
        ],
        [
            'permission_id' => 5,
            'role_id' => 1
        ],
        [
            'permission_id' => 1,
            'role_id' => 2
        ],
        [
            'permission_id' => 2,
            'role_id' => 4
        ],
        // superadmin gets all permissions
        ['permission_id' => 1, 'role_id' => 5],
        ['permission_id' => 2, 'role_id' => 5],
        ['permission_id' => 3, 'role_id' => 5],
        ['permission_id' => 4, 'role_id' => 5],
        ['permission_id' => 5, 'role_id' => 5],
        ]);
    }
}