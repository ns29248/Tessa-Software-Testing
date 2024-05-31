<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller; // Correct the namespace
use App\Http\Requests\OrderRequest;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function showCart()
    {
        return view('main.cart.cart');
    }

    public function Checkout()
    {
        $excludeGlobalStyles = true;
        return view('main.cart.checkout', compact('excludeGlobalStyles'));

    }

}
