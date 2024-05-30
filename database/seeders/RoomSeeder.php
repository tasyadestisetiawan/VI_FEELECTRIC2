<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 2 rooms
        Room::create([
            'name'        => 'Standard Room',
            'description' => 'Standard room with basic facilities',
            'price'       => 100000,
            'capacity'    => 2,
            'facilities'  => 'AC, TV',
            'photo'       => 'standard.jpg',
            'status'      => 'available'
        ]);

        Room::create([
            'name'        => 'Deluxe Room',
            'description' => 'Deluxe room with complete facilities',
            'price'       => 500000,
            'capacity'    => 12,
            'facilities'  => 'AC, TV, Projector, Sound System',
            'photo'       => 'deluxe.jpg',
            'status'      => 'available'
        ]);
    }
}