<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Questions;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 4 Questions for Quiz 1 (about coffee)
        Questions::create([
            'quiz_id' => 1,
            'question' => 'What is the most consumed beverage in the world?',
            'option1' => 'Tea',
            'option2' => 'Water',
            'option3' => 'Coffee',
            'option4' => 'Beer',
            'answer' => 3,
            'score' => 10,
        ]);

        Questions::create([
            'quiz_id' => 1,
            'question' => 'Which country is the largest producer of coffee in the world?',
            'option1' => 'Brazil',
            'option2' => 'Vietnam',
            'option3' => 'Colombia',
            'option4' => 'Ethiopia',
            'answer' => 1,
            'score' => 10,
        ]);

        Questions::create([
            'quiz_id' => 1,
            'question' => 'What is the most expensive coffee in the world?',
            'option1' => 'Kopi Luwak',
            'option2' => 'Black Ivory Coffee',
            'option3' => 'Hacienda La Esmeralda',
            'option4' => 'St. Helena Coffee',
            'answer' => 1,
            'score' => 10,
        ]);

        Questions::create([
            'quiz_id' => 1,
            'question' => 'What is the name of the coffee shop in the TV show "Friends"?',
            'option1' => 'Central Perk',
            'option2' => 'Central Park',
            'option3' => 'Central Perch',
            'option4' => 'Central Park',
            'answer' => 1,
            'score' => 10,
        ]);
    }
}
