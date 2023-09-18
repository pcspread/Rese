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
     * リレーション設定(Shop)
     * @param void
     * @return object
     */
    public function shop() {
        return $this->belongsTo(Shop::class);
    }

    /**
     * リレーション設定(User)
     * @param void
     * @return object
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
