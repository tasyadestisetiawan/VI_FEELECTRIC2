<?php
namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ProductCategoryTableSeeder::class);
        $this->call(CoffeeBeansTableSeeder::class);
        $this->call(CoffeeMachinesTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(BootcampsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(VouchersTableSeeder::class);
        $this->call(AddressTableSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(QuizzesSeeder::class);
        $this->call(QuestionsSeeder::class);
    }
}