<?php

namespace App\Livewire\Cart;

use Livewire\Component;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;

class AddToCart extends Component
{
    public $productId;
    protected $listeners = ['cartCheck' => 'checkCartCount', 'addToCart' => 'addToCart'];

    //protected $cartService;

    public function mount($product_id)
    {
        $this->productId = $product_id;
        //$this->cartService = app(CartService::class);  // Manually resolving the service
    }

    public function addToCart($quantity)
    {
        $cartService= new CartService();
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect if not authenticated
        }

        try {
            $cartService->addToCart(Auth::id(), $this->productId, $quantity);
            $this->checkCartCount(); // Update the cart count
        } catch (\Exception $e) {
            // Handle errors (e.g., log them, display messages)
            session()->flash('error', 'Failed to add to cart: ' . $e->getMessage());
        }
    }

    public function checkCartCount()
    {
        $this->dispatch('cart_updated'); // Trigger a browser event
        $this->dispatch('load_cart');
    }

    public function render()
    {
        return view('livewire.cart.add-to-cart');
    }

}


