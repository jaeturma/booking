<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            PositionsSeeder::class,
            OfficesAndServicesSeeder::class,
            SurveyQuestionsSeeder::class,
            UsersSeeder::class,
        ]);
    }
}
