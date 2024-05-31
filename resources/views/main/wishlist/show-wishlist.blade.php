@extends('layouts.master') {{-- Make sure this refers to your actual layout file --}}

@section('content')
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>Wishlist</h2>
                <ul>
                    <li><a href="{{ url('/') }}">{{__('messages.home')}}</a></li>
                    <li>Wishlist</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="products-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                @forelse($wishlistedProducts as $product)
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
                                        @livewire('wishlist', ['product_id' => $product->id])
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
                                @livewire('add-to-cart', ['product_id' => $product->id])
                            </div>
                            @if($product->sale()->active()->exists())
                                <span class="products-discount">
                            <span>
                                Sale!
                            </span>
                        </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <p>No products in your wishlist.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
