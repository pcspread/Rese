<?php

use Illuminate\Support\Facades\Route;
// Controller読込
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;
// AuthFacades読込
// use Illuminate\Support\Facades\Auth;

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

// view表示：ログインページ
Route::get('/login', [UserController::class, 'indexLogin']);
// login処理
Route::post('/login', [UserController::class, 'login'])->name('login');
// view表示：新規登録ページ
Route::get('/register', [UserController::class, 'indexRegister']);
// create処理
Route::post('/register', [UserController::class, 'storeUser']);

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
    Route::get('/mypage', [UserController::class, 'personal']);
    // view表示：ログアウトページ
    Route::post('/logout', [UserController::class, 'logout']);
    // お気に入り追加処理
    Route::post('/like/{id}', [ShopController::class, 'addLike']);
    // お気に入り削除処理
    Route::patch('/like/{id}', [ShopController::class, 'cancelLike']);
});
    
// 保護下のルート
Route::get('/profile', function() {
})->middleware('verified');

// view表示：認証メール
// Route::get('/send/email', [UserController::class, 'sendMail']);
