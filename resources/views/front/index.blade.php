@extends('front.layouts')
@section('title')
Home
@endsection
@section('content')
  <section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas">
            @if(isset($home_banner[0]))
              @foreach ($home_banner as $banner)
                <li>
                  <div class="seq-model">
                    <img data-seq src="{{ asset('banner_img') }}/{{ $banner->banner_image }}" />
                  </div>
                  <div class="seq-title" style="">
                    <h2 data-seq="" style="">{{ $banner->banner_name }}</h2>                
                  </div>
                </li>
              @endforeach
            @else
                @for ($i = 0; $i < 4; $i++)
                  <li>
                    <div class="seq-model">
                      <img data-seq src="{{ asset('banner_img/1.jpg') }}" />
                    </div>
                    <div class="seq-title" style="">
                      <span data-seq="" style="">Save Up to 75% Off</span>                
                      <h2 data-seq="" style="">{{ ucwords('Jeans collection') }}</h2>                
                      <p data-seq="" style="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, illum.</p>
                      <a data-seq="" href="javascript:void(0)" class="aa-shop-now-btn aa-secondary-btn" style="">SHOP NOW</a>
                    </div>
                  </li>
                @endfor
            @endif
          </ul>
        </div>
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
      </div>
    </div>
  </section>
  <section id="aa-promo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-promo-area">
            <div class="row">
              <div class="col-md-5 no-padding">  
                @foreach($home_categories as $key => $home_category)
                @if($key == 0)
                    <div class="aa-promo-left">
                      <a href="{{ url('category') }}/{{ $home_category->category_slug  }}">
                        <div class="aa-promo-banner">                    
                          <img src="{{ asset('category_image') }}/{{$home_category->category_image  }}" alt="{{$home_category->category_name}}">                    
                          <div class="aa-prom-content">
                            <h4>{{$home_category->category_name}}</h4>                      
                          </div>
                        </div>
                      </a>
                    </div>
                @else
                @endif
              @endforeach              
              </div>
              <div class="col-md-7 no-padding">
                <div class="aa-promo-right">
                  @foreach($home_categories as $key => $home_category)
                  @if($key >= 1 && $key < 5)
                  <div class="aa-single-promo-right">
                    <a href="{{ url('category') }}/{{ $home_category->category_slug  }}">
                      <div class="aa-promo-banner">                    
                          <img src="{{ asset('category_image') }}/{{$home_category->category_image  }}" alt="{{$home_category->category_name}}">                    
                          <div class="aa-prom-content">
                            <h4>{{$home_category->category_name}}</h4>                      
                          </div>
                      </div>
                    </a>

                  </div>
                  @else
                  @endif
                  @endforeach 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="aa-product">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-product-area">
              <div class="aa-product-inner">
                  <ul class="nav nav-tabs aa-products-tab">
                    @php
                      $loop_count_x = 1;
                    @endphp
                    @foreach($home_categories as $key => $home_category)
                      @php
                        $cat_class_x="";
                        if($loop_count_x == 1){
                          $cat_class_x = "active";
                          $loop_count_x++;
                        }
                      @endphp
                      @if($key <= 4)
                        <li class="{{ $cat_class_x }}">
                          <a href="#cat{{$home_category->id  }}" data-toggle="tab">{{ $home_category->category_name }}</a></li>
                      @else
                      @endif
                    @endforeach 
                  </ul>
                  <div class="tab-content">
                    @php
                      $loop_count = 1;
                    @endphp
                    @foreach($home_categories as $key => $home_category)
                    @php
                      $cat_class="";
                      if($loop_count == 1){
                        $cat_class = "in active";
                        $loop_count++;
                      }
                    @endphp
                      <div class="tab-pane fade {{ $cat_class }}" id="cat{{$home_category->id  }}">
                      <ul class="aa-product-catg">
                        @if (isset($home_categories_product[$home_category->id][0]))
                          @foreach ($home_categories_product[$home_category->id] as $productArr)
                          <li>
                            <figure>
                              <a class="aa-product-img" href="{{ url('product') }}/{{$productArr->slug  }}"><img src="{{ asset('pro_img') }}/{{ $productArr->image }}" alt="{{$productArr->slug  }}" class="img-fluid"></a>
                                <figcaption>
                                <h4 class="aa-product-title"><a href="#">{{ $productArr->product_name }}</a></h4>
                                <span class="aa-product-price">Rs {{ $home_product_attr[$productArr->id][0]->price }}</span><span class="aa-product-price"><del>Rs {{ $home_product_attr[$productArr->id][0]->mrp }}</del></span>
                              </figcaption>
                            </figure>                        
                            <div class="aa-product-hvr-content">
                              <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                            </div>
                            <span class="aa-badge aa-sale" href="#">SALE!</span>
                          </li>
                          @endforeach
                        @else 
                        <div class="container">
                          <div class="row">
                            <div class="col-md-12 text-center">
                              <span style="border: 1px solid lightgray;
                              padding: 8px;
                              color: black;
                              text-transform: uppercase;
                              background-color: darkgray;
                              color: azure;"href="javascript:void(0)">No Data Found</span>
                            </div>
                          </div>
                        </div>
                        @endif
                      </ul>
                    </div>
                    @endforeach 
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="aa-popular-category">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-popular-category-area">
             <ul class="nav nav-tabs aa-products-tab">
                <li class="active"><a href="#featured" data-toggle="tab">Featured</a></li>
                <li><a href="#tranding" data-toggle="tab">Tranding</a></li>
                <li><a href="#discounted" data-toggle="tab">Discounted</a></li>                    
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade in active" id="featured">
                  <ul class="aa-product-catg aa-popular-slider">
                    @if (isset($home_featured_product[0]))
                      @foreach ($home_featured_product as $featuredproductArr)
                        <li>
                          <figure>
                            <a class="aa-product-img" href="{{ url('product') }}/{{$featuredproductArr->slug  }}"><img src="{{ asset('pro_img') }}/{{ $featuredproductArr->image }}" alt="{{$featuredproductArr->slug  }}" class="img-fluid"></a>
                              <figcaption>
                              <h4 class="aa-product-title"><a href="#">{{ $featuredproductArr->product_name }}</a></h4>
                              <span class="aa-product-price">Rs {{ $home_featured_product_attr[$featuredproductArr->id][0]->price }}</span><span class="aa-product-price"><del>Rs {{ $home_featured_product_attr[$featuredproductArr->id][0]->mrp }}</del></span>
                            </figcaption>
                          </figure>                        
                          <div class="aa-product-hvr-content">
                            <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                          </div>
                          <span class="aa-badge aa-sale" href="#">SALE!</span>
                        </li>
                      @endforeach
                    @else 
                      <div class="container">
                        <div class="row">
                          <div class="col-md-12 text-center">
                            <span style="border: 1px solid lightgray;
                            padding: 8px;
                            color: black;
                            text-transform: uppercase;
                            background-color: darkgray;
                            color: azure;"href="javascript:void(0)">No Data Found</span>

                          </div>
                        </div>
                      </div>
                    @endif
                  </ul>
                </div>
                <div class="tab-pane fade" id="tranding">
                  <ul class="aa-product-catg aa-featured-slider">
                    @if (isset($home_tranding_product[0]))
                    @foreach ($home_tranding_product as $trandingproductArr)
                      <li>
                        <figure>
                          <a class="aa-product-img" href="{{ url('product') }}/{{$trandingproductArr->slug  }}"><img src="{{ asset('pro_img') }}/{{ $trandingproductArr->image }}" alt="{{$trandingproductArr->slug  }}" class="img-fluid"></a>
                            <figcaption>
                            <h4 class="aa-product-title"><a href="#">{{ $trandingproductArr->product_name }}</a></h4>
                            <span class="aa-product-price">Rs {{ $home_tranding_product_attr[$trandingproductArr->id][0]->price }}</span><span class="aa-product-price"><del>Rs {{ $home_tranding_product_attr[$trandingproductArr->id][0]->mrp }}</del></span>
                          </figcaption>
                        </figure>                        
                        <div class="aa-product-hvr-content">
                          <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                        </div>
                        <span class="aa-badge aa-sale" href="#">SALE!</span>
                      </li>
                    @endforeach
                  @else 
                    <div class="container">
                      <div class="row">
                        <div class="col-md-12 text-center">
                          <span style="border: 1px solid lightgray;
                          padding: 8px;
                          color: black;
                          text-transform: uppercase;
                          background-color: darkgray;
                          color: azure;"href="javascript:void(0)">No Data Found</span>
                        </div>
                      </div>
                    </div>
                  @endif
                  </ul>
                </div>
                <div class="tab-pane fade" id="discounted">
                  <ul class="aa-product-catg aa-latest-slider">
                    @if (isset($home_discounted_product[0]))
                    @foreach ($home_discounted_product as $discountedproductArr)
                      <li>
                        <figure>
                          <a class="aa-product-img" href="{{ url('product') }}/{{$discountedproductArr->slug  }}"><img src="{{ asset('pro_img') }}/{{ $discountedproductArr->image }}" alt="{{$discountedproductArr->slug  }}" class="img-fluid"></a>
                            <figcaption>
                            <h4 class="aa-product-title"><a href="#">{{ $discountedproductArr->product_name }}</a></h4>
                            <span class="aa-product-price">Rs {{ $home_discounted_product_attr[$discountedproductArr->id][0]->price }}</span><span class="aa-product-price"><del>Rs {{ $home_discounted_product_attr[$discountedproductArr->id][0]->mrp }}</del></span>
                          </figcaption>
                        </figure>                        
                        <div class="aa-product-hvr-content">
                          <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                        </div>
                        <span class="aa-badge aa-sale" href="#">SALE!</span>
                      </li>
                    @endforeach
                  @else 
                    <div class="container">
                      <div class="row">
                        <div class="col-md-12 text-center">
                          <span style="border: 1px solid lightgray;
                          padding: 8px;
                          color: black;
                          text-transform: uppercase;
                          background-color: darkgray;
                          color: azure;"href="javascript:void(0)">No Data Found</span>

                        </div>
                      </div>
                    </div>
                  @endif
                  </ul>
                </div>
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </section>
  <section id="aa-client-brand">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-client-brand-area">
            <ul class="aa-client-brand-slider">
              @foreach ($home_brands as $brand)
                <li><a href="javascript:void(0)"><img src="{{ asset('pro_brand_img') }}/{{ $brand->image }}" alt="{{ $brand->brand }}"></a></li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <form id="frmAddToCart">
    <input type="hidden" id="size_id" name="size_id"/>
    <input type="hidden" id="color_id" name="color_id"/>
    <input type="hidden" id="product_id" name="product_id"/>
    <input type="hidden" id="qty" name="qty"/>
  
    @csrf
  
  </form>
@endsection