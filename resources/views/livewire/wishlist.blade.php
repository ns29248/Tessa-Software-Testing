<div class="wishlist-btn">
    <a href="#" wire:click.prevent="toggleWishlist">
        <i class='bx {{ $isWishlisted ? 'bxs-heart' : 'bx-heart' }}' style="color: {{ $isWishlisted ? '#ff4081' : 'gray' }};"></i>
    </a>
</div>

