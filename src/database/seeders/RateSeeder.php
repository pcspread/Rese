<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// DB読込
use Illuminate\Support\Facades\DB;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment = [
            'とても良い雰囲気だった、また来たい！',
            '皆絶賛していた、また予約します',
            '好評だった、また食べたい',
            'とても美味しかった、また食べに行きたい',
            '美味しかった',
            '普通だった',
            '少し辛めの味付けだった',
            '少し甘めの味付けだった'
        ];
        // ダミーデータ２０飲食店分
        for ($i = 1; $i <= 20; $i++) {
            // 各飲食店に３名ずつコメント
            for ($s = 1; $s <= 3; $s++) {
                $num = mt_rand(1, 5);
                $param = [
                    'user_id' => mt_rand(1, 3),
                    'shop_id' => $i,
                    'number' => $num,
                    'name' => "test{$num}",
                    'comment' => $comment[mt_rand(0, 7)]
                ];
                DB::table('rates')->insert($param);
            }
        }
    }
}
