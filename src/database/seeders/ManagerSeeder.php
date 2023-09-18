<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// DB読込
use Illuminate\Support\Facades\DB;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manager = [
            'name' => config('owner.top_user'),
        ];
        DB::table('managers')->insert($manager);
    }
}
