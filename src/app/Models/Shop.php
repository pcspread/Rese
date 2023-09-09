<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Model読込
use App\Models\Interest;
use App\Models\Reserve;

class Shop extends Model
{
    use HasFactory;

    // 編集可能なカラムの設定
    protected $fillable = [
        'name',
        'region',
        'genre',
        'description',
        'photo'
    ];

    /**
     * scope検索
     * region
     * @param object $query
     * @param string $region
     * @return void
     */
    public function scopeRegionSearch($query, $region)
    {
        if (!empty($region)) {
            $query->where('region', 'like', "%{$region}%");
        }
    }

    /**
     * scope検索
     * genre
     * @param object $query
     * @param string $genre
     * @return void
     */
    public function scopeGenreSearch($query, $genre)
    {
        if (!empty($genre)) {
            $query->where('genre', 'like', "%{$genre}%");
        }
    }

    /**
     * scope検索
     * name
     * @param object $param
     * @param string $name
     * @return void
     */
    public function scopeAllSearch($query, $all)
    {
        if (!empty($all)) {
            $query->where('name', 'like', "%{$all}%")->orWhere('region', 'like', "%{$all}%")->orWhere('genre', 'like', "%{$all}%");
        }
    }

    /**
     * user_idとshop_idに適合したinterestレコードの取得
     * @param $user_id ユーザーID
     * @param $shop_id 店舗ID
     * @return object
     */
    public function interest($user_id, $shop_id)
    {
        // 各idに適合したレコードの取得
        $record = Interest::where([
            'user_id' => $user_id,
            'shop_id' => $shop_id
        ])->first();

        // レコードがある場合の処理
        if (!empty($record)) {
            return $record;
        }
    }

    /**
     * user_idとshop_idに適合したreserveレコードの取得
     * @param $user_id ユーザーID
     * @param $shop_id 店舗ID
     * @return object
     */
    public function reserve($user_id, $shop_id)
    {
        // 各idに適合したレコードの取得
        $record = Reserve::where([
            'user_id' => $user_id,
            'shop_id' => $shop_id
        ])->first();

        // レコードがある場合の処理
        if (!empty($record)) {
            return $record;
        }
    }
}
