<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CoffeeBean;

class CoffeeBeansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create  Data
        CoffeeBean::create([
            'name' => 'Bali Kintamani',
            'origin' => 'Bali',
            'price' => 100000,
            'stock' => 10,
            'image' => 'bali-kintamani.png',
            'weight' => '500g',
            'description' => 'Kopi bali kintamani memiliki rasa asam segar fruity yang unik. Kopinya tidak terasa pahit dan body-nya medium. Rasa kopi bali kintamani sangat unik',
        ]);

        CoffeeBean::create([
            'name' => 'Java Aromanis',
            'origin' => 'Jawa',
            'price' => 120000,
            'stock' => 15,
            'image' => 'java-aromanis.png',
            'weight' => '500g',
            'description' => 'Memiliki beberapa keunggulan aroma yang kuat, cita rasa khas (unik). Aroma yang jelas tercium adalah aroma Blueberry, Floral, Jasmine, sweet aftertaste, vanilla',
        ]);

        CoffeeBean::create([
            'name' => 'Aceh Gayo',
            'origin' => ' Gayo',
            'price' => 110000,
            'stock' => 20,
            'image' => 'aceh-gayo.png',
            'weight' => '500g',
            'description' => 'Kopi gayo merupakan varietas kopi arabika yang menjadi salah satu komoditi unggulan yang berasal dari Dataran Tinggi Gayo, Aceh Tengah, Indonesia',
        ]);

        CoffeeBean::create([
            'name' => 'Sidikalang',
            'origin' => 'Sidikalang',
            'price' => 110000,
            'stock' => 20,
            'image' => 'sidikalang.png',
            'weight' => '500g',
            'description' => 'Kopi Sidikalang adalah sebutan untuk kopi robusta dan arabika yang dikembangkan di Kecamatan Sidikalang, ibu kota dari Kabupaten Dairi, Sumatera Utara',
        ]);
    }
}
