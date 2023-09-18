<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    // timestampを無効に
    public $timestamps = false;

    // 編集可能なカラムの設定
    protected $fillable = [
        'name',
    ];
}
