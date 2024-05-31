<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class Wishlist extends Component
{
    public $productId;
    public $isWishlisted = false;

    public function mount($product_id)
    {
        $this->productId = $product_id;
        $this->isWishlisted = $this->checkWishlist();
    }

    public function toggleWishlist()
    {
        $user = auth()->user();
        if ($this->isWishlisted) {
            // Detach the product from the user's wishlist
            $user->products()->detach($this->productId);
        } else {
            // Attach the product to the user's wishlist
            $user->products()->attach($this->productId);
        }
        $this->isWishlisted = !$this->isWishlisted;
    }

    private function checkWishlist()
    {
        return auth()->user()->products()->find($this->productId) !== null;
    }

    public function render()
    {
        return view('livewire.wishlist');
    }
}
