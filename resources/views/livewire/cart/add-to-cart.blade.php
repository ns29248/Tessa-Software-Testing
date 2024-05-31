<div x-data="{ quantityCount: 1 }" class="d-flex align-items-center" style="padding-top: 15px;">
    <button type="submit" wire:click.prevent="addToCart(quantityCount)" x-on:click="quantityCount = 1" class="default-btn">{{__('messages.AddCart')}}</button>
    <form class="input-counter">
        <span class="minus-btn" x-on:click="quantityCount > 1 ? quantityCount-- : null"><i class="bx bx-minus"></i></span>
        <input type="text" class="qty-input" x-model="quantityCount" />
        <span class="plus-btn" x-on:click="quantityCount++"><i class="bx bx-plus"></i></span>
    </form>
</div>
