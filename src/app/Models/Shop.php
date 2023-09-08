<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Model読込
use App\Models\Interest;

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
     * リレーション設定
     * @param $id ユーザー情報
     * @return object
     */
    public function interest($user_id, $shop_id)
    {
        // $text =  $this->hasOne(Interest::class)->where('user_id', $id);
        $text = Interest::where([
            'user_id' => $user_id,
            'shop_id' => $shop_id
        ])->first();

        if (!empty($text)) {
            return $text;
        }
    }
}
