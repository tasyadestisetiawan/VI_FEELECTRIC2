<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Courses;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 2 courses
        Courses::create([
            'name' => 'Bikin Kopi Dengan Rasa',
            'description' => 'Kursus ini akan mengajarkan cara membuat kopi dengan rasa yang berbeda',
            'date' => '2024-05-25 06:21:21',
            'image' => 'courses-1.jpg',
            'video' => 'https://youtu.be/ReIHzl3CTN4?si=mvHLf_uwTi5klcGn',
            'price' => '0',
            'kuota' => '100',
            'duration' => '1 month',
            'level' => 'beginner',
        ]);

        Courses::create([
            'name' => 'Bikin Kopi Dengan Logika',
            'description' => 'Kursus ini akan mengajarkan cara membuat kopi dengan logika yang berbeda',
            'date' => '2024-05-25 06:21:21',
            'image' => 'courses-2.jpg',
            'video' => 'https://youtu.be/ReIHzl3CTN4?si=mvHLf_uwTi5klcGn',
            'price' => '100000',
            'kuota' => '50',
            'duration' => '1 month',
            'level' => 'intermediate',
        ]);
    }
}
