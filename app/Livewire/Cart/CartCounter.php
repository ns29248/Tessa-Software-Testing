<?php

namespace App\Livewire\Cart;

use App\Models\Cart;
use Livewire\Component;


class CartCounter extends Component
{
    public $cartCount = 0;

    protected $listeners = ['cart_updated' => 'updateCartCount'];

    public function updateCartCount()
    {
        $this->cartCount = Cart::where('user_id', auth()->id())
            ->count();
    }

    public function render()
    {
        $this->updateCartCount();

        return view('livewire.cart.cart-counter');
    }
}

