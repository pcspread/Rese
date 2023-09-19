<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // タイムスタンプを無効に
    public $timestamps = false;

    // 編集可能なカラムの設定
    protected $fillable = [
        'title', 'content'
    ];
}
