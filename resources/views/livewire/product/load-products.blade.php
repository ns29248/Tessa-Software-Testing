<div>
    <style>


        .category {
            display: block;
            margin-bottom: 10px;
            text-transform: uppercase;
            color: #f53f85;
            font-weight: 600;
            font-size: 14px;
        }
        .sub-title {
            display: block;
            margin-bottom: 7px;
            font-size: 17.5px;

            color: black;
            font-weight: bold;
        }


    </style>
    <div id="products-collections-filter" class="row">
        @foreach($products as $product)
            <div wire:key="{{ $product->id }}" class="col-lg-4 col-md-6 col-sm-6 products-col-item">
                <div class="single-products-box">
                    <div class="products-image">
                        <a href="{{ route('showProduct', $product->id) }}">
                            <img src="{{ asset('storage/images/'.$product->image->name) }}" loading="lazy" class="main-image" alt="image" />
                            <img src="{{ asset('storage/images/'.$product->image->name) }}" loading="lazy" class="hover-image" alt="image" />
                        </a>
                        @if($product->sale()->active()->exists())
                            <div class="sale-tag">{{__('messages.sale')}}</div>
                        @endif
                        <div class="products-button">
                            <ul>
                                <li>
                                    <div class="wishlist-btn">
                                        <a href="#">
                                            <i class="bx bx-heart"></i>
                                            <span class="tooltip-label">{{__('messages.AddToWishlist')}}</span>
                                        </a>
                                    </div>
                                </li>
                            </ul>

                        </div>
                        <div class="products-content">
                            <span class="category">{{$product->brand->name}}</span>
                            <span class="category">{{$product->category->name}}</span>
                            <h3><a href="#">{{ $product->name }}</a></h3>
                            <div class="price">
                                @if(auth()->check() && auth()->user()->role == 2)
                                    <span class="new-price">{{ $product->stylist_price }}{{__('messages.den')}}</span>
                                @elseif($product->sale()->active()->exists())
                                    <span class="old-price">${{ $product->price }} {{__('messages.den')}}</span>
                                    <span class="new-price">${{ $product->sale->sale_price }} {{__('messages.den')}}</span>
                                @else
                                    <span class="new-price">{{ $product->price }}{{__('messages.den')}}</span>
                                @endif
                            </div>
                            <livewire:cart.add-to-cart :product_id="$product->id" :key="$product->id" />
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <style>
        .products-image img {
            width: 100%;
            height: auto;
            aspect-ratio: 670 / 800;
        }
    </style>


    <!-- Start Products Filter Modal Area -->
    <div class="text-center">
        <div class="text-center" wire:loading>
            <button class="default-btn">{{__('messages.Loading')}}</button>
        </div>

        <div class="text-center" wire:loading.remove>
            @if ($noMoreProducts)
                <span class="sub-title">{{__('messages.NoMoreProd')}}</span>
            @else
                <button wire:click="load" class="default-btn">{{__('messages.LoadMore')}}</button>
            @endif
        </div>
    </div>
</div>


