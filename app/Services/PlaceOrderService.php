<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Item;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PlaceOrderService
{
    public function placeOrder($user, $cartItems, $finalTotal, $couponId)
    {
        $cartService=new CartService();
        if (empty($cartItems)) {
            throw new \Exception('Your cart is empty.');
        }

        if ($finalTotal <= 0) {
            throw new \Exception('The order total cannot be zero. Please review your cart and discounts.');
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => $user->id,
                'total' => $finalTotal,
                'coupon_id' => $couponId,
            ]);

            $itemsData = [];
            foreach ($cartItems as $item) {
                $itemsData[] = [
                    'product_id' => $item->product_id,
                    'order_id' => $order->id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            if ($couponId) {
                $user->coupons()->attach($couponId, ['used_at' => now()]);
            }

            Item::insert($itemsData);  // Perform a bulk insert

            $cartService->deleteCart($user);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Order Placement Error: {$e->getMessage()}", ['userId' => $user->id]);
            throw $e;
        }
    }
}

