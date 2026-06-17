<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionsSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Admin Aide', 'Administrative Officer', 'Records Officer', 'IT Officer'] as $pos) {
            Position::firstOrCreate(['name' => $pos]);
        }
    }
}
