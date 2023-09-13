<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * view表示
     * オーナー用メインページ
     * @param void
     * @return view
     */
    public function OwnerIndexMain()
    {
        return view('owner.owner');
    }
}
