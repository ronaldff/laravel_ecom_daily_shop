@extends('front.layouts')
@section('title')
search | {{ $banner_txt }}
@endsection
@section('content')
 <!-- catg header banner section -->
 <section id="aa-catg-head-banner">
  <img src="{{ asset('front_assets/img/fashion/fashion-header-bg-8.jpg') }}" alt="fashion img">
  
  <div class="aa-catg-head-banner-area">
    <div class="container">
     <div class="aa-catg-head-banner-content">
       <h2>Fashion</h2>
       <ol class="breadcrumb">
         <li><a href="{{ route('home') }}">Home</a></li>         
         <li class="active">{{ ucfirst($banner_txt) }}</li>
       </ol>
     </div>
    </div>
  </div>
 </section>
 <!-- / catg header banner section -->

   <!-- product category -->
   <section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-body">
              <ul class="aa-product-catg">
                <!-- start single product item -->
                
                @if (isset($products[0]))
                  @foreach($products as $key => $product)
                    <li>
                      <figure>
                        <a class="aa-product-img" href="{{ url('product') }}/{{$product->slug  }}"><img src="{{ asset('pro_img') }}/{{ $product->image }}" alt="polo shirt img"></a>
                        <figcaption>
                          <h4 class="aa-product-title"><a href="javascript:void(0)">{{ $product->product_name }}</a></h4>
                          <span class="aa-product-price">Rs {{ $product->price }}</span><span class="aa-product-price"><del>Rs {{ $product->mrp }}</del></span>
                        </figcaption>
                      </figure>                         
                      <div class="aa-product-hvr-content">
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                      </div>
                    </li> 
                  @endforeach
               
                @else
                    <h3 style="color:red; text-align:center;">No Data Found</h3>
                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / product category -->
@endsection