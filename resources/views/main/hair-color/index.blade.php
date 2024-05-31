@extends('layouts.master') {{-- Replace with your actual layout file --}}

@section('content')
    <!-- Start Page Title -->
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>Colors</h2>
                <ul>
                    <li><a href="{{ url('/') }}">{{__('messages.home')}}</a></li>
                    <li>Colors</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title -->


    <!-- Start Sales Products Area -->
    <section class="products-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                @foreach($products as $product) {{-- Loop through sales items --}}
                <div class="col-lg-4 col-md-6 col-sm-6" wire:key="{{$product->id}}">
                    <div class="products-box">
                        <div class="products-image">
                            <a href="{{ route('showProduct', $product->id) }}">
                                <img src="{{ asset('storage/images/'.$product->image->name) }}" class="main-image" alt="image">
                                <img src="{{ asset('storage/images/'.$product->image->name) }}" class="hover-image" alt="image">
                            </a>

                            <div class="products-button">
                                <ul>
                                    <li>
                                        @livewire('wishlist', ['product_id' => $product->id])
                                    </li>

                                    <li>
                                        <div class="quick-view-btn">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#productsQuickView">
                                                <i class='bx bx-search-alt'></i>
                                                <span class="tooltip-label">Quick View</span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="products-content">
                            <span class="category">{{$product->category->name}}</span>
                            <h3><a href="{{ route('showProduct', $product->id) }}">{{ $product->name }}</a></h3>
                            <div class="price">
                                <span class="price">{{ $product->price }}den</span>
{{--                                <span class="new-price">${{ $product->sale->sale_price }}</span>--}}
                            </div>
                            @livewire('add-to-cart', ['product_id' => $product->id])
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Sales Products Area -->
@endsection
