<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 2 Account Admin & User
        \App\Models\User::create([
            'name'      => 'Admin',
            'username'  => 'admin',
            'email'     => 'admin@feelectric.app',
            'password'  => bcrypt('password'),
            'phone'     => '081234567899',
            'address'   => 'Jakarta, Indonesia',
            'role'      => 'admin',
            'avatar'    => 'admin.jpg'
        ]);

        \App\Models\User::create([
            'name'      => 'Tasya Desti',
            'username'  => 'tasyadesti',
            'email'     => 'user@feelectric.app',
            'phone'     => '081234567890',
            'address'   => 'Tegal, Jawa Tengah',
            'password'  => bcrypt('password'),
            'role'      => 'user',
            'avatar'    => 'tasya.jpg',
            'coin'      => 100
        ]);
    }
}
