@extends('front.layouts')
@section('title')
category | {{ $banner_txt }}
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
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
              <div class="aa-product-catg-head-left">
                <form class="aa-sort-form" >
                  <label for="">Sort by</label>
                  <select name="" onchange="sortBy(this)"  id="sort_by">
                    <option value="">Default</option>
                    <?php 
                        $array_sort = array('name','price_desc','price_asc','date');
                        foreach ($array_sort as $key => $value) { ?>
                          <option value="<?php print_r($value); ?>"
                            <?php
                              if(isset($_GET['sort_by_value'])){
                                if($value == $_GET['sort_by_value']){
                                  echo "selected";
                                } else {
                                  echo "";
                                }
                              }
                            ?>
                          ><?php print_r(str_replace('_', ' ', strtoupper($value))); ?></option>
                    <?php    }
                    ?>
                    
                    
                  </select>
                </form>
              </div>
              <div class="aa-product-catg-head-right">
                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
              </div>
            </div>
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
                          <p class="aa-product-descrip">{!! $product->desc !!}</p>
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
        <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
          <aside class="aa-sidebar">
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Category</h3>
              <ul class="aa-catg-nav">
                
                @foreach($categories as $key => $category)
                 
                  @if ($slug_val == $category
                  ->category_slug)
                      <li><a class="cat_active" href="{{ route('category_details',['slug'=>$category
                        ->category_slug]) }}">{{ $category->category_name }}</a></li>
                  @else
                    <li><a href="{{ route('category_details',['slug'=>$category
                    ->category_slug]) }}">{{ $category->category_name }}</a></li>
                  @endif
                  
                @endforeach
              </ul>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Price</h3>              
              <!-- price range -->
              <div class="aa-sidebar-price-range">
                <form action="">
                  <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                  </div>
                  <?php  
                    if(isset($_GET['filter_price_start'])){ ?>
                        <input type="hidden" id="range_start" value="<?php echo $_GET['filter_price_start']; ?>" />

                        <input type="hidden" id="range_end" value="<?php echo $_GET['filter_price_end']; ?>" />
                  <?php  }
                  
                  ?>
                  <span id="skip-value-lower" class="example-val"></span>
                 <span id="skip-value-upper" class="example-val"></span>
                 <button class="aa-filter-btn" type="button" onClick="sortPriceFilter()">Filter</button>
                </form>
              </div>              

            </div>

            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Color</h3>
              <div class="aa-color-tag">
                @foreach ($colors as $color)
                  @if (in_array($color->id,$colorArry))
                    <a class="color_active aa-color-{{ $color->color }}" onclick="filterColor('{{ $color->id }}','1')" href="javascript:void(0)"></a>
                  @else
                    <a class="aa-color-{{ $color->color }}" onclick="filterColor('{{ $color->id }}','0')" href="javascript:void(0)"></a> 
                  @endif
                  
                @endforeach
                
              </div>                            
            </div>
          </aside>
        </div>
       
      </div>
    </div>
  </section>
  <!-- / product category -->

  <form id="categoryFilter">
    <input type="hidden" id="sort_by_value" name="sort_by_value"/>
    <input type="hidden" id="filter_price_start" name="filter_price_start"/>
    <input type="hidden" id="filter_price_end" name="filter_price_end"/>
    <input type="hidden" id="filterData" name="filter_color" value="{{ $get_colors }}"/>

    @csrf
  
  </form>

@endsection