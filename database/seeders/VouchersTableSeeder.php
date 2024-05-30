<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Voucher;

class VouchersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 vouchers
        Voucher::create([
            'user_id' => 2,
            'name' => 'Diskon 10% Special Promo',
            'limit' => 2,
            'code' => 'DISKON10',
            'discount' => 10,
            'expired_at' => now()->addDays(7)
        ]);

        Voucher::create([
            'user_id' => 2,
            'name' => 'Diskon 20% - Hari Belanja Online Nasional',
            'limit' => 2,
            'code' => 'DISKON20',
            'discount' => 20,
            'expired_at' => now()->addDays(7)
        ]);

        Voucher::create([
            'user_id' => 2,
            'name' => 'Diskon Kemerdekaan RI 78%',
            'limit' => 2,
            'code' => 'DISKONHUTRI78',
            'discount' => 78,
            'expired_at' => now()->addDays(7)
        ]);
    }
}
