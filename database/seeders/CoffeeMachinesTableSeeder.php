<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CoffeeMachine;

class CoffeeMachinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Coffee Machines
        CoffeeMachine::create([
            'name' => 'Grinder latina 600N',
            'description' => 'Breville is a brand of small home appliances, founded in Sydney, Australia, in 1932.',
            'price' => 2150000,
            'image' => 'grinder.jpg',
        ]);

        CoffeeMachine::create([
            'name' => 'Aeropress GO Coffee press ',
            'description' => 'Classic 2019 - Coffe Machine is a best seller in the semi-automatic espresso machine market.',
            'price' => 695000,
            'image' => 'aeropress.jpg',
        ]);

        CoffeeMachine::create([
            'name' => 'Kettle Brewista',
            'description' => 'Home Espresso Machines. La Marzocco has been on the forefront of innovation in espresso machines since 1927.',
            'price' => 1700000,
            'image' => 'kettle.jpg',
        ]);

        CoffeeMachine::create([
            'name' => 'Papper filter Holder V60 ',
            'description' => 'Home Espresso Machines. La Marzocco has been on the forefront of innovation in espresso machines since 1927.',
            'price' => 102000,
            'image' => 'papper.jpg',
        ]);

        CoffeeMachine::create([
            'name' => 'Hand grinder Timemore Chestnut CS3 ',
            'description' => 'Home Espresso Machines. La Marzocco has been on the forefront of innovation in espresso machines since 1927.',
            'price' => 895000,
            'image' => 'hand-grinder.jpg',
        ]);

        CoffeeMachine::create([
            'name' => 'Hand grinder STEEL CONICAL BURR JS-20 ',
            'description' => 'Home Espresso Machines. La Marzocco has been on the forefront of innovation in espresso machines since 1927.',
            'price' => 450000,
            'image' => 'hand-steel.jpg',
        ]);

        CoffeeMachine::create([
            'name' => 'Hario V60 450ml (VCS-01 B) ',
            'description' => 'Home Espresso Machines. La Marzocco has been on the forefront of innovation in espresso machines since 1927.',
            'price' => 225000,
            'image' => 'hario-v60.jpg',
        ]);

        CoffeeMachine::create([
            'name' => 'Hario Coffee dripper V60 Glass VDGR-01  ',
            'description' => 'Home Espresso Machines. La Marzocco has been on the forefront of innovation in espresso machines since 1927.',
            'price' => 385000,
            'image' => 'hario-coffee.jpg',
        ]);

        CoffeeMachine::create([
            'name' => 'Einstein smart coffee scale ',
            'description' => 'Home Espresso Machines. La Marzocco has been on the forefront of innovation in espresso machines since 1927.',
            'price' => 350000,
            'image' => 'einstein.jpg',
        ]);

        CoffeeMachine::create([
            'name' => 'Hario Papper filter VCF-01-40M   ',
            'description' => 'Home Espresso Machines. La Marzocco has been on the forefront of innovation in espresso machines since 1927.',
            'price' => 40000,
            'image' => 'hario-papper.jpg',
        ]);
    }
}
