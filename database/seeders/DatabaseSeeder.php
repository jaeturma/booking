<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            PositionsSeeder::class,
            OfficesAndServicesSeeder::class,
            SurveyQuestionsSeeder::class,
            UsersSeeder::class,
            AppSettingsSeeder::class,
        ]);
    }
}