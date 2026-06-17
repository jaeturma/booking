<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Office;
use App\Models\Position;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $itPosition     = Position::where('name', 'IT Officer')->first();
        $adminPosition  = Position::where('name', 'Administrative Officer')->first();
        $recordPosition = Position::where('name', 'Records Officer')->first();

        // ----------------------------------------------------------------
        // System-wide admin — no office, full access to everything
        // ----------------------------------------------------------------
        $admin = User::firstOrCreate(
            ['email' => 'admin@book.app'],
            [
                'name'        => 'System Administrator',
                'password'    => Hash::make('password'),
                'employee_no' => '0000001',
                'position_id' => $itPosition?->id,
            ]
        );
        $admin->syncRoles(['admin']);

        // ----------------------------------------------------------------
        // Admin Office — internal office that issues and prints COA
        // Not shown in kiosk (no show_order)
        // ----------------------------------------------------------------
        $adminOffice = Office::firstOrCreate(
            ['name' => 'Admin Office'],
            ['district' => 'Division Office', 'main' => true]
        );

        // "useradmin" account — administration role, redirected to COA dashboard on login
        $useradmin = User::firstOrCreate(
            ['email' => 'useradmin@book.app'],
            [
                'name'        => 'User Admin',
                'password'    => Hash::make('password'),
                'employee_no' => '0000002',
                'office_id'   => $adminOffice->id,
                'position_id' => $recordPosition?->id,
            ]
        );
        $useradmin->syncRoles(['administration']);

        // Second administration account for the admin office
        $adminStaff = User::firstOrCreate(
            ['email' => 'adminoffice@book.app'],
            [
                'name'        => 'Admin Office Staff',
                'password'    => Hash::make('password'),
                'employee_no' => '0000003',
                'office_id'   => $adminOffice->id,
                'position_id' => $adminPosition?->id,
            ]
        );
        $adminStaff->syncRoles(['administration']);

        // ----------------------------------------------------------------
        // One validator account per public-facing DepEd division office
        // ----------------------------------------------------------------
        $officeAccounts = [
            'SDS Office'              => ['email' => 'sds@book.app',        'employee_no' => '0000004'],
            'CID'                     => ['email' => 'cid@book.app',        'employee_no' => '0000005'],
            'SGOD'                    => ['email' => 'sgod@book.app',       'employee_no' => '0000006'],
            'Administrative Division' => ['email' => 'admindiv@book.app',   'employee_no' => '0000007'],
            'HRMD'                    => ['email' => 'hrmd@book.app',       'employee_no' => '0000008'],
            'Budget and Finance'      => ['email' => 'budget@book.app',     'employee_no' => '0000009'],
            'Records Section'         => ['email' => 'records@book.app',    'employee_no' => '0000010'],
            'ICT Unit'                => ['email' => 'ict@book.app',        'employee_no' => '0000011'],
            'Legal Unit'              => ['email' => 'legal@book.app',      'employee_no' => '0000012'],
            'Planning and Research'   => ['email' => 'planning@book.app',   'employee_no' => '0000013'],
        ];

        foreach ($officeAccounts as $officeName => $account) {
            $office = Office::where('name', $officeName)->first();
            if (! $office) {
                continue;
            }

            $user = User::firstOrCreate(
                ['email' => $account['email']],
                [
                    'name'        => $officeName . ' Staff',
                    'password'    => Hash::make('password'),
                    'employee_no' => $account['employee_no'],
                    'office_id'   => $office->id,
                    'position_id' => $adminPosition?->id,
                ]
            );
            $user->syncRoles(['validator']);
        }
    }
}
