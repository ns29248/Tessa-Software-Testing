<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;

class CartService
{
    public function addToCart($userId, $productId, $quantity)
    {
        $cartItem = Cart::firstOrNew([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        $cartItem->quantity += $quantity;
        $cartItem->price = $this->calculatePrice($cartItem);
        $cartItem->save();

        return $cartItem;
    }

    public function calculatePrice(Cart $cartItem)
    {
        $product = Product::find($cartItem->product_id);
        $user = auth()->user();

        // Check for a sale price
        if ($product->sale && $user->role != 2) { // If there's a sale and the user is not a stylist
            return $product->sale->sale_price;
        }

        // Check if the user is a stylist
        if ($user->role == 2) {
            return $product->stylist_price;
        }

        // Return the regular price if no other conditions are met
        return $product->price;
    }

    public function updateCartCount()
    {

    }

    public function deleteCart(User $user)
    {
        Cart::where('user_id', $user->id)->delete();

    }
}
