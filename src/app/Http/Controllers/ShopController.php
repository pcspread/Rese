<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Model読込
use App\Models\Shop;

class ShopController extends Controller
{
    /**
     * view表示
     * shops.blade.php
     * @param void
     * @return view
     */
    public function indexShops()
    {
        // shopsレコードを全件取得
        $shops = Shop::all();

        // 値の重複が無い配列を作成
        $regions = [];
        $genres = [];
        foreach ($shops as $shop) {
            // regionカラム
            if (!in_array($shop['region'], $regions)) {
                $regions[] = $shop['region'];
            }
            
            // genreカラム
            if (!in_array($shop['genre'], $genres)) {
                $genres[] = $shop['genre'];
            }
        }

        return view('shops', compact(['shops', 'regions', 'genres']));
    }
}
