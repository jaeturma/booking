<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $driver = DB::getDriverName();

        // Disable FK checks so insertOrIgnore works on both MySQL and SQLite
        if ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF');
        } elseif ($driver === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        }

        $this->call([
            RolesAndPermissionsSeeder::class,
            PositionsSeeder::class,
            OfficesAndServicesSeeder::class,
            SurveyQuestionsSeeder::class,
            UsersSeeder::class,
            AppSettingsSeeder::class,
        ]);

        if ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON');
        } elseif ($driver === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }
}