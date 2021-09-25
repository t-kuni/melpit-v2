<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SoldItemsController extends Controller
{
    public function showSoldItems()
    {
        $user = Auth::user();

        $items = $user->soldItems()
            ->with([
                "secondaryCategory",
                "secondaryCategory.primaryCategory",
            ])
            ->orderBy('id', 'DESC')
            ->get();

        return view('mypage.sold_items')
            ->with('items', $items);
    }
}
