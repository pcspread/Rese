<?php

use Illuminate\Support\Facades\Route;
// Controller読込
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\OwnerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Auth::route();

// Route::middleware('verified')->group(function() {
    
// view表示：飲食店一覧ページ作成
Route::get('/', [ShopController::class, 'indexShops'])->name('verification.notice');
// view表示：飲食店詳細ページ
Route::get('/detail/{shop_id}', [ShopController::class, 'detailShop']);
// 前ページへ戻る処理
Route::get('/back', [ShopController::class, 'backPage']);

Route::prefix('/login')->group(function() {
    // view表示：ログインページ
    Route::get('/', [UserController::class, 'indexLogin']);
    // login処理
    Route::post('/', [UserController::class, 'login'])->name('login');
});

Route::prefix('/register')->group(function() {
    // view表示：新規登録ページ
    Route::get('/', [UserController::class, 'indexRegister']);
    // create処理
    Route::post('/', [UserController::class, 'storeUser']);
});

// view表示：メール送信済ページ
Route::get('/email/verify', [UserController::class, 'indexMail']);
// view表示：メール送信済ページ
Route::post('/email/verify', [UserController::class, 'resendMail']);
// Route::get('/email/verify', [UserController::class, 'indexMail'])->middleware('auth')->name('verification.notice');
// メール確認ハンドラ
// Route::get('/email/verify/{id}/{hash}', [UserController::class, 'confirmEmail'])->middleware('signed')->name('verification.verify');
// Route::get('/email/verify/{id}/{hash}', [UserController::class, 'confirmEmail'])->middleware(['auth', 'signed'])->name('verification.verify');
// メールの再送信
// Route::post('/email/verification-notification', [UserController::class, 'resendEmail'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// view表示：サンクスページ
Route::get('/thanks', [UserController::class, 'indexComplete']);

// 認証済ユーザーのルート
Route::middleware(['auth', 'verified'])->group(function() {
    // view表示：マイページ
    Route::get('/mypage', [ShopController::class, 'personal'])->name('mypage');

    Route::prefix('/like')->group(function() {
        // お気に入り追加処理(飲食店一覧ページ)
        Route::post('/{id}', [ShopController::class, 'addLike']);
        // お気に入り削除処理(飲食店一覧ページ)
        Route::patch('/{id}', [ShopController::class, 'cancelLike']);
    });

    // お気に入り削除処理(マイページ)
    Route::patch('/mypage/like/{id}', [ShopController::class, 'cancelLikeMy']);

    Route::prefix('/detail')->group(function() {
        // お気に入り追加処理(飲食店詳細ページ)
        Route::post('/like/{id}', [ShopController::class, 'addLikeDetail']);
        // お気に入り削除処理(飲食店詳細ページ)
        Route::patch('/like/{id}', [ShopController::class, 'cancelLikeDetail']);
    });

    // 予約追加処理
    Route::post('/detail/{shop_id}', [ShopController::class, 'addReserve']);

    
    // view表示
    Route::get('/done', [ShopController::class, 'doneReserve']);
    
    // 予約削除処理
    Route::delete('/mypage/reserve/{shop_id}', [ShopController::class, 'deleteReserve']);
    
    // 予約更新処理
    Route::patch('/mypage/reserve/{shop_id}', [ShopController::class, 'updateReserve']);

    // 評価追加処理
    Route::post('/rate/{shop_id}', [ShopController::class, 'storeRate']);

    // stripe決済後の処理
    Route::get('/mypage/payment/close', [StripePaymentController::class, 'closeCheckout'])->name('closeCheckout');

    // stripe決済処理
    Route::get('/mypage/payment/{reserve_id}', [StripePaymentController::class, 'indexStripe']);

    Route::prefix('/owner')->group(function () {
        // view表示：オーナー用メインページ
        Route::get('/', [OwnerController::class, 'OwnerIndexMain']);
        // view表示：オーナー用飲食店追加ページ
        Route::get('/shop/create', [OwnerController::class, 'OwnerIndexCreateShop']);
        // view表示：オーナー用飲食店修正ページ
        Route::get('/shop/edit', [OwnerController::class, 'OwnerIndexEditShop']);
    });


    // stripe決済処理
    // Route::get('/mypage/payment/checkout', [StripePaymentController::class, 'checkout']);
    
    // view表示：ログアウトページ
    Route::post('/logout', [UserController::class, 'logout']);
});
    
// 保護下のルート
Route::get('/profile', function() {
})->middleware('verified');

// view表示：認証メール
// Route::get('/send/email', [UserController::class, 'sendMail']);
