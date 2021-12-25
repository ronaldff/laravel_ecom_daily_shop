<?php
    if(isset($_SERVER['REQUEST_URI'])){
        $url = explode("/",$_SERVER['REQUEST_URI']);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title Page-->
    <title>{{ ucfirst($title) }}</title>
    <script src='{{ asset('admin_assets/js/a076d05399.js') }}' crossorigin='anonymous'></script>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin_assets/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
    <!-- Vendor CSS-->
    <link href="{{ asset('admin_assets/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="{{ asset('admin_assets/css/theme.css') }}" rel="stylesheet" media="all">
    <script src="{{ asset('admin_assets/vendor/jquery-3.2.1.min.js') }}"></script>
   

</head>

<body>
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="text-center" href="{{ route('admin_dashboard') }}">
                            <h4>ADMIN</h4>
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class=<?php echo ($url['2'] ==='dashboard') ? 'active' : ''?>>
                            <a href="{{ route('admin_dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class=<?php echo ($url['2'] ==='category') ? 'active' : ''?>>
                            <a  href="{{ route("admin_category") }}">
                                <i class="fa fa-list-alt"></i>Category
                            </a>
                        </li>
                        <li class=<?php echo ($url['2'] ==='brand') ? 'active' : ''?>>
                            <a  href="{{ route("admin_brand") }}">
                                <i class="fab fa-bootstrap"></i>Brand
                            </a>
                        </li>
                        <li class=<?php echo ($url['2'] ==='order') ? 'active' : ''?>>
                            <a  href="{{ route("admin_order") }}">
                                <i class="fab fa-bootstrap"></i>Sales
                            </a>
                        </li>
                        <li class=<?php echo ($url['2'] ==='coupon') ? 'active' : ''?>>
                            <a  href="{{ route("admin_coupon") }}">
                                <i class="fa fa-gift"></i>Coupon
                            </a>
                        </li>
                        <li class=<?php echo ($url['2'] ==='size') ? 'active' : ''?>>
                            <a  href="{{ route("admin_size") }}">
                                <i class="fas fa-tshirt"></i>Size
                            </a>
                        </li>
                        <li class=<?php echo ($url['2'] ==='tax') ? 'active' : ''?>>
                            <a  href="{{ route("admin_tax") }}">
                                <i class="fas fa-percent"></i>Tax
                            </a>
                        </li>
                        <li class=<?php echo ($url['2'] ==='color') ? 'active' : ''?>>
                            <a  href="{{ route("admin_color") }}">
                                <i class="fas fa-tint"></i>Color
                            </a>
                        </li>
                        <li class=<?php echo ($url['2'] ==='product') ? 'active' : ''?>>
                            <a  href="{{ route("admin_product") }}">
                                <i class="fa fa-product-hunt"></i>Product
                            </a>
                        </li>
                        <li class=<?php echo ($url['2'] ==='customer') ? 'active' : ''?>>
                            <a  href="{{ route("admin_customer") }}">
                                <i class="fas fa-user"></i>Customers
                            </a>
                        </li>
                        <li class=<?php echo ($url['2'] ==='banner') ? 'active' : ''?>>
                            <a  href="{{ route("admin_banner") }}">
                                <i class="fa fa-picture-o" aria-hidden="true"></i>Banner
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a class="text-center" href="{{ route('admin_dashboard') }}">
                    <h4>ADMIN</h4>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class=<?php echo ($url['2'] ==='dashboard') ? 'active' : ''?>>
                            <a href="{{ route('admin_dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class=<?php echo ($url['2'] ==='category') ? 'active' : ''?>>
                            <a href="{{ route("admin_category") }}">
                                <i class="fa fa-list-alt"></i>Category
                            </a>
                        </li>
                        <li class=<?php echo ($url['2'] ==='brand') ? 'active' : ''?>>
                            <a  href="{{ route("admin_brand") }}">
                                <i class="fab fa-bootstrap"></i>Brand
                            </a>
                        </li>
                        <li class=<?php echo ($url['2'] ==='order') ? 'active' : ''?>>
                            <a  href="{{ route("admin_order") }}">
                                <i class="fas fa-truck"></i>Sales
                            </a>
                        </li>
                        <li class=<?php echo ($url['2'] ==='coupon') ? 'active' : ''?>>
                            <a  href="{{ route("admin_coupon") }}">
                                <i class="fa fa-gift"></i>Coupon
                            </a>
                        </li>
                        <li class=<?php echo ($url['2'] ==='size') ? 'active' : ''?>>
                            <a  href="{{ route("admin_size") }}">
                                <i class="fas fa-tshirt"></i>Size
                            </a>
                        </li>
                        <li class=<?php echo ($url['2'] ==='tax') ? 'active' : ''?>>
                            <a  href="{{ route("admin_tax") }}">
                                <i class="fas fa-percent"></i>Tax
                            </a>
                        </li>
                        <li class=<?php echo ($url['2'] ==='color') ? 'active' : ''?>>
                            <a  href="{{ route("admin_color") }}">
                                <i class="fas fa-tint"></i>Color
                            </a>
                        </li>
                        <li class=<?php echo ($url['2'] ==='product') ? 'active' : ''?>>
                            <a  href="{{ route("admin_product") }}">
                                <i class="fa fa-product-hunt"></i>Product
                            </a>
                        </li>
                        <li class=<?php echo ($url['2'] ==='customer') ? 'active' : ''?>>
                            <a  href="{{ route("admin_customer") }}">
                                <i class="fas fa-user"></i>Customers
                            </a>
                        </li>
                        <li class=<?php echo ($url['2'] ==='banner') ? 'active' : ''?>>
                            <a  href="{{ route("admin_banner") }}">
                                <i class="fa fa-picture-o" aria-hidden="true"></i>Banner
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" style
                            ="visibility:hidden">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{ Config::get('constants.SITE_ADMIN_NAME') }}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="{{ route('admin_logout') }}">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            @section('content')
            @show
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
    
    <!-- Jquery JS-->
  
    <script src="{{ asset('admin_assets/js/jquery.dataTables.min.js') }}"></script>

    <!-- Bootstrap JS-->
    <script src="{{ asset('admin_assets/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>

    
    <!-- Vendor JS       -->
    <script src="{{ asset('admin_assets/vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ asset('admin_assets/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ asset('admin_assets/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{ asset('admin_assets/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/select2/select2.min.js') }}">
    </script>
    <!-- Main JS-->
    <script src="{{ asset('admin_assets/js/main.js')}}"></script>
    <script>
        $(document).ready(function (e) {
            let pro_old_img = $('#pro_old_img').val(); 
            if(pro_old_img != ''){
                $('#preview-image-before-upload').attr('src', pro_old_img); 
            }
            $('#pro_image').change(function(){
                $('#preview-image-before-upload').css("display","block");
                    
                let reader = new FileReader();
               
            
                reader.onload = (e) => { 
                    $('#preview-image-before-upload').attr('src', e.target.result); 
                }
            
                reader.readAsDataURL(this.files[0]); 
                
            });
            
        });
     </script>
      
      {{-- <td> {!! html_entity_decode($post->description) !!} </td> --}}
    

</body>

</html>
<!-- end document-->