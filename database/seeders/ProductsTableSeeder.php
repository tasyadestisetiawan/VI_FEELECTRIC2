<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 2 products
        Product::create([
            'category_id' => 1,
            'name' => 'Iced Americano',
            'slug' => 'iced-americano',
            'description' => 'Perpaduan coklat, latte dari house blend Fore, dan gurihnya caramel',
            'variant' => 'ice',
            'priceIce' => 25000,
            'imageIce' => 'iced-americano.jpg',
        ]);

        // Create 1 product with both variants
        Product::create([
            'category_id' => 2,
            'name' => 'Cappucino',
            'slug' => 'cappucino',
            'description' => 'Espresso dari biji kopi khas nusantara dipadukan susu oat gluten-free dan sensasi nutty dari hazelnut.',
            'variant' => 'both',
            'priceHot' => 30000,
            'imageHot' => 'hot-cappuccino.jpg',
            'priceIce' => 25000,
            'imageIce' => 'iced-cappuccino.jpg',
        ]);
    }
}
