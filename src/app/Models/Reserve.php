<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    // 編集可能なカラムの設定
    protected $fillable = [
        'user_id', 'shop_id', 'date', 'time', 'number'
    ];
}
