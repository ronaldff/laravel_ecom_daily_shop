<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Daily Shop | @yield('title')</title>
    <link href="{{ asset('front_assets/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('front_assets/css/bootstrap.css') }}" rel="stylesheet">   
    <link href="{{ asset('front_assets/css/jquery.smartmenus.bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/jquery.simpleLens.css') }}">    
    <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/nouislider.css') }}">
    <link id="switcher" href="{{ asset('front_assets/css/theme-color/default-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('front_assets/css/sequence-theme.modern-slide-in.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('front_assets/css/style.css') }}" rel="stylesheet">    
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <input type="hidden" id="routes" value="{{ asset('/') }}">
  </head>
  <body class="productPage"> 
    <div id="wpf-loader-two">          
      <div class="wpf-loader-two-inner">
        <span>Loading</span>
      </div>
    </div>
    <div class="alert-box hide hidden" id="message_data"></div> 
    
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <header id="aa-header">
    <div class="aa-header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-top-area">
              <div class="aa-header-top-right">
                <ul class="aa-head-top-nav-right">
                  @if (session()->has('FRONT_USER_VAL'))
                    <li><a href="{{ route("order") }}">My Order</a></li>
                    <li class="hidden-xs"><a href="javascript:void(0)">Wishlist</a></li>
                  @endif
                  
                  
                  <li class="hidden-xs"><a href="{{ route('cart') }}">My Cart</a></li>

                  @if (session()->has('FRONT_USER_VAL'))
                    <li><a href="{{ route('front_logout') }}" >logout</a></li>
                  @else
                    <li><a href="" data-toggle="modal" data-target="#login-modal">Login</a></li> 
                  @endif
                 
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="aa-header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-bottom-area">
              <div class="aa-logo">
                <a href="{{ route('home') }}">
                  <span class="fa fa-shopping-cart"></span>
                  <p>daily<strong>Shop</strong> <span>Your Shopping Partner</span></p>
                </a>
              </div>
              <div class="aa-cartbox" id="box_cart_dynamic">
                <a class="aa-cart-link" href="{{ route('cart') }}">
                  <span class="fa fa-shopping-basket"></span>
                  <span class="aa-cart-title">SHOPPING CART</span>
                  <span class="aa-cart-notify">{{ count(getAddtoCartTotalItems()) }}</span>
                </a>
                  @if (count(getAddtoCartTotalItems()) > 0)
                  <div class="aa-cartbox-summary">
                    <ul>
                      <?php $total = 0; ?>
                      @foreach(getAddtoCartTotalItems() as $key => $list)
                        <li>
                          <a class="aa-cartbox-img" href="{{ url('product') }}/{{ $list->slug  }}"><img src="{{ asset('pro_img') }}/{{ $list->image }}" alt="{{ $list->image }}"></a>
                          <div class="aa-cartbox-info">
                            <h4><a href="{{ url('product') }}/{{ $list->slug  }}">{{ $list->product_name}}</a></h4>
                            <p>{{ $list->qty}} x ₹{{ $list->price}}</p>
                          </div>
                        
                         @if ($_SERVER['REQUEST_URI'] != '/checkout')
                          <a class="aa-remove-product" onclick="deleteCartProduct('{{ $list->cart_id }}','{{$list->product_id  }}','{{ $list->size }}','{{ $list->color }}')" href="javascript:void(0)"><span class="fa fa-times"></span></a>
                             
                         @endif
                          
                        </li>
                        <?php
                          $total += $list->qty * $list->price;
                        ?>
                      @endforeach
                                          
                      <li>
                        <span class="aa-cartbox-total-title">
                          Total
                        </span>
                        <span class="aa-cartbox-total-price">
                          ₹{{ $total }}
                        </span>
                      </li>
                    </ul> 
                    <a class="aa-cartbox-checkout aa-primary-btn" href="{{ route('cart') }}">Cart</a>
                  
                  </div>
                @else
                      
                @endif
              </div>
             
              <div class="aa-search-box">
                {{-- <form> --}}
                  <input type="text" name="search" id="search" placeholder="Search here ex. 'man' ">
                  <button type="button" onclick="searchProduct()"><span class="fa fa-search"></span></button>
                {{-- </form> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <section id="menu">
    <div class="container">
      <div class="menu-area">
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>          
          </div>
          <div class="navbar-collapse collapse">
            {!! getTopNavCat() !!}
          </div>
        </div>
      </div>       
    </div>
  </section>
 
  @section('content')
  @show

  <footer id="aa-footer">
    <div class="aa-footer-top">
     <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-top-area">
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <h3>Main Menu</h3>
                  <ul class="aa-footer-nav">
                    <li><a href="{{ route('home') }}">Home</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Knowledge Base</h3>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Useful Links</h3>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Contact Us</h3>
                    <div class="aa-footer-social">
                      <a href="#"><span class="fa fa-facebook"></span></a>
                      <a href="#"><span class="fa fa-twitter"></span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
    </div>
    <div class="aa-footer-bottom">
      <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-bottom-area">
            <p>Developed by <a href="{{ route('home') }}">Piyush Shyam</a></p>
          </div>
        </div>
      </div>
      </div>
    </div>
  </footer>
  
  @if ((Cookie::get('xx1_df_java_xsrf') != '') && (Cookie::get('xx2_df_java_xsrf') != ''))
    @php
      
      $email = Cookie::get('xx1_df_java_xsrf');
      $password = Cookie::get('xx2_df_java_xsrf');
      $remember = "checked";

    @endphp
    
  @else
    @php
      
      $email = "";
      $password = "";
      $remember = "";

    @endphp

  @endif


  



  <!-- Login Modal -->  
  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <div id="login_form">
            <h4>Login or Register</h4>
            <form class="aa-login-form" id="loginForm">
              <label for="email">EmailId<span>*</span></label>
              <input type="email" value="{{ $email }}" name="str_login_email" placeholder="Enter Email" required>

              @csrf
              <label for="password">Password<span>*</span></label>
              <input type="password" value="{{ $password }}" name="str_login_password" placeholder="Enter Password" required>

              <button class="aa-browse-btn" type="submit" id="btnLogin">Login</button>


              <label for="rememberme" class="rememberme">
              <input type="checkbox" {{ $remember }} id="rememberme" name="rememberme"> Remember me </label>

              <p id="log_error"></p>

              <p class="aa-lost-password"><a href="javascript:void(0)" onclick="showForgetPasswordForm()">Lost your password?</a></p>
              <div class="aa-register-now">
                Don't have an account?<a href="{{ route('registration') }}">Register now!</a>
              </div>
            </form>
          </div>
          <div id="forget_form" style="display: none">
            <h4>Forget password</h4>
            <form class="aa-login-form" id="forgetForm">
              <label for="forget_email">EmailId<span>*</span></label>
              <input type="email" name="str_forget_email" placeholder="Enter Email" required>
              @csrf
              <button class="aa-browse-btn" type="submit" id="btnForgetPassword" >Submit</button>

              <p id="forget_error"></p>

              <div class="aa-register-now">
                Please Login?<a href="javascript:void(0)" onclick="showLoginForm()">Login now!</a>
              </div>
            </form>
          </div>
          
        </div>                        
      </div>
    </div>
  </div>    

  <script src="{{ asset('front_assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('front_assets/js/bootstrap.js') }}"></script>  
  <script type="text/javascript" src="{{ asset('front_assets/js/jquery.smartmenus.js') }}"></script>
  <script type="text/javascript" src="{{ asset('front_assets/js/jquery.smartmenus.bootstrap.js') }}"></script>  
  <script src="{{ asset('front_assets/js/sequence.js') }}"></script>
  <script src="{{ asset('front_assets/js/sequence-theme.modern-slide-in.js') }}"></script>  
  <script type="text/javascript" src="{{ asset('front_assets/js/jquery.simpleGallery.js') }}"></script>
  <script type="text/javascript" src="{{ asset('front_assets/js/jquery.simpleLens.js') }}"></script>
  <script type="text/javascript" src="{{ asset('front_assets/js/slick.js') }}"></script>
  <script type="text/javascript" src="{{ asset('front_assets/js/nouislider.js') }}"></script>
  <script src="{{ asset('front_assets/js/custom.js') }}"></script> 
  </body>
</html>