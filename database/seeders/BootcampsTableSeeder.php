<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bootcamp;

class BootcampsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Bootcamp Data
        Bootcamp::create([
            'name'          => 'Membuat Kopi yang Enak',
            'description'   => 'Pelatihan ini akan mengajarkan cara membuat kopi yang enak dan sehat.',
            'start_date'    => '2021-01-01',
            'end_date'      => '2021-01-31',
            'start_time'    => '08:00:00',
            'end_time'      => '16:00:00',
            'price'         => 1000000,
            'kuota'         => 10,
            'location'      => 'Jakarta',
            'image'         => 'poster1.jpg',
        ]);

        Bootcamp::create([
            'name'          => 'Membuat Kopi yang Lezat',
            'description'   => 'Pelatihan ini akan mengajarkan cara membuat kopi yang lezat dan bergizi.',
            'start_date'    => '2021-02-01',
            'end_date'      => '2021-02-28',
            'start_time'    => '08:00:00',
            'end_time'      => '16:00:00',
            'price'         => 2000000,
            'kuota'         => 20,
            'location'      => 'Bandung',
            'image'         => 'poster2.jpg',
        ]);
    }
}
