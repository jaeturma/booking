<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SurveyQuestionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('survey_questions')->insertOrIgnore([
        [
            'id' => 1,
            'question' => 'I spent an acceptable amount of time to complete my transaction (Responsiveness)',
            'order' => 1,
            'active' => 1
        ],
        [
            'id' => 2,
            'question' => 'The office accurately informed and followed the transaction\'s requirements and steps (Reliability)',
            'order' => 2,
            'active' => 1
        ],
        [
            'id' => 3,
            'question' => 'My transaction (including steps and payment) was simple and convenient (Access and Facilities)',
            'order' => 3,
            'active' => 1
        ],
        [
            'id' => 4,
            'question' => 'I easily found information about my transaction from the office or its website (Communication)',
            'order' => 4,
            'active' => 1
        ],
        [
            'id' => 5,
            'question' => 'I paid an acceptable amount of fees for my transaction (Costs)',
            'order' => 5,
            'active' => 1
        ],
        [
            'id' => 6,
            'question' => 'I am confident my transaction was secure (Integrity)',
            'order' => 6,
            'active' => 1
        ],
        [
            'id' => 7,
            'question' => 'The office\'s support was quick to respond (Assurance)',
            'order' => 7,
            'active' => 1
        ],
        [
            'id' => 8,
            'question' => 'I got what I needed from the government office (Outcome)',
            'order' => 8,
            'active' => 1
        ]
        ]);
    }
}