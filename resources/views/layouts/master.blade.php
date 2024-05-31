<!doctype html>
<html lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Preloading Fonts for performance -->
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Lato:400&display=block" as="style" onload="this.rel='stylesheet'">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Cabin:400&display=fallback" as="style" onload="this.rel='stylesheet'">

    <!-- Preloading and Loading CSS files -->
    <link rel="preload" href="{{ asset('assets/css/bootstrap.min.css') }}" as="style" onload="this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('assets/css/style.css') }}" as="style" onload="this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('assets/css/responsive.css') }}" as="style" onload="this.rel='stylesheet'">
{{--    <link rel="preload" href="{{ asset('assets/css/owl.carousel.min.css') }}" as="style" onload="this.rel='stylesheet'">--}}

    <!-- Regular style links -->
{{--    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('assets/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('assets/css/slick.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('assets/css/rangeSlider.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('assets/css/dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bottom-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/carousel.css') }}">

    @if(!isset($excludeGlobalStyles))
        <link rel="stylesheet" href="{{ asset('assets/css/table.css') }}">
    @endif

    @livewireStyles

    <title>Tessa Academy</title>
    <link rel="icon" type="image/png" href="{{asset('assets/img/tessapurplelogo-01.png')}}">

</head>
<body>
<div class="switch-box">
    <label class="switch">
        <input type="checkbox" id="darkModeSwitch">
        <span class="slider round"></span>
    </label>
</div>
<!-- Start Top Header Area -->
<div class="top-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <ul class="header-contact-info">
                    <li>{{__('messages.welcome')}}</li>
                    <li>
                        <div class="dropdown language-switcher d-inline-block">
                            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(App::currentLocale() == "shq")
                                    <img src="{{ asset('assets/img/albania-flag-01.png') }}" alt="image" />
                                    <span>AL <i class="bx bx-chevron-down"></i></span>
                                @elseif(App::currentLocale() == "en")
                                    <img src="{{ asset('assets/img/us-flag.jpg') }}" alt="image" />
                                    <span>EN <i class="bx bx-chevron-down"></i></span>
                                @elseif(App::currentLocale() == "mk")
                                    <img src="{{ asset('assets/img/macedonia-flag-01.png') }}" alt="image" />
                                    <span>MK <i class="bx bx-chevron-down"></i></span>
                                @endif
                            </button>
                            <div class="dropdown-menu">
                                <a href="{{ route('set.language', 'en') }}" class="dropdown-item d-flex align-items-center">
                                    <img src="{{ asset('assets/img/us-flag.jpg') }}" class="shadow-sm" alt="flag" />
                                    <span>EN</span>
                                </a>
                                <a href="{{ route('set.language', 'shq') }}" class="dropdown-item d-flex align-items-center">
                                    <img src="{{ asset('assets/img/albania-flag-01.png') }}" class="shadow-sm" alt="flag" />
                                    <span>AL</span>
                                </a>
                                <a href="{{ route('set.language', 'mk') }}" class="dropdown-item d-flex align-items-center">
                                    <img src="{{ asset('assets/img/macedonia-flag-01.png') }}" class="shadow-sm" alt="flag" />
                                    <span>MK</span>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-12 d-flex justify-content-end">
                <div class="d-none d-lg-block">
                    @auth
                        <ul class="header-top-menu">
                            <li><a href="#"><i class="bx bxs-user"></i>{{__('messages.my_account')}}</a></li>
                            @if(!auth()->user()->request_submitted)
                                <li><a href="{{ url('request_form') }}"><i class="bx bx-log-in"></i>{{__('messages.request_stylist')}}</a></li>
                            @endif
                            <li><a href="{{ route('my.orders') }}"><i class="bx bxs-user"></i>{{__('messages.my_orders')}}</a></li>
                            <li>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="text-decoration: none; color: inherit; display: flex; align-items: center;">
                                    <i class="bx bx-log-in"></i> <span style="margin-left: 5px;">{{__('messages.log_out')}}</span>
                                </a>
                                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    @else
                        <ul class="header-top-menu">
                            <li><a href="{{ route('login') }}"><i class="bx bx-log-in"></i>{{__('messages.login')}}</a></li>
                            <li><a href="{{ route('register') }}"><i class="bx bx-log-in"></i>{{__('messages.register')}}</a></li>
                        </ul>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Top Header Area -->
<!-- Start Phone Sidebar-->
<!-- Start Phone Sidebar-->
<div class="modal right fade sidebarModal" id="sidebarModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class='bx bx-x'></i></span>
            </button>
            <div class="modal-body">
                <ul class="nav-menu-list">
                    <li class="hide-on-mobile"><a href="{{ url('/') }}"><i class="bx bx-home"></i>{{__('messages.home')}}</a></li>
                    <li  class="hide-on-mobile"><a href="{{ route('shop') }}"><i class="bx bx-store"></i>{{__('messages.shop')}}</a></li>
                    <li  class="hide-on-mobile"><a href="{{ route('show.wishlist') }}"><i class="bx bx-heart"></i>{{__('messages.wishlist')}}</a></li>
                    <li><a href="{{ route('courses') }}"><i class="bx bx-book {{ request()->routeIs('courses') ? ' active' : '' }}"></i>{{__('messages.courses')}}</a></li>
                    <li><a href="about-us.html"><i class="bx bx-info-circle"></i>{{__('messages.about_us')}}</a></li>
                    <li><a href="contact.html"><i class="bx bx-phone"></i>{{__('messages.contact')}}</a></li>
                    @auth()
                        <li><a href="my-account.html"><i class="bx bxs-user"></i>{{__('messages.my_account')}}</a></li>
                        @if(!auth()->user()->request_submitted)
                            <li><a href="{{ url('request_form') }}"><i class="bx bx-log-in"></i>{{__('messages.request_stylist')}}</a></li>
                        @endif
                        <li><a href="{{ route('my.orders') }}"><i class="bx bx-package"></i>{{__('messages.my_orders')}}</a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                                <i class="bx bx-log-out"></i> Logout</a></li>
                </ul>
                <form id="logout-form-sidebar" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>
                @else
                    <ul class="nav-menu-list">
                        <li><a href="{{ route('login') }}"><i class="bx bx-log-in"></i>{{__('messages.login')}}</a></li>
                        <li><a href="{{ route('register') }}"><i class="bx bx-log-in"></i>{{__('messages.register')}}</a></li>
                    </ul>
                @endauth
            </div>
        </div>
    </div>
</div>
<!-- End Phone Sidebar-->

<!-- Start Navbar Area -->
<div class="navbar-area">
    <div class="xton-responsive-nav">
        <div class="container">
            <div class="xton-responsive-menu">
                <!-- Logo on the left -->
                <div class="logo">
                    <a href="/">
                        <img src="{{asset('assets/img/tessablack3.png')}}" class="main-logo" alt="logo" />
                        <img src="{{asset('assets/img/tesawhitelogo.png')}}" class="white-logo" alt="logo" />
                    </a>
                </div>

                <!-- Search, Cart, and Burger Menu on the far right -->
                <div class="others-option">
                    <div class="option-item">
                        <div class="search-btn-box">
                            <i class="search-btn bx bx-search-alt"></i>
                        </div>
                    </div>
                    <div class="option-item">
                        <livewire:cart.cart-counter/>
                    </div>
                </div>

                <!-- Burger Menu -->
                <div class="burger-menu" data-bs-toggle="modal" data-bs-target="#sidebarModal">
                    <span class="top-bar"></span>
                    <span class="middle-bar"></span>
                    <span class="bottom-bar"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="xton-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{url('/')}}">
                    <img src="{{asset('assets/img/tessalogo2.png')}}" class="main-logo" alt="logo" />
                    <img src="{{asset('assets/img/tesawhitelogo.png')}}" class="white-logo" alt="logo" />
                </a>
                <div class="collapse navbar-collapse mean-menu">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link{{ request()->routeIs('show_products') ? ' active' : '' }}">{{__('messages.home')}}</a>
                        </li>
                        <li class="nav-item megamenu">
                            <a href="{{ route('shop') }}" class="nav-link{{ request()->routeIs('shop') ? ' active' : '' }}">{{__('messages.shop')}}</a>
                        </li>
                        <li class="nav-item megamenu">
                            <a href="{{ route('courses') }}" class="nav-link{{ request()->routeIs('courses') ? ' active' : '' }}">{{__('messages.courses')}}</a>
                        </li>
                        <li class="nav-item megamenu">
                            <a href="../about.html" class="nav-link">{{__('messages.about_us')}}</a>
                        </li>
                        <li class="nav-item megamenu">
                            <a href="../contact.html" class="nav-link">{{__('messages.contact')}}</a>
                        </li>
                    </ul>
                </div>
                <div class="others-option">
                    <div class="option-item">
                        <div class="search-btn-box">
                            <i class="search-btn bx bx-search-alt"></i>
                        </div>
                    </div>
                    <div class="option-item">
                        <livewire:cart.cart-counter/>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- End Navbar Area -->
<!-- Start Sticky Navbar Area -->
<div class="navbar-area header-sticky">
    <div class="xton-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{url('/')}}">
                    <img src="{{asset('assets/img/tessablack3.png')}}" class="main-logo" alt="logo" />
                    <img src="{{asset('assets/img/tesawhitelogo.png')}}" class="white-logo" alt="logo" />
                </a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link{{ request()->routeIs('show_products') ? ' active' : '' }}">{{__('messages.home')}}</a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('shop') }}" class="nav-link{{ request()->routeIs('shop') ? ' active' : '' }}">{{__('messages.shop')}}</a>
                        </li>
                        <li class="nav-item ">
                            <a href="../blog-1.html" class="nav-link">{{__('messages.courses')}}</a>
                        </li>
                        <li class="nav-item ">
                            <a href="../about.html" class="nav-link">{{__('messages.about_us')}}</a>
                        </li>
                        <li class="nav-item ">
                            <a href="../contact.html" class="nav-link">{{__('messages.contact')}}</a>
                        </li>
                    </ul>
                    <div class="others-option">
                        <div class="option-item">
                            <div class="search-btn-box">
                                <i class="search-btn bx bx-search-alt"></i>

                            </div>
                        </div>
                        <div class="option-item">
                            <livewire:cart.cart-counter/>
                        </div>
                        <div class="option-item">
                            <div class="burger-menu" data-bs-toggle="modal" data-bs-target="#sidebarModal">
                                <span class="top-bar"></span>
                                <span class="middle-bar"></span>
                                <span class="bottom-bar"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- End Header Area -->
<!-- Start Search Overlay -->
<livewire:search/>
<!-- End Search Overlay -->

@yield('content')

<!-- Start Instagram Area -->
<div class="instagram-area">
    <div class="container-fluid">
        <div class="instagram-title">
            <a href="https://www.instagram.com/tessabeauty.institute/" target="_blank"><i class='bx bxl-instagram'></i>{{__('messages.follow_us')}}</a>
        </div>

        <div class="instagram-slides">
            <div class="single-instagram-post">
                <img src="{{asset('assets/img/instagram/foto1.jpg')}}" alt="image" width="317.16" height="317.16">
                <i class='bx bxl-instagram'></i>
                <a href="https://www.instagram.com/tessabeauty.institute/" target="_blank" class="link-btn"></a>
            </div>

            <div class="single-instagram-post">
                <img src="{{asset('assets/img/instagram/foto2.jpg')}}" alt="image" width="317.16" height="317.16">
                <i class='bx bxl-instagram'></i>
                <a href="https://www.instagram.com/tessabeauty.institute/" target="_blank" class="link-btn"></a>
            </div>

            <div class="single-instagram-post">
                <img src="{{asset('assets/img/instagram/foto3.jpg')}}" alt="image" width="317.16" height="317.16">
                <i class='bx bxl-instagram'></i>
                <a href="https://www.instagram.com/tessabeauty.institute/" target="_blank" class="link-btn"></a>
            </div>

            <div class="single-instagram-post">
                <img src="{{asset('assets/img/instagram/foto4.jpg')}}" alt="image" width="317.16" height="317.16">
                <i class='bx bxl-instagram'></i>
                <a href="https://www.instagram.com/tessabeauty.institute/" target="_blank" class="link-btn"></a>
            </div>

            <div class="single-instagram-post">
                <img src="{{asset('assets/img/instagram/foto5.jpg')}}" alt="image" width="317.16" height="317.16">
                <i class='bx bxl-instagram'></i>
                <a href="https://www.instagram.com/tessabeauty.institute/" target="_blank" class="link-btn"></a>
            </div>

            <div class="single-instagram-post">
                <img src="{{asset('assets/img/instagram/foto6.jpg')}}" alt="image" width="317.16" height="317.16">
                <i class='bx bxl-instagram'></i>
                <a href="https://www.instagram.com/tessabeauty.institute/" target="_blank" class="link-btn"></a>
            </div>

            <div class="single-instagram-post">
                <img src="{{asset('assets/img/instagram/foto7.jpg')}}" alt="image" width="317.16" height="317.16">
                <i class='bx bxl-instagram'></i>
                <a href="https://www.instagram.com/tessabeauty.institute/" target="_blank" class="link-btn"></a>
            </div>

            <div class="single-instagram-post">
                <img src="{{asset('assets/img/instagram/foto1.jpg')}}" alt="image" width="317.16" height="317.16">
                <i class='bx bxl-instagram'></i>
                <a href="https://www.instagram.com/tessabeauty.institute/" target="_blank" class="link-btn"></a>
            </div>

            <div class="single-instagram-post">
                <img src="{{asset('assets/img/instagram/foto2.jpg')}}" alt="image" width="317.16" height="317.16">
                <i class='bx bxl-instagram'></i>
                <a href="https://www.instagram.com/tessabeauty.institute/" target="_blank" class="link-btn"></a>
            </div>

            <div class="single-instagram-post">
                <img src="{{asset('assets/img/instagram/foto3.jpg')}}" alt="image" width="317.16" height="317.16">
                <i class='bx bxl-instagram'></i>
                <a href="https://www.instagram.com/tessabeauty.institute/" target="_blank" class="link-btn"></a>
            </div>
        </div>
    </div>
</div>
<!-- End Instagram Area -->
<!-- Start Shopping Cart Modal -->
<div class="modal right fade shoppingCartModal" id="shoppingCartModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class='bx bx-x'></i></span>
            </button>
            <livewire:cart.show-cart :view="'show-cart-modal'" />
        </div>
    </div>
    </div>
</div>
<!-- End Shopping Cart Modal -->
<!-- Start Footer Area -->
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h3>{{__('messages.about_the_store')}}</h3>
                    <div class="about-the-store">
                        <ul class="footer-contact-info">
                            <li>
                                <i class="bx bx-map"></i>
                                <a href="#" target="_blank">{{__('messages.gv_nmkd')}}</a>
                            </li>
                            <li>
                                <i class="bx bx-phone-call"></i>
                                <a href="">+389 78 286 003</a>
                            </li>
                            <li>
                                <i class="bx bx-envelope"></i>
                                <a href="">tessa.academy@gmail.com</a>
                            </li>
                        </ul>
                    </div>
                    <ul class="social-link">
                        <li>
                            <a href="#" class="d-block" target="_blank"
                            ><i class="bx bxl-facebook"></i
                                ></a>
                        </li>
                        <li>
                            <a href="#" class="d-block" target="_blank"
                            ><i class="bx bxl-twitter"></i
                                ></a>
                        </li>
                        <li>
                            <a href="#" class="d-block" target="_blank"
                            ><i class="bx bxl-instagram"></i
                                ></a>
                        </li>
                        <li>
                            <a href="#" class="d-block" target="_blank"
                            ><i class="bx bxl-linkedin"></i
                                ></a>
                        </li>
                        <li>
                            <a href="#" class="d-block" target="_blank"
                            ><i class="bx bxl-pinterest-alt"></i
                                ></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget pl-4">
                    <h3>{{__('messages.quick_links')}}</h3>
                    <ul class="quick-links">
                        <li><a href="{{url('/')}}">{{__('messages.home')}}</a></li>
                        <li><a href="../products-sidebar-fullwidth.html">{{__('messages.shop')}}</a></li>
                        <li><a href="../blog-1.html">{{__('messages.courses')}}</a></li>
                        <li><a href="../about.html">{{__('messages.about_us')}}</a></li>
                        <li><a href="../contact.html">{{__('messages.contact')}}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h3>{{__('messages.customer_support')}}</h3>
                    <ul class="customer-support">
                        <li><a href="../login.html">{{__('messages.my_account')}}</a></li>
                        <li><a href="../cart.html">{{__('messages.Cart')}}</a></li>
                        <li><a href="../contact.html">{{__('messages.Help')}}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h3>{{__('messages.NewsLetter')}}</h3>
                    <div class="footer-newsletter-box">
                        <p>{{__('messages.newsletter_prompt')}}</p>
                        <form class="newsletter-form" data-bs-toggle="validator">
                            <label>{{__('messages.your_email_address')}}</label>
                            <input
                                type="email"
                                class="input-newsletter"
                                placeholder="Enter your email"
                                name="EMAIL"
                                required
                                autocomplete="off"
                            />
                            <button type="submit">{{__('messages.subscribe')}}</button>
                            <div id="validator-newsletter" class="form-result"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom-area">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">

                </div>
                <div class="col-lg-6 col-md-6">
                    <ul class="payment-types">
                        <li>

                            <img src="{{asset('assets/img/payment/visa.png')}}" alt="image"
                            />
                        </li>
                        <li>

                            <img src="{{asset('assets/img/payment/mastercard.png')}}" alt="image"
                            />
                        </li>
                        <li>

                            <img src="{{asset('assets/img/payment/mastercard2.png')}}" alt="image"
                            />
                        </li>
                        <li>

                            <img src="{{asset('assets/img/payment/visa2.png')}}" alt="image"
                            />
                        </li>
                        <li>

                            <img src="{{asset('assets/img/payment/expresscard.png')}}" alt="image"
                            />
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="lines">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>
</footer>
<!-- End Footer Area -->

<div class="bottom-navbar">
    <div class="container ">
        <nav class="navbar">
            <a href="{{ url('/') }}" class="nav-item{{ request()->is('/') ? ' active' : '' }}">
                <i class="bx bx-home-alt"></i>
                <span>{{__('messages.home')}}</span>
            </a>
            <a href="{{ route('shop') }}" class="nav-item{{ request()->is('shop') ? ' active' : '' }}">
                <i class="bx bx-store"></i>
                <span>{{__('messages.shop')}}</span>
            </a>
            <a href="{{ route('show.wishlist') }}" class="nav-item{{ request()->is('wishlist') ? ' active' : '' }}">
                <i class="bx bx-heart"></i>
                <span>{{__('messages.wishlist')}}</span>
            </a>
            <div class="nav-item">
                <livewire:cart.cart-counter/>
                <span>{{__('messages.Cart')}}</span>
            </div>
            <div class="search-btn-box nav-item{{ request()->is('contact') ? ' active' : '' }}" data-url="#">
                <i class="search-btn bx bx-search-alt"></i>
                <span>{{__('messages.Search')}}</span>
            </div>
        </nav>
    </div>
</div>




<div class="go-top"><i class='bx bx-up-arrow-alt'></i></div>

<!-- Links of JS files -->
{{--<script src="{{ asset('assets/js/jquery.min.js') }}"></script>--}}
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" defer></script>
{{--<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>--}}
{{--<script src="{{ asset('assets/js/magnific-popup.min.js') }}" defer></script>--}}
{{--<script src="{{ asset('assets/js/parallax.min.js') }}" defer></script>--}}
{{--<script src="{{ asset('assets/js/rangeSlider.min.js') }}" defer></script>--}}
{{--<script src="{{ asset('assets/js/nice-select.min.js') }}" defer></script>--}}
{{--<script src="{{ asset('assets/js/meanmenu.min.js') }}" defer></script>--}}
{{--<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}" defer></script>--}}
{{--<script src="{{ asset('assets/js/slick.min.js') }}" defer></script>--}}
<script src="{{ asset('assets/js/sticky-sidebar.min.js') }}" defer></script>
{{--<script src="{{ asset('assets/js/wow.min.js') }}" defer></script>--}}
{{--<script src="{{ asset('assets/js/form-validator.min.js') }}" defer></script>--}}
{{--<script src="{{ asset('assets/js/contact-form-script.js') }}" defer></script>--}}
{{--<script src="{{ asset('assets/js/ajaxchimp.min.js') }}" defer></script>--}}
<script src="{{ asset('assets/js/main.js') }}" defer></script>
@yield('scripts')


@livewireScripts
</body>
</html>

