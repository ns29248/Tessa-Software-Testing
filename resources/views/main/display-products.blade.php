<div class="row">
    @foreach($products as $product)
        <div class="col-lg-4 col-md-6 col-sm-6" wire:key="{{$product->id}}">
            <div class="products-box">
                <div class="products-image">
                    <a href="{{ route('showProduct', $product->id) }}">
                        <img src="{{ asset('storage/images/'.$product->image->name) }}" class="main-image" alt="image" width="416" height="496.7">
                        <img src="{{ asset('storage/images/'.$product->image->name) }}" class="hover-image" alt="image" width="416" height="496.7">
                    </a>
                </div>

                <div class="products-content">
                    <div class="header-content">
                        <span class="category">{{$product->category->name}}</span>
                        <div class="wishlist products-button">
                            @auth()
                                <livewire:wishlist :product_id="$product->id" />
                            @endauth
                        </div>
                    </div>
                    <h3><a href="#">{{$product->name}}</a></h3>
                    <div class="price">
                        @if(auth()->check() && auth()->user()->role == 2)
                            <span class="new-price">{{ $product->stylist_price }}den</span>
                        @elseif($product->sale()->active()->exists())
                            <span class="old-price">${{ $product->price }}</span>
                            <span class="new-price">${{ $product->sale->sale_price }}</span>
                        @else
                            <span class="new-price">{{ $product->price }}den</span>
                        @endif
                    </div>
                    <input type="hidden" value="{{$product->id}}" class="prod_id">
                    <livewire:cart.add-to-cart :product_id="$product->id" :key="$product->id" />
                </div>
                @if($product->sale()->active()->exists())
                    <span class="products-discount">
                            <span>
                                {{__('messages.sale')}}
                            </span>
                        </span>
                @endif
            </div>
        </div>
    @endforeach
</div>
