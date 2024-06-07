<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Questions;
use Symfony\Component\Console\Question\Question;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Questions::create([
            'quiz_id'   => 1,
            'question'  => 'Apa jenis kopi yang dihasilkan dari biji kopi yang telah melalui proses pencernaan oleh luwak?',
            'option1'   => 'Gayo',
            'option2'   => 'Toraja',
            'option3'   => 'Luwak',
            'option4'   => 'Mandailing',
            'answer'    => 3,

        ]);

        Questions::create([
            'quiz_id'   => 1,
            'question'  => 'Dari daerah manakah kopi Gayo berasal?',
            'option1'   => 'Aceh',
            'option2'   => 'Sumatera Utara',
            'option3'   => 'Jawa Barat',
            'option4'   => 'Jawa Timur',
            'answer'    => 1,
        ]);

        Questions::create([
            'quiz_id' => 1,
            'question' => 'Apa yang membuat kopi Arabika berbeda dari kopi Robusta?',
            'option1' => 'Harga',
            'option2' => 'Rasa',
            'option3' => 'Warna',
            'option4' => 'Kandungan kafein',
            'answer' => 2,
        ]);

        Questions::create([
            'quiz_id' => 1,
            'question' => 'Metode penyeduhan kopi yang menggunakan air panas yang dituang secara perlahan ke bubuk kopi dalam filter disebut apa?',
            'option1' => 'Espresso',
            'option2' => 'Pour Over',
            'option3' => 'French Press',
            'option4' => 'Aeropress',
            'answer' => 2,
        ]);

        Questions::create([
            'quiz_id' => 1,
            'question' => 'Kopi Bali Kintamani dikenal dengan karakteristik rasa yang seperti apa?',
            'option1' => 'Asam',
            'option2' => 'Manis',
            'option3' => 'Pahit',
            'option4' => 'Gurih',
            'answer' => 1,
        ]);

        Questions::create([
            'quiz_id' => 1,
            'question' => 'Proses pengolahan biji kopi yang langsung dikeringkan dengan daging buahnya disebut apa?',
            'option1' => 'Wet Process',
            'option2' => 'Dry Process',
            'option3' => 'Honey Process',
            'option4' => 'Natural Process',
            'answer' => 4,
        ]);

        Questions::create([
            'quiz_id' => 1,
            'question' => 'Kopi Toraja dikenal dengan rasa yang seperti apa?',
            'option1' => 'Asam',
            'option2' => 'Manis',
            'option3' => 'Pahit',
            'option4' => 'Gurih',
            'answer' => 3,
        ]);

        Questions::create([
            'quiz_id' => 1,
            'question' => 'Apa nama alat penyeduh kopi tradisional dari Italia yang menggunakan tekanan uap?',
            'option1' => 'Espresso Machine',
            'option2' => 'Pour Over',
            'option3' => 'French Press',
            'option4' => 'Aeropress',
            'answer' => 1,
        ]);

        Questions::create([
            'quiz_id' => 1,
            'question' => 'Kopi dengan metode Cold Brew diseduh menggunakan air pada suhu berapa?',
            'option1' => 'Suhu Ruangan',
            'option2' => 'Suhu Panas',
            'option3' => 'Suhu Dingin',
            'option4' => 'Suhu Sejuk',
            'answer' => 4,
        ]);

        Questions::create([
            'quiz_id' => 1,
            'question' => 'Apa nama alat penyaring kopi berbentuk kerucut yang sering digunakan dalam metode Pour Over?',
            'option1' => 'V60',
            'option2' => 'Kalita Wave',
            'option3' => 'Chemex',
            'option4' => 'Aeropress',
            'answer' => 1,
        ]);
    }
}