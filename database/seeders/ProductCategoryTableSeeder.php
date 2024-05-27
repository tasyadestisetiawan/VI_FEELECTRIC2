<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Create Coffee Product Categories
         ProductCategory::create([
            'name' => 'Ordinary Coffee',
        ]);

        ProductCategory::create([
            'name' => 'Manual Brew',
        ]);

        ProductCategory::create([
            'name' => 'Latte Non Coffee',
        ]);

        ProductCategory::create([
            'name' => 'Feel The Signature',
        ]);

    }
}
