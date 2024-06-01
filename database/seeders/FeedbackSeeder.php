<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Feedback;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 6 feedbacks about Feelectric Coffee Shop
        Feedback::create([
            'user_id' => 2,
            'name'    => 'Tasya Desti',
            'message' => 'I love Feelectric Coffee Shop! The coffee is amazing and the staff is very friendly.',
            'rating'  => 5,
        ]);

        // Nathan
        Feedback::create([
            'user_id' => 1,
            'name'    => 'Nathan',
            'message' => 'I love Feelectric Coffee Shop! The coffee is amazing and the staff is very friendly.',
            'rating'  => 5,
        ]);

        // Rizky
        Feedback::create([
            'user_id' => 1,
            'name'    => 'Rizky',
            'message' => 'I love Feelectric Coffee Shop! The coffee is amazing and the staff is very friendly.',
            'rating'  => 5,
        ]);

        // Dian
        Feedback::create([
            'user_id' => 1,
            'name'    => 'Dian',
            'message' => 'I love Feelectric Coffee Shop! The coffee is amazing and the staff is very friendly.',
            'rating'  => 5,
        ]);

        // Rizal
        Feedback::create([
            'user_id' => 1,
            'name'    => 'Rizal',
            'message' => 'I love Feelectric Coffee Shop! The coffee is amazing and the staff is very friendly.',
            'rating'  => 5,
        ]);

        // Fadil
        Feedback::create([
            'user_id' => 1,
            'name'    => 'Fadil',
            'message' => 'I love Feelectric Coffee Shop! The coffee is amazing and the staff is very friendly.',
            'rating'  => 5,
        ]);
    }
}
