@extends('layouts.master')

@section('content')

<!-- Start Main Banner Area -->
{{--<div class="home-slides-two owl-carousel owl-theme">--}}
{{--    <div class="main-banner banner-bg2">--}}
{{--        <div class="d-table">--}}
{{--            <div class="d-table-cell">--}}
{{--                <div class="container-fluid">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-lg-6 col-md-12">--}}
{{--                            <div class="banner-content text-white">--}}
{{--                                <div class="line"></div>--}}
{{--                                <span class="sub-title">Products For All Your Needs</span>--}}
{{--                                <h1>New Inspiration!!! New Look!!!</h1>--}}
{{--                                <p>We ship All over Macedonia!!!</p>--}}
{{--                                <div class="btn-box">--}}
{{--                                    <a href="/shop" class="default-btn">Go To Shop</a>--}}
{{--                                    <a href="/courses" class="optional-btn">Our Courses</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="main-banner banner-bg4">--}}
{{--        <div class="d-table">--}}
{{--            <div class="d-table-cell">--}}
{{--                <div class="container-fluid">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-lg-6 col-md-12">--}}
{{--                            <div class="banner-content text-white">--}}
{{--                                <div class="line"></div>--}}
{{--                                <span class="sub-title">New Inspiration!!! New Look!!!</span>--}}
{{--                                <h1>Products For All Your Needs</h1>--}}
{{--                                <p>We ship All over Macedonia!!!</p>--}}
{{--                                <div class="btn-box">--}}
{{--                                    <a href="/shop" class="default-btn">Go To Shop</a>--}}
{{--                                    <a href="/courses" class="optional-btn">Our Courses</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="main-banner banner-bg5">--}}
{{--        <div class="d-table">--}}
{{--            <div class="d-table-cell">--}}
{{--                <div class="container-fluid">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-lg-6 col-md-12">--}}
{{--                            <div class="banner-content text-white">--}}
{{--                                <div class="line"></div>--}}
{{--                                <span class="sub-title">We ship All over Macedonia!!!</span>--}}
{{--                                <h1>All You Need in One Place</h1>--}}
{{--                                <p>New Inspiration!!! New Look!!!</p>--}}
{{--                                <div class="btn-box">--}}
{{--                                    <a href="/shop" class="default-btn">Go To Shop</a>--}}
{{--                                    <a href="/courses" class="optional-btn">Our Courses</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- End Main Banner Area -->
{{--<div class="main-banner">--}}
{{--    <div class="split-slideshow">--}}
{{--        <div class="slideshow">--}}
{{--            <div class="slider">--}}
{{--                <div class="item">--}}
{{--                    <img src="{{url('../../assets/img/redhairr.webp')}}" />--}}
{{--                </div>--}}
{{--                <div class="item">--}}
{{--                    <img src="{{url('../../assets/img/webp/blackandwhite.webp')}}" />--}}
{{--                </div>--}}
{{--                <div class="item">--}}
{{--                    <img src="{{url('../../assets/img/webp/brownhair.webp')}}" />--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="slideshow-text">--}}
{{--            <div class="item">Canyon</div>--}}
{{--            <div class="item">Desert</div>--}}
{{--            <div class="item">Erosion</div>--}}
{{--            <div class="item">Shape</div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<div class="carousel">
    <div class="carousel-background">

    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{url('../../assets/img/webp/blackandwhite.webp')}}" alt="Item 1">
            <div class="banner-content text-white">
                <div class="line"></div>
                <span class="sub-title">We ship All over Macedonia!!!</span>
                <h1>All You Need in One Place</h1>
                <p>New Inspiration!!! New Look!!!</p>
                <div class="btn-box">
                    <a href="/shop" class="default-btn">Go To Shop</a>
                    <a href="/courses" class="optional-btn">Our Courses</a>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{url('../../assets/img/redhairr.webp')}}" alt="Item 2">
            <div class="banner-content text-white">
                <div class="line"></div>
                <span class="sub-title">We ship All over Macedonia!!!</span>
                <h1>All You Need in One Place</h1>
                <p>New Inspiration!!! New Look!!!</p>
                <div class="btn-box">
                    <a href="/shop" class="default-btn">Go To Shop</a>
                    <a href="/courses" class="optional-btn">Our Courses</a>
                </div>
            </div>
        </div>
        <!-- Add more items here -->
    </div>
    <a class="carousel-control prev" onclick="moveToPrevSlide()"><i class='flaticon-left'></i></a>
    <a class="carousel-control next" onclick="moveToNextSlide()"><i class='flaticon-right-arrow'></i></a>
</div>





<!-- Start Categories Banner Area -->
<section class="categories-banner-area pt-100 pb-70">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                @if(auth()->user()->role == 2)
                <div class="categories-box">
                    <img src="{{asset('assets/img/webp/orrossss1.webp')}}" alt="image" height="608.19" width="927.5">

                    <div class="content">
                        <h3>Go To Shop!</h3>
                    </div>

                    <a href="{{route('Shop')}}" class="link-btn"></a>
                </div>
                @else
                    <div class="categories-box">
                        <img src="{{asset('assets/img/webp/orrossss1.webp')}}" alt="image" height="608.19" width="927.5">

                        <div class="content">
                            <h3>Products on Sale!</h3>
                        </div>

                        <a href="{{route('sales')}}" class="link-btn"></a>
                    </div>
                @endif
            </div>


            <div class="col-lg-6 col-md-12">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="categories-box">
                            <img src="{{asset('assets/img/webp/Fanola color.webp')}}" alt="image" height="289.31" width="451.75">

                            <div class="content">
                                <h3>Fanola Hair Colors</h3>
                            </div>

                            <a href="{{route('hair.colors','Fanola')}}" class="link-btn"></a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="categories-box">
                            <img src="{{asset('assets/img/webp/OroTherapy Color.webp')}}" alt="image" height="289.31" width="451.75">

                            <div class="content">
                                <h3>Oro Hair Colors</h3>
                            </div>

                            <a href="{{route('hair.colors', 'Oro Therapy')}}" class="link-btn"></a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="categories-box">
                            <img src="{{asset('assets/img/webp/RrLine Color.webp')}}" alt="image" height="289.31" width="451.75">

                            <div class="content">
                                <h3>RR Hair Colors</h3>
                            </div>

                            <a href="{{route('hair.colors', 'RrLine')}}" class="link-btn"></a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="categories-box">
                            <img src="{{asset('assets/img/webp/No Yellow Color.webp')}}" alt="image" height="289.31" width="451.75">

                            <div class="content">
                                <h3>No Yellow Color</h3>
                            </div>

                            <a href="{{route('hair.colors', 'No Yellow')}}" class="link-btn"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Categories Banner Area -->

<!-- Start Products Area -->


<section class="products-area pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <span class="sub-title">See Our Collection</span>
            <h2>Recent Products</h2>
        </div>

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
                            <livewire:cart.add-to-cart :product_id="$product->id" :key="$product->id" />
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
            @endforeach
        </div>
    </div>
</section>


<!-- End Products Area -->

<!-- Start Offer Area -->
<section class="offer-area bg-image2 ptb-100 jarallax" data-jarallax='{"speed": 0.3}'>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 col-md-6 offset-lg-7 offset-md-6">
                <div class="offer-content-box">
                    <span class="sub-title">Limited Time Offer!</span>
                    <h2>-40% OFF</h2>
                    <p>Get The Best Deals Now</p>
                    <a href="../products-sidebar-fullwidth.html" class="default-btn">Discover Now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Offer Area -->

<!-- Start Products Area -->
<section class="products-area pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <span class="sub-title">See Our Collection</span>
            <h2>Popular Products</h2>
        </div>

        <div class="row">
            @foreach($popularProducts as $product)
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
                            <livewire:cart.add-to-cart :product_id="$product->id" :key="$product->id" />
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
            @endforeach
        </div>
    </div>
</section>
<style>
    /* Product Images */
    .products-image img {
        width: 100%;
        height: auto;
        max-width: 416px; /* Adjust this value based on your layout needs */
    }

    /* Product Box Layout Using Flexbox */
    .products-box {
        padding: 10px;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Helps space out elements like images, details, and buttons */
    }

    /* Product Content Management */
    .products-content {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    /* Preventing Text Overflow */
    .products-content h3, .products-content .category {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Responsive Grid Adjustments */
    @media (max-width: 768px) {
        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

    @media (max-width: 576px) {
        .col-sm-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
    @media (min-width: 577px) and (max-width: 768px) {
        .products-box .default-btn {
            height: 40px; /* Set this height to what looks best in your design */
            padding: 5px 10px; /* Adjust padding if necessary to fit the button text */
            font-size: 12px; /* Optionally adjust the font size for smaller screens */
        }
    }
</style>

<div class="brand-area ptb-70">
    <div class="container">
        <div class="section-title">
            <h2>Shop By Brand</h2>
        </div>

        <div class="brand-slides">
            <div class="brand-item">
                <a href="{{route('shop.brand', 'RrLine')}}"><img src="assets/img/webp/shopbybrand1.webp" alt="image"></a>
            </div>
            <div class="brand-item">
                <a href="{{route('shop.brand', 'Fanola')}}"><img src="assets/img/brand/shopbybrand2.jpg" alt="image"></a>
            </div>
            <div class="brand-item">
                <a href="{{route('shop.brand', 'No Yellow')}}"><img src="assets/img/webp/shopbybrand2.webp" alt="image"></a>
            </div>
            <div class="brand-item">
                <a href="{{route('shop.brand', 'Oro Therapy')}}"><img src="assets/img/webp/shopbybrand3.webp" alt="image"></a>
            </div>
            <div class="brand-item">
                <a href="{{route('shop.brand', 'RrLine')}}"><img src="assets/img/webp/shopbybrand3.webp" alt="image"></a>
            </div>
        </div>
    </div>
</div>

<!-- Start Blog Area -->
<section class="blog-area pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <span class="sub-title">Recent Story</span>
            <h2>From Our Courses</h2>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-blog-post">
                    <div class="post-image">
                        <a href="../blog-1.html">
                            <img src="assets/img/course-1.jpg" alt="image" width="416" height="320">
                        </a>
                        <div class="date">
                            <span>January 29, 2021</span>
                        </div>
                    </div>

                    <div class="post-content">
                        <span class="category">Ideas</span>
                        <h3><a href="../blog-1.html">The new hairstyles to grow your business</a></h3>
                        <a href="../blog-1.html" class="details-btn">Read Story</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-blog-post">
                    <div class="post-image">
                        <a href="../blog-1.html">
                            <img src="assets/img/course-2.jpg" alt="image" width="416" height="320">
                        </a>
                        <div class="date">
                            <span>January 29, 2021</span>
                        </div>
                    </div>

                    <div class="post-content">
                        <span class="category">Advice</span>
                        <h3><a href="../blog-1.html">Latest trends</a></h3>
                        <a href="../blog-1.html" class="details-btn">Read Story</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-blog-post">
                    <div class="post-image">
                        <a href="../blog-1.html">
                            <img src="assets/img/course-3.jpg" alt="image" width="416" height="320">
                        </a>
                        <div class="date">
                            <span>January 29, 2021</span>
                        </div>
                    </div>

                    <div class="post-content">
                        <span class="category">Social</span>
                        <h3><a href="../blog-1.html">Advanced hairstylist's</a></h3>
                        <a href="../blog-1.html" class="details-btn">Read Story</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Blog Area -->
@endsection
@section('scripts')
<script src="{{ asset('assets/js/carousel.js') }}" defer></script>
@endsection
