<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seeder読込
        $this->call(UserSeeder::class);
        $this->call(ShopSeeder::class);
        $this->call(RateSeeder::class);
        $this->call(ManagerSeeder::class);
    }
}
