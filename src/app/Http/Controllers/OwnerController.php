<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Model読込
use App\Models\Shop;
use App\Models\User;
use App\Models\Reserve;
use App\Models\Manager;
// Request読込
use App\Http\Requests\ShopRequest;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\ManagerRequest;
// Mail読込
use Illuminate\Support\Facades\Mail;
use App\Mail\OwnerMail;
// Carbon読込
use Carbon\Carbon;
// Auth読込
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    /**
     * view表示
     * メインページ
     * @param void
     * @return view
     */
    public function OwnerIndexMain(Request $request)
    {
        // 飲食店情報を全件取得
        $shops = Shop::all();
        
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

        return view('owner.shops', compact(['shops', 'regions', 'genres']));
    }

    /**
     * view表示
     * 飲食店追加ページ
     * @param void
     * @return view
     */
    public function OwnerIndexCreateShop()
    {
        return view('owner.create_shop');
    }

    /**
     * create処理
     * 飲食店追加処理
     * @param object $request
     * @return redirect
     */
    public function OwnerStoreShop(ShopRequest $request)
    {
        // フォーム情報の取得
        $form = $request->only('name', 'region', 'genre', 'photo', 'description');

        // create処理
        Shop::create($form);

        return redirect('/owner/shop/create')->with('success', "飲食店「{$form['name']}」を追加しました");
    }

    /**
     * view表示
     * 飲食店修正ページ
     * @param void
     * @return view
     */
    public function OwnerIndexEditShop($id)
    {
        // 該当飲食店を取得
        $shop = Shop::find($id);

        return view('owner.edit_shop', compact('shop'));
    }

    /**
     * update処理
     * 飲食店更新処理
     * @param int $id
     * @param object $request
     * @return redirect
     */
    public function OwnerUpdateShop($id, ShopRequest $request) {
        // フォーム情報の取得
        $form = $request->only(['name', 'region', 'gerre', 'photo', 'description']);
        
        // update処理
        Shop::where('id', $id)->update($form);

        return redirect("/owner/shop/edit/{$id}")->with('success', "飲食店「{$form['name']}」の情報を更新しました");
    }

    /**
     * delete処理
     * 飲食店削除処理
     * @param int $id
     * @return redirect
     */
    public function OwnerDeleteShop($id)
    {
        // 削除対象の飲食店名を取得
        $name = Shop::find($id)->name;

        // delete処理
        Shop::find($id)->delete();

        return redirect('/owner')->with('success', "飲食店「{$name}」を削除しました"); 
    }

    /**
     * view表示
     * 予約一覧
     * @param void
     * @return view
     */
    public function OwnerIndexReserve()
    {
        // 予約情報を全件取得
        $reserves = Reserve::orderBy('date', 'asc')->get();

        return view('owner.reserve', compact('reserves'));
    }

    /**
     * view表示
     * メール送信ページ
     * @param void
     * @param view
     */
    public function OwnerIndexMail()
    {
        return view('owner.mail');
    }

    /**
     * メール送信処理
     * @param object $request
     * @return redirect
     */
    public function OwnerSendMail(MessageRequest $request)
    {
        // フォーム情報の取得
        $form = $request->only('title', 'content');

        // ユーザー全員分のメールアドレスを取得
        $users = User::all();

        // メール送信
        foreach ($users as $user) {
            Mail::send(new OwnerMail($form['title'], $form['content'], $user['name'], $user['email']));
    
            // メールの二重送信防止処理
            $request->session()->regenerateToken();            
        }
        return redirect('/owner/mail')->with('success', 'メールを送信しました');
    }

    /**
     * view表示
     * 管理者設定ページ
     * @param void
     * @return view
     */
    public function OwnerIndexSetting()
    {
        // 代表者名を格納
        $name = Manager::find(1)->name;

        return view('owner.setting', compact('name'));
    }

    /**
     * update処理
     * 管理者情報の更新
     * @param object $request
     * @return redirect
     */
    public function OwnerUpdateSetting(ManagerRequest $request)
    {
        // フォーム情報の取得
        $name = $request->only('name');
        
        // update処理
        Manager::find(1)->update($name);

        return redirect('/owner/setting')->with('success', "店舗代表者を「{$name['name']}」に変更しました");
    }
}
