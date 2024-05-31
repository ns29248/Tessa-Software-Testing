<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller; // Correct the namespace

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function showWishlist()
    {
        $wishlistedProducts = auth()->user()->products()->get(); // Assuming 'wishlistedProducts' returns the products in the wishlist

        return view('main.wishlist.show-wishlist', compact('wishlistedProducts'));
    }

}
