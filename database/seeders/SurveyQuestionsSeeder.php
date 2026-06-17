<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SurveyQuestion;

class SurveyQuestionsSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            "How satisfied are you with the speed of service?",
            "Was the staff polite and helpful?",
            "Was the office clean and organized?",
            "Was the information clear and complete?",
            "How easy was the booking process?",
            "Did you experience any problems?",
            "Would you recommend our service?",
            "Overall, how satisfied are you?"
        ];
        foreach ($questions as $i => $q) {
            SurveyQuestion::updateOrCreate(
                ['question' => $q],
                ['order' => $i + 1, 'active' => true]
            );
        }
    }
}
