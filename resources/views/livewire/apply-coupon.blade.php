<div class="payment-box">
    <div class="form-group">
        <input type="text" wire:model="couponCode" class="form-control" placeholder="Enter your coupon code" optional>
        @if($errorMessage)
            <div class="alert alert-danger">{{ $errorMessage }}</div>
        @endif
    </div>
    <button wire:click.prevent="applyCoupon" class="default-btn">Apply Coupon</button>
</div>
