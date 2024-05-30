<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 1 reservation
        Reservation::create([
            'room_id' => 1,
            'user_id' => 1,
            'check_in' => '2024-06-01',
            'check_out' => '2024-06-03',
            'check_in_time' => '14:00:00',
            'check_out_time' => '12:00:00',
            'total_guests' => 2,
            'status' => 'pending',
            'amount' => 1000000,
            'special_request' => 'No special request',
            'payment_method' => 'transfer',
            'payment_proof' => 'payment_proof.jpg',
        ]);
    }
}
