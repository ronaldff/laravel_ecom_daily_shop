<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Daily Shop | Home</title>
    
    <!-- Font awesome -->
    <link href="{{ asset('front_assets/css/font-awesome.css') }}" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="{{ asset('front_assets/css/bootstrap.css') }}" rel="stylesheet">   
    <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="{{ asset('front_assets/css/jquery.smartmenus.bootstrap.css') }}" rel="stylesheet">
    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/jquery.simpleLens.css') }}">    
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/slick.css') }}">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/nouislider.css') }}">
    <!-- Theme color -->
    <link id="switcher" href="{{ asset('front_assets/css/theme-color/default-theme.css') }}" rel="stylesheet">
    <!-- <link id="switcher" href="css/theme-color/bridge-theme.css" rel="stylesheet"> -->
    <!-- Top Slider CSS -->
    <link href="{{ asset('front_assets/css/sequence-theme.modern-slide-in.css') }}" rel="stylesheet" media="all">

    <!-- Main style sheet -->
    <link href="{{ asset('front_assets/css/style.css') }}" rel="stylesheet">    
    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
  </head>
<body>
  <section id="aa-error">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-error-area">
            <h2>404</h2>
            <span>Sorry! Page Not Found</span>
            <p>Sorry you went the wrong url please go back to the home page by clicking the below link</p>
            <a href="{{ route('home') }}"> Go to Homepage</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>