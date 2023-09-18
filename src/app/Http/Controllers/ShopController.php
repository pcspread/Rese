<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Request読込
use App\Http\Requests\ReserveRequest;
use App\Http\Requests\RateRequest;
// Model読込
use App\Models\Shop;
use App\Models\Interest;
use App\Models\Reserve;
use App\Models\Rate;
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
            // キーワードが両方無い場合
            } elseif (empty($area) && empty($genre)) {
                $shops = Shop::AllSearch($all)->get();
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

        // お気に入り情報を取得
        $interests = Interest::where('user_id', Auth::id());

        // 詳細ページで「戻るボタン」を押した時用にsessionに値を格納
        session()->put('page', 'shops');

        return view('shops', compact(['shops', 'regions', 'genres', 'interests']));
    }
    
    /**
     * view表示
     * mypage.blade.php
     * @param void
     * @return view
     */
    public function personal()
    {
        // お気に入り店舗情報を取得
        $interests = Interest::where('user_id', Auth::id())->orderBy('shop_id', 'asc')->get();

        // 予約情報を取得
        $reserves = Reserve::where('user_id', Auth::id())->get();

        // 詳細ページで「戻るボタン」を押した時用にsessionに値を格納
        session()->put('page', 'mypage');

        return view('mypage', compact('interests', 'reserves'));
    }

    /**
     * 前ページへ戻る処理
     * @param void
     * @return back
     */
    public function backPage()
    {
        // 前ページ情報の取得
        $page = session()->get('page');

        if ($page === 'shops') {
            // 前ページが飲食店一覧の場合
            return redirect('/');
        } elseif ($page = 'mypage') {
            // 前ページがマイページの場合
            return redirect('/mypage');
        } else {
            return back();
        }
    }

    /**
     * お気に入り追加処理(飲食店一覧ページ)
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
     * お気に入り削除処理(飲食店一覧ページ)
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
    
    /**
     * お気に入り削除処理(マイページ)
     * @param int $id 店舗ID
     * @return redirect
     */
    public function cancelLikeMy($id) {
        // お気に入り追加処理
        Interest::where([
            'user_id' => Auth::id(),
            'shop_id' => $id
        ])->delete();

        return redirect('/mypage');
    }

    /**
     * view表示
     * 飲食店詳細ページ
     * @param int $id 店舗ID
     * @return view
     */
    public function detailShop($id)
    {
        // 店舗情報の取得
        $shop = Shop::find($id);

        // コメント情報の取得
        $rates = Rate::where('shop_id', $id)->orderBy('id', 'desc')->get();

        // 決済後の店舗情報(deleted_at)の取得
        $delete = Reserve::onlyTrashed()->where([
            'user_id' => Auth::id(),
            'shop_id' => $id
        ])->first();

        return view('detail', compact(['shop', 'rates', 'delete']));
    }
    
    /**
     * お気に入り追加処理(飲食店詳細ページ)
     * @param int $id 店舗ID
     * @return redirect
     */
    public function addLikeDetail($id) {
        // お気に入り追加処理
        Interest::create([
            'user_id' => Auth::id(),
            'shop_id' => $id
        ]);

        return redirect("/detail/{$id}");
    }

    /**
     * お気に入り削除処理(飲食店詳細ページ)
     * @param int $id 店舗ID
     * @return redirect
     */
    public function cancelLikeDetail($id) {
        // お気に入り追加処理
        Interest::where([
            'user_id' => Auth::id(),
            'shop_id' => $id
        ])->delete();

        return redirect("/detail/{$id}");
    }

    /**
     * 予約追加処理
     * @param object $request
     * @return redirect
     */
    public function addReserve(ReserveRequest $request, $shop_id)
    {
        // フォーム情報を取得
        $form = $request->only(['date', 'time', 'number']);

        // 追加するデータを用意
        $reserve = [
            'user_id' => Auth::id(),
            'shop_id' => $shop_id,
            'date' => $form['date'],
            'time' => "{$form['time']}:00:00",
            'number' => $form['number']
        ];

        // 追加処理
        Reserve::create($reserve);

        return redirect('/done')->with('shop_id', $shop_id);
    }

    /**
     * view表示
     * @param void
     * @return view
     */
    public function doneReserve()
    {
        return view('done');
    }

    /**
     * 予約削除処理
     * @param int $shop_id
     * @return redirect
     */
    public function deleteReserve($shop_id)
    {
        // 予約している店舗名を取得
        $name = Shop::find($shop_id)->name;

        // 論理削除処理
        Reserve::where('shop_id', $shop_id)->forceDelete();

        return redirect('/mypage')->with('success', "「{$name}」の予約を削除しました");
    }

    /**
     * 予約更新処理
     * @param object $request
     * @param int $shop_id
     * @return redirect
     */
    public function updateReserve(ReserveRequest $request, $shop_id)
    {
        // フォーム情報の取得
        $form = $request->only(['date', 'time', 'number']);

        // 更新情報を用意
        $reserve = [
            'date' => $form['date'],
            'time' => "{$form['time']}:00:00",
            'number' => $form['number']
        ];

        // 更新する店名を取得
        $name = Shop::find($shop_id)->name;

        // 更新処理
        Reserve::where([
            'user_id' => Auth::id(),
            'shop_id' => $shop_id
        ])->update($reserve);

        return redirect('/mypage')->with('success', "「{$name}」の内容を更新しました");
    }

    /**
     * 評価追加処理
     * @param object $request
     * @return redirect
     */
    public function storeRate(RateRequest $request)
    {
        // フォーム情報の取得
        $form = $request->only(['number', 'name', 'comment', 'shop_id']);

        $rate = [
            'user_id' => Auth::id(),
            'shop_id' => $form['shop_id'],
            'number' => $form['number'],
            'name' => $form['name'],
            'comment' => $form['comment']
        ];

        // 追加処理
        Rate::create($rate);

        return redirect("/detail/{$rate['shop_id']}")->with('success', 'コメントを投稿しました');
    }
}
