<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    // タイムスタンプを無効に
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'shop_id'
    ];

    /**
     * リレーション設定
     * Shop
     * @param void
     * @return object
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
