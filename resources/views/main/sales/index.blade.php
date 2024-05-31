@extends('layouts.master') {{-- Replace with your actual layout file --}}

@section('content')
    <!-- Start Page Title -->
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>Sales</h2>
                <ul>
                    <li><a href="{{ url('/') }}">{{__('messages.home')}}</a></li>
                    <li>Sales</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title -->


    <!-- Start Sales Products Area -->
    <section class="products-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                @foreach($sales as $sale) {{-- Loop through sales items --}}
                <div class="col-lg-4 col-md-6 col-sm-6" wire:key="{{$sale->product->id}}">
                    <div class="products-box">
                        <div class="products-image">
                            <a href="{{ route('showProduct', $sale->product->id) }}">
                                <img src="{{ asset('storage/images/'.$sale->product->image->name) }}" class="main-image" alt="image">
                                <img src="{{ asset('storage/images/'.$sale->product->image->name) }}" class="hover-image" alt="image">
                            </a>

                            <div class="products-button">
                                <ul>
                                    <li>
                                        @livewire('wishlist', ['product_id' => $sale->product->id])
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

                            <div class="sale-tag">Sale!</div>
                        </div>

                        <div class="products-content">
                            <span class="category">{{$sale->product->category->name}}</span>
                            <h3><a href="{{ route('showProduct', $sale->product->id) }}">{{ $sale->product->name }}</a></h3>
                            <div class="price">
                                <span class="old-price">${{ $sale->product->price }}</span>
                                <span class="new-price">${{ $sale->sale_price }}</span>
                            </div>
                            @livewire('add-to-cart', ['product_id' => $sale->product->id])
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Sales Products Area -->
@endsection
