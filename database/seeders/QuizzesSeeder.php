<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quizzes;

class QuizzesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 1 Quiz (about coffee)
        Quizzes::create([
            'title' => 'Coffee Quiz',
            'description' => 'Test your knowledge about coffee',
            'coins' => 100,
        ]);
    }
}
