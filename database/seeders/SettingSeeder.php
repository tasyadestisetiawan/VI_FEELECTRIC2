<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a new setting
        Setting::create([
            'name' => 'Rekening Bank',
            'value' => '3328-22-1234567-xxx'
        ]);

        // Create a new setting
        Setting::create([
            'name' => 'DANA/Gopay',
            'value' => '08123456789'
        ]);
    }
}
