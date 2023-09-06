<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'region',
        'genre',
        'description',
        'photo'
    ];

    /**
     * 値をセッションに格納する
     * @param string $name セッション名
     * @param string $target 要素
     * @return string $result 要素
     */
    public function putSesArea($target)
    {
        if (empty($target)) {
            session()->flush('area');
        } else {
            // dd($target);
            // セッションに格納
            session()->flash('area', $target);
            // dd(session('area'));
        }

        return $target;
    }

    /**
     * 値をセッションに格納する
     * @param string $name セッション名
     * @param string $target 要素
     * @return string $result 要素
     */
    public function putSesGenre($target)
    {
        if (empty($target)) {
            session()->flush('genre');
        } else {
            // セッションに格納
            session()->flash('genre', $target);
        }

        return $target;
    }
}
