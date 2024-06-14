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
                <img src="{{url('../../assets/img/webp/blackandwhite.webp')}}" loading="lazy" alt="Item 1">
                <div class="banner-content text-white">
                    <div class="line"></div>
                    <span class="sub-title">{{__('messages.ShipAlloverMk')}}</span>
                    <h1>{{__('messages.AllInOne')}}</h1>
                    <p>{{__('messages.NewInspiration')}}</p>
                    <div class="btn-box">
                        <a href="/shop" class="default-btn">{{__('messages.GoShop')}}</a>
                        <a href="/courses" class="optional-btn">{{__('messages.OurCourses')}}</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{url('../../assets/img/redhairr.webp')}}" alt="Item 2" loading="lazy">
                <div class="banner-content text-white">
                    <div class="line"></div>
                    <span class="sub-title">{{__('messages.ShipAlloverMk')}}</span>
                    <h1>{{__('messages.AllInOne')}}</h1>
                    <p>{{__('messages.NewInspiration')}}</p>
                    <div class="btn-box">
                        <a href="/shop" class="default-btn">{{__('messages.GoShop')}}</a>
                        <a href="/courses" class="optional-btn">{{__('messages.OurCourses')}}</a>
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
                @auth
                    @if(auth()->user()->role == 2)
                        <div class="col-lg-6 col-md-12">
                            <div class="categories-box">
                                <img src="{{ asset('assets/img/webp/orrossss1.webp') }}" alt="Go To Shop" height="608.19" width="927.5">
                                <div class="content">
                                    <h3>Go To Shop!</h3>
                                </div>
                                <a href="{{ route('shop') }}" class="link-btn"></a>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-6 col-md-12">
                            <div class="categories-box">
                                <img src="{{ asset('assets/img/webp/orrossss1.webp') }}" alt="Products On Sale" height="608.19" width="927.5">
                                <div class="content">
                                    <h3>{{ __('messages.ProdOnSale') }}</h3>
                                </div>
                                <a href="{{ route('sales') }}" class="link-btn"></a>
                            </div>
                        </div>
                    @endif
                @endauth

                @guest
                    <div class="col-lg-6 col-md-12">
                        <div class="categories-box">
                            <img src="{{ asset('assets/img/webp/orrossss1.webp') }}" alt="Products On Sale" height="608.19" width="927.5">
                            <div class="content">
                                <h3>{{ __('messages.ProdOnSale') }}</h3>
                            </div>
                            <a href="{{ route('sales') }}" class="link-btn"></a>
                        </div>
                    </div>
                @endguest

                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="categories-box">
                                <img src="{{ asset('assets/img/webp/fanola color.webp') }}" alt="Fanola Color" height="289.31" width="451.75">
                                <div class="content">
                                    <h3>{{ __('messages.FColor') }}</h3>
                                </div>
                                <a href="{{ route('hair.colors', 'Fanola') }}" class="link-btn"></a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="categories-box">
                                <img src="{{ asset('assets/img/webp/OroTherapy Color.webp') }}" alt="OroTherapy Color" height="289.31" width="451.75">
                                <div class="content">
                                    <h3>{{ __('messages.OColor') }}</h3>
                                </div>
                                <a href="{{ route('hair.colors', 'Oro Therapy') }}" class="link-btn"></a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="categories-box">
                                <img src="{{ asset('assets/img/webp/RrLine Color.webp') }}" alt="RrLine Color" height="289.31" width="451.75">
                                <div class="content">
                                    <h3>{{ __('messages.RRColor') }}</h3>
                                </div>
                                <a href="{{ route('hair.colors', 'Rr Line') }}" class="link-btn"></a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="categories-box">
                                <img src="{{ asset('assets/img/webp/No Yellow Color.webp') }}" alt="No Yellow Color" height="289.31" width="451.75">
                                <div class="content">
                                    <h3>{{ __('messages.NYColor') }}</h3>
                                </div>
                                <a href="{{ route('hair.colors', 'No Yellow') }}" class="link-btn"></a>
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
                <span class="sub-title">{{__('messages.SeeCollection')}}</span>
                <h2>{{__('messages.RecentProducts')}}</h2>
            </div>
            <div class="row">
                @include('main.display-products')
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
                        <span class="sub-title">{{__('messages.limited_time_offer')}}</span>
                        <h2>{{__('messages.products_in_sale')}}</h2>
                        <p>{{__('messages.best_deals')}}</p>
                        <a href="/sale" class="default-btn">{{__('messages.go_to_sale')}}</a>
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
                <span class="sub-title">{{__('messages.most_popular')}}</span>
                <h2>{{__('messages.popular_products')}}</h2>
            </div>
            <div class="row">
                @include('main.display-products', ['products' =>$popularProducts])

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
                <h2>{{__('messages.ShopBrand')}}</h2>
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
                <span class="sub-title">{{__('messages.recent_story')}}</span>
                <h2>{{__('messages.from_our_courses')}}</h2>
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
