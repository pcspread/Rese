<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// DB読込
use Illuminate\Support\Facades\DB;
// Carbon読込
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ３人分作成
        for ($i = 1; $i <= 3; $i++) {
            $param = [
                'name' => 'test' . $i,
                'email' => "test{$i}@test.com",
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('test1111'),
                'remember_token' => bcrypt(bin2hex(random_bytes(32))),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('users')->insert($param);
        }
        
        // 店舗代表者作成
        $owner = [
            'name' => 'topp1111',
            'email' => "topp1111@top.com",
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('topp2222'),
            'remember_token' => bcrypt(bin2hex(random_bytes(32))),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('users')->insert($owner);

        // オーナーデータ作成
        $owner = [
            'name' => 'owner1111',
            'email' => "owner1111@owner.com",
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('owner2222'),
            'remember_token' => bcrypt(bin2hex(random_bytes(32))),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('users')->insert($owner);
    }
}
