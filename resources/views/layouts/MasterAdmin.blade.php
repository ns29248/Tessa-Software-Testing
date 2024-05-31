

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Black Dashboard by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="{{asset('../assets/adminassets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{asset('../assets/adminassets/css/black-dashboard.css?v=1.0.0')}}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset('../assets/adminassets/demo/demo.css')}}" rel="stylesheet" />


</head>

<body class="">
<div class="wrapper">
    <div class="sidebar">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
      -->
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="javascript:void(0)" class="simple-text logo-mini">
                    CT
                </a>
                <a href="javascript:void(0)" class="simple-text logo-normal">
                    Creative Tim
                </a>
            </div>
            <ul class="nav">
                <li class="active ">
                    <a href="./dashboard.html">
                        <i class="tim-icons icon-chart-pie-36"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href={{ route('categories.index') }}>
                        <i class="tim-icons icon-book-bookmark"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li>
                    <a href={{ route('brands.index') }}>
                        <i class="tim-icons icon-book-bookmark"></i>
                        <p>Brands</p>
                    </a>
                </li>
                <li>
                    <a href={{ route('products.index') }}>
                        <i class="tim-icons icon-book-bookmark"></i>
                        <p>Products</p>
                    </a>
                </li>
                <li>
                    <a href={{ route('orders.index') }}>
                        <i class="tim-icons icon-book-bookmark"></i>
                        <p>Orders</p>
                    </a>
                </li>
                <li>
                    <a href={{ route('show_users') }}>
                        <i class="tim-icons icon-book-bookmark"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li>
                    <a href={{ route('request.index') }}>
                        <i class="tim-icons icon-book-bookmark"></i>
                        <p>Requests</p>
                    </a>
                </li>
                <li>
                    <a href={{ route('show_stylists') }}>
                        <i class="tim-icons icon-book-bookmark"></i>
                        <p>Stylists</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('/admin/icons')}}">
                        <i class="tim-icons icon-atom"></i>
                        <p>Icons</p>
                    </a>
                </li>
                <li>
                    <a href={{ route('courses.index') }}>
                        <i class="tim-icons icon-pin"></i>
                        <p>Courses</p>
                    </a>
                </li>
                <li>
                    <a href={{ route('show_users') }}>
                        <i class="tim-icons icon-single-02"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li>
                    <a href={{ route('coupons.index') }}>
                        <i class="tim-icons icon-pin"></i>
                        <p>Coupons</p>
                    </a>
                </li>
                <li>
                    <a href={{ route('admin.bulkSale.create') }}>
                        <i class="tim-icons icon-pin"></i>
                        <p>Sales</p>
                    </a>
                </li>
                <li>
                    <a href="./notifications.html">
                        <i class="tim-icons icon-bell-55"></i>
                        <p>Notifications</p>
                    </a>
                </li>
                <li>
                    <a href="./user.html">
                        <i class="tim-icons icon-single-02"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li>
                    <a href="./tables.html">
                        <i class="tim-icons icon-puzzle-10"></i>
                        <p>Table List</p>
                    </a>
                </li>
                <li>
                    <a href="./typography.html">
                        <i class="tim-icons icon-align-center"></i>
                        <p>Typography</p>
                    </a>
                </li>
                <li>
                    <a href="./rtl.html">
                        <i class="tim-icons icon-world"></i>
                        <p>RTL Support</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle d-inline">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand" href="javascript:void(0)">Dashboard</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ml-auto">
                        <li class="search-bar input-group">
                            <button class="btn btn-link" id="search-button" data-toggle="modal" data-target="#searchModal">
                                <i class="tim-icons icon-zoom-split"></i>
                                <span class="d-lg-none d-md-block">Search</span>
                            </button>
                        </li>

                        <!-- Search Modal -->
                        <div class="modal" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="searchModalLabel">Search</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Search Type Dropdown -->
                                        <div class="form-group">
                                            <label for="searchType">Search Type</label>
                                            <select class="text_color" id="searchType">
                                                <option value="Product">Product</option>
                                                <option value="User">Users</option>
                                                <option value="Course">Courses</option>
                                                <option value="Order">Orders</option>
                                            </select>
                                        </div>
                                        <!-- Search Input -->
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Type your search...">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <li class="dropdown nav-item">
                            <a href="javascript:void(0)" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <div class="notification d-none d-lg-block d-xl-block"></div>
                                <i class="tim-icons icon-sound-wave"></i>
                                <p class="d-lg-none">
                                    Notifications
                                </p>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-navbar">
                                <li class="nav-link"><a href="#" class="nav-item dropdown-item">Mike John responded to your email</a></li>
                                <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">You have 5 more tasks</a></li>
                                <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Your friend Michael is in town</a></li>
                                <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Another notification</a></li>
                                <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Another one</a></li>
                            </ul>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <div class="photo">
                                    <img src="../assets/img/anime3.png" alt="Profile Photo">
                                </div>
                                <b class="caret d-none d-lg-block d-xl-block"></b>
                                <p class="d-lg-none">
                                    Log out
                                </p>
                            </a>
                            <ul class="dropdown-menu dropdown-navbar">
                                <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Profile</a></li>
                                <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Settings</a></li>
                                <li class="dropdown-divider"></li>
                                <li class="nav-link">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="nav-item dropdown-item">
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </li>
                            </ul>

                        </li>
                        <li class="separator d-lg-none"></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Navbar -->
        @yield('content')

        <footer class="footer">

        </footer>
    </div>
</div>
        <!--   Core JS Files   -->
        <script src="../assets/adminassets/js/core/jquery.min.js"></script>
        <script src="../assets/adminassets/js/core/popper.min.js"></script>
        <script src="../assets/adminassets/js/core/bootstrap.min.js"></script>
        <script src="../assets/adminassets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
        <!--  Google Maps Plugin    -->
        <!-- Place this tag in your head or just before your close body tag. -->
        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
        <!-- Chart JS -->
        <script src="../assets/adminassets/js/plugins/chartjs.min.js"></script>
        <!--  Notifications Plugin    -->
        <script src="../assets/adminassets/js/plugins/bootstrap-notify.js"></script>
        <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="../assets/adminassets/js/black-dashboard.min.js?v=1.0.0"></script><!-- Black Dashboard DEMO methods, don't include it in your project! -->
        <script src="../assets/adminassets/demo/demo.js"></script>



    </body>

</html>
