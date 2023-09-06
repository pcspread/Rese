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
    public function indexShops(Request $request)
    {
        // 検索キーワードを取得
        $area = $request['area'];
        $genre = $request['genre'];
        $all = $request['all'];

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

        // 検索キーワード(エリア、ジャンル)がある場合
        // キーワードが両方空の場合
        if (!empty($area) && !empty($genre)) {
            if ($area !== '全て' && $genre !== '全て') {
                $shops = Shop::RegionSearch($area)->GenreSearch($genre)->get();
            } elseif ($area === '全て' && $genre === '全て') {
                $shops = $shops;
            } elseif ($area === '全て') {
                $shops = Shop::GenreSearch($genre)->get();
            } elseif ($genre === '全て') {
                $shops = Shop::RegionSearch($area)->get();
            }
        // キーワードがジャンルのみ空の場合
        } elseif (!empty($area) && empty($genre)) {
            $shops = Shop::RegionSearch($area)->get();
        // キーワードがエリアのみ空の場合
        } elseif (empty($area) && !empty($genre)) {
            $shops = Shop::GenreSearch($genre)->get();
        }

        // 検索キーワード(all)がある場合
        if (!empty($all)) {
            $shops = Shop::AllSearch($all)->get();
        }

        return view('shops', compact(['shops', 'regions', 'genres']));
    }
}
