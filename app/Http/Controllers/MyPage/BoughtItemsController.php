<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BoughtItemsController extends Controller
{
    public function showBoughtItems()
    {
        $user = Auth::user();

        $items = $user->boughtItems()
            ->with([
                "secondaryCategory",
                "secondaryCategory.primaryCategory",
            ])
            ->orderBy('id', 'DESC')
            ->get();

        return view('mypage.bought_items')
            ->with('items', $items);
    }
}
