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
            'code' => 'DISKON10',
            'discount' => 10,
            'expired_at' => now()->addDays(7)
        ]);

        Voucher::create([
            'code' => 'DISKON20',
            'discount' => 20,
            'expired_at' => now()->addDays(7)
        ]);

        Voucher::create([
            'code' => 'DISKON30',
            'discount' => 30,
            'expired_at' => now()->addDays(7)
        ]);

        Voucher::create([
            'code' => 'DISKON40',
            'discount' => 40,
            'expired_at' => now()->addDays(7)
        ]);

        Voucher::create([
            'code' => 'DISKON50',
            'discount' => 50,
            'expired_at' => now()->addDays(7)
        ]);
    }
}
