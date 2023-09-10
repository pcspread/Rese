<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reserve extends Model
{
    use HasFactory;
    use SoftDeletes;

    // 編集可能なカラムの設定
    protected $fillable = [
        'user_id', 'shop_id', 'date', 'time', 'number'
    ];

    /**
     * user_idとshop_idから店舗情報を取得する
     * @param int $user_id
     * @param int $shop_id
     * @return object
     */
    public function shop() {
        return $this->belongsTo(Shop::class);
    }
}
