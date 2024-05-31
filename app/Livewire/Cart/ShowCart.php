<?php

namespace App\Livewire\Cart;

use Livewire\Component;
use App\Models\Cart;

class ShowCart extends Component
{
    public $view;
    public $subtotal = 0;
    public $cartItems;
    public $isEmpty = true;
    protected $listeners = ['load_cart' => 'loadCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function render()
    {

        if ($this->view === 'show-cart') {


            return view('livewire.cart.show-cart');
        }
        else
            $this->loadCart();
        return view('livewire.cart.show-cart-modal');
    }

    public function loadCart()
    {
        $this->cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();
        $this->calculateTotal();
        $this->isEmpty = $this->cartItems->isEmpty();
    }

    public function calculateTotal()
    {
        $this->subtotal = 0;
        foreach ($this->cartItems as $cartItem) {
            $this->subtotal += $cartItem->price * $cartItem->quantity;
        }
    }

    public function deleteItem($cartItemId)
    {
        $cartItem = Cart::where('id', $cartItemId)
            ->where('user_id', auth()->id())
            ->first();
        if ($cartItem) {
            $cartItem->delete();
            $this->loadCart();
            $this->dispatch('cart_updated');
        }
    }

    public function incrementQuantity($cartItemId)
    {
        $this->updateQuantity($cartItemId, 1);
    }

    public function decrementQuantity($cartItemId)
    {
        $this->updateQuantity($cartItemId, -1);
    }

    private function updateQuantity($cartItemId, $count)
    {
        $cartItem = Cart::where('id', $cartItemId)
            ->where('user_id', auth()->id())
            ->first();
        if ($cartItem && ($cartItem->quantity > 1 || $count > 0)) {
            $cartItem->quantity += $count;
            $cartItem->save();
            $this->loadCart();
            $this->calculateTotal();
        }
    }


}
