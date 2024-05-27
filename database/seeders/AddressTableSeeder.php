<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a new address
        Address::create([
            'address' => 'Jl. Raya Bogor No. 12',
            'city'    => 'Bogor',
            'state'   => 'Jawa Barat',
            'zip'     => '16111',
            'user_id' => 1,
        ]);

        // Create a new address
        Address::create([
            'address' => 'Jl. Raya Jakarta No. 12',
            'city'    => 'Jakarta',
            'state'   => 'DKI Jakarta',
            'zip'     => '10110',
            'user_id' => 1,
        ]);
    }
}
