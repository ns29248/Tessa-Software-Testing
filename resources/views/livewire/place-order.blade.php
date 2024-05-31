<form wire:submit.prevent="placeOrder">
    <div>
        <div class="order-details">
            <h3 class="title">Your Order</h3>

            <div class="order-table table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cartItems as $cartItem)
                        <tr>
                            <td class="product-name">{{ $cartItem->product->name }}</td>
                            <td class="product-quantity">{{ $cartItem->quantity }}</td>
                            <td class="product-total">{{ $cartItem->price * $cartItem->quantity }} den</td>
                        </tr>
                    @endforeach

                    {{-- Dynamically show the coupon discount if applied --}}
                    @if($discount)
                        <tr>
                            <td colspan="2" class="text-right">Coupon Discount: </td>
                            <td>-{{ $discount }} den</td>
                        </tr>
                    @endif

                    {{-- Dynamically calculate and show the order total --}}
                    <tr>
                        <td colspan="2" class="text-right"><strong>Order Total:</strong></td>
                        <td>{{ $finalTotal }} den</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div>
                @if(auth()->check() && auth()->user()->role == 2)
                    @livewire('apply-coupon')
                @endif
            </div>
        </div>
    </div>

    <div class="payment-box">
        <div class="payment-method">
            <p>
                <label for="cash-on-delivery">Cash on Delivery</label>
            </p>
        </div>

        <button type="submit" wire:model="placeOrder" class="default-btn">Place Order</button>
    </div>
</form>
