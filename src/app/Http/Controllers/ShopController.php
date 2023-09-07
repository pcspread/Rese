<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Model読込
use App\Models\Shop;
use App\Models\Interest;
// Auth読込
use Illuminate\Support\Facades\Auth;

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

        // 検索キーワード(all)がある場合
        if (!empty($all)) {
            // 検索キーワード(エリア、ジャンル)がある場合
            // キーワードが両方空の場合
            if (!empty($area) && !empty($genre)) {
                if ($area !== '全て' && $genre !== '全て') {
                    $shops = Shop::RegionSearch($area)->GenreSearch($genre)->AllSearch($all)->get();
                } elseif ($area === '全て' && $genre === '全て') {
                    $shops = Shop::AllSearch($all)->get();
                } elseif ($area === '全て') {
                    $shops = Shop::GenreSearch($genre)->AllSearch($all)->get();
                } elseif ($genre === '全て') {
                    $shops = Shop::RegionSearch($area)->AllSearch($all)->get();
                }
            // キーワードがジャンルのみ空の場合
            } elseif (!empty($area) && empty($genre)) {
                $shops = Shop::RegionSearch($area)->AllSearch($all)->get();
            // キーワードがエリアのみ空の場合
            } elseif (empty($area) && !empty($genre)) {
                $shops = Shop::GenreSearch($genre)->AllSearch($all)->get();
            }
        // 検索キーワード(all)が無い場合
        } else {
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
        }
        

        return view('shops', compact(['shops', 'regions', 'genres']));
    }

    /**
     * お気に入り追加処理
     * @param int $id 店舗ID
     * @return redirect
     */
    public function addLike($id) {
        // お気に入り追加処理
        Interest::create([
            'user_id' => Auth::id(),
            'shop_id' => $id
        ]);

        return redirect('/');
    }

    /**
     * お気に入り削除処理
     * @param int $id 店舗ID
     * @return redirect
     */
    public function cancelLike($id) {
        // お気に入り追加処理
        Interest::where([
            'user_id' => Auth::id(),
            'shop_id' => $id
        ])->delete();

        return redirect('/');
    }
}
