<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * view表示
     * shops.blade.php
     * @param void
     * @return view
     */
    public function indexShops()
    {
        return view('shops');
    }
}
