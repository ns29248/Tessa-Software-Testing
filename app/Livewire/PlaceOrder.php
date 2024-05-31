<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
use App\Services\PlaceOrderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class PlaceOrder extends Component
{
    public $discount = 0;
    public $cartItems = [];
    public $finalTotal = 0;
    public $couponId = null;

    protected $listeners = ['couponApplied'];

    public function mount()
    {
        $this->cartItems = $this->fetchCartItems();
        $this->finalTotal = $this->calculateTotal();
    }

    public function render()
    {
        return view('livewire.place-order', [
            'finalTotal' => $this->finalTotal,
        ]);
    }

    private function fetchCartItems()
    {
        return Cart::where('user_id', Auth::id())->get();
    }

    private function calculateTotal()
    {
        $total = $this->cartItems->sum(function ($cartItem) {
            return $cartItem->price * $cartItem->quantity;
        });

        return max(0, $total - $this->discount);
    }
    public function placeOrder()
    {
        $orderService = new PlaceOrderService();  // Or better yet, inject it if Livewire supports dependency injection

        try {
            $result = $orderService->placeOrder(Auth::user(), $this->cartItems, $this->finalTotal, $this->couponId);
            session()->flash('success', 'Order placed successfully.');
            return redirect()->route('my.orders');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }
    public function couponApplied($discount, $couponId)
    {
        $this->discount = $discount;
        $this->couponId = $couponId;
        $this->finalTotal = $this->calculateTotal();
    }
}
