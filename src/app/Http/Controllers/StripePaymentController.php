<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Model読込
use App\Models\Reserve;
use App\Models\Shop;

class StripePaymentController extends Controller
{
    /**
     * view表示
     * strip決済画面
     * @param int $shop_id
     * @return view
     */
    public function indexStripe($reserve_id)
    {
        // 予約情報の取得
        $reserve = Reserve::find($reserve_id);

        // 予約情報が無い場合
        if (empty($reserve)) {
            return redirect('/mypage');
        }

        // 予約情報をセッションに格納
        session()->put('reserve', $reserve);

        // 予約店舗名の取得
        $name = Shop::find($reserve['shop_id'])->name;

        // stripeに渡す情報の用意
        $line_item = [
            'price_data' => [
                'currency' => 'jpy',
                'unit_amount' => 1000,
                'product_data' => [
                    'name' => $name,
                    'description' => "決済後、飲食店のコメント欄にコメントいただけるようになります。",
                ],
            ],
            'quantity'    => $reserve['number'],
        ];

        // APIにシークレットキーをセット
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items'           => [$line_item],
            'success_url'        => route('closeCheckout'),
            'cancel_url'           => route('mypage'),
            'mode'                   => 'payment',
        ]);

        return view('payment',[
            'session' => $session,
            'publicKey' => env('STRIPE_PUBLIC_KEY')
        ]);
    }

    /**
     * stripe決済後の処理
     * @param
     * @return
     */
    public function closeCheckout()
    {
        // セッションに予約情報が無い場合
        if (empty(session()->get('reserve'))) {
            return redirect('/mypage');
        }

        // 決済した予約情報のidを取得
        $id = session()->get('reserve')->id;


        // 予約情報の削除
        Reserve::find($id)->delete();

        return redirect('/mypage')->with('success', '決済が完了しました');
    }
}
