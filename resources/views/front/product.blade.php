@extends('front.layouts')
@section('title')
product | {{ $banner_txt }}
@endsection
@section('content')
 <section id="aa-catg-head-banner">
  <img src="{{ asset('pro_img') }}/{{ $product[0]->image }}" alt="fashion img">
  <div class="aa-catg-head-banner-area">
    <div class="container">
     <div class="aa-catg-head-banner-content">
       <h2>{{ ucwords($banner_txt) }}</h2>
       <ol class="breadcrumb">
         <li><a href="{{ route('home') }}">Home</a></li>         
         <li><a href="{{ route('product_details', $banner_txt) }}">Product</a></li>
         <li class="active">{{ $banner_txt }}</li>
       </ol>
     </div>
    </div>
  </div>
 </section>
 <section id="aa-product-details">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="aa-product-details-area">
          <div class="aa-product-details-content">
            <div class="row">
              <div class="col-md-5 col-sm-5 col-xs-12">                              
                <div class="aa-product-view-slider">                                
                  <div id="demo-1" class="simpleLens-gallery-container">
                    <div class="simpleLens-container">
                      <div class="simpleLens-big-image-container"><a data-lens-image="{{ asset('pro_img') }}/{{ $product[0]->image }}" class="simpleLens-lens-image"><img src="{{ asset('pro_img') }}/{{ $product[0]->image }}" class="simpleLens-big-image"></a></div>
                    </div>
                    <div class="simpleLens-thumbnails-container">
                      <a data-big-image="{{ asset('pro_img') }}/{{ $product[0]->image }}" data-lens-image="{{ asset('pro_img') }}/{{ $product[0]->image }}" class="simpleLens-thumbnail-wrapper" href="javascript:void(0)">
                        <img width="40px" src="{{ asset('pro_img') }}/{{ $product[0]->image }}" style="border: 1px solid;">
                      </a> 
                      @if(isset($product_images[$product[0]->id][0]))
                        @foreach($product_images[$product[0]->id] as $key => $product_multi_img)
                          <a data-big-image="{{ asset('pro_multi_img') }}/{{ $product_multi_img->multi_image }}" data-lens-image="{{ asset('pro_multi_img') }}/{{ $product_multi_img->multi_image }}" class="simpleLens-thumbnail-wrapper" href="javascript:void(0)">
                            <img width="40px" src="{{ asset('pro_multi_img') }}/{{ $product_multi_img->multi_image }}" style="border: 1px solid;">
                          </a>  
                        @endforeach
                        @endif
                    </div>
                  </div>
                </div>
              </div>
          
              <div class="col-md-7 col-sm-7 col-xs-12">
                <div class="aa-product-view-content">
                  <h3>{{ ucfirst($product[0]->product_name) }}</h3>
                  <div class="aa-price-block">
                    <span class="aa-product-view-price">Rs{{ $product_attr[$product[0]->id][0]->price }}</span>
                    <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                  </div>
                  @if($product[0]->lead_time != "")
                    <div class="aa-price-block">
                      <p class="aa-product-avilability" style="  color: red;
                      word-spacing: 2px;font-weight:bolder;
                      text-transform: capitalize;">Delivery in <span>
                         {{ $product[0]->lead_time }}</span></p>
                    </div>
                  @endif
                  <p>{!! $product[0]->short_desc !!}</p>
                  @php 
                  foreach ($product_attr[$product[0]->id] as $key => $value) {
                    if($value->size_id > 0){
                      if($key == 0){
                        echo "<h4>Size</h4>";
                      }
                    }
                    
                  }
                  @endphp
                      @php
                        $arrSize = [];
                        foreach($product_attr[$product[0]->id] as $key => $attr){
                          $arrSize[] = $attr->size;
                        }
                        $arrSize = array_unique($arrSize);
                      @endphp
                      <div class="aa-prod-view-size">
                        @foreach($arrSize as $key => $attr_size)
                          @if($attr_size != '')
                            <a href="javascript:void(0)" class="size_link" id="size_{{ $attr_size }}" onclick="showColor('{{ $attr_size }}')">{{ $attr_size }}</a>
                          @endif
                        @endforeach
                      </div>

                      @php 
                  foreach ($product_attr[$product[0]->id] as $key => $value) {
                    if($value->color_id > 0){
                      if($key == 0){
                        echo "<h4>Color</h4>";
                      }
                    }
                    
                  }
                  @endphp
                    <div class="aa-color-tag">
                      @foreach($product_attr[$product[0]->id] as $key => $attr)
                        @if($attr->color != '')
                          <a href="javascript:void(0)"  onclick="change_product_color_image('{{ asset('pro_attr_img') }}/{{ $attr->attr_image }}','{{ $attr->color }}')" 
                          class="aa-color-{{ $attr->color }} product_color size_{{ $attr->size }} color_link" id="color_{{ $attr->color }}"></a>
                        @endif
                      @endforeach
                    </div>
                  <div class="aa-prod-quantity">
                    <h4>Quantity</h4>
                    {{-- <form action=""> --}}
                      <select id="quantity">
                        @for ($i = 1; $i <= 11; $i++)
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                       
                      </select>
                    {{-- </form> --}}
                    <p class="aa-prod-category">
                      Category: <a href="{{ route('category_details', $product[0]->category_slug) }}">{{ $product[0]->category_name }}</a>
                    </p>
                  </div>
                  <div class="aa-prod-view-bottom">
                    <a class="aa-add-to-cart-btn" href="javascript:void(0)" onclick="add_to_cart('{{ $product[0]->id }}','{{ $product_attr[$product[0]->id][0]->size_id }}','{{ $product_attr[$product[0]->id][0]->color_id }}')">Add To Cart</a>
                    <div id="add_to_cart_msg" ></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="aa-product-details-bottom">
            <ul class="nav nav-tabs" id="myTab2">
              <li><a href="#description" data-toggle="tab">Description</a></li>
              @if($product[0]->technical_specification != "")
                <li><a href="#technical_specification" data-toggle="tab">Technical Specification</a></li>
              @endif

              @if($product[0]->uses != "")
                <li><a href="#uses" data-toggle="tab">Uses</a></li>
              @endif

              @if($product[0]->warranty != "")
                <li><a href="#warranty" data-toggle="tab">Warranty</a></li>
              @endif
              
              <li><a href="#review" data-toggle="tab">Reviews</a></li>                
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade in active" id="description">
                <p>{!! $product[0]->desc !!}</p>
              </div>
              @if($product[0]->technical_specification != "")
                <div class="tab-pane fade" id="technical_specification">
                  <p>{!! $product[0]->technical_specification !!}</p>
                </div>
              @endif

              @if($product[0]->uses != "")
                <div class="tab-pane fade" id="uses">
                  <p>{!! $product[0]->uses !!}</p>
                </div>
              @endif

              @if($product[0]->warranty != "")
                <div class="tab-pane fade" id="warranty">
                  <p>{!! $product[0]->warranty !!}</p>
                </div>
              @endif

              <div class="tab-pane fade " id="review">
               <div class="aa-product-review-area">
                 <h4>2 Reviews for T-Shirt</h4> 
               
                 <h4>Add a review</h4>
                 <div class="aa-your-rating">
                   <p>Your Rating</p>
                   <a href="#"><span class="fa fa-star-o"></span></a>
                   <a href="#"><span class="fa fa-star-o"></span></a>
                   <a href="#"><span class="fa fa-star-o"></span></a>
                   <a href="#"><span class="fa fa-star-o"></span></a>
                   <a href="#"><span class="fa fa-star-o"></span></a>
                 </div>
                 <!-- review form -->
                 <form action="" class="aa-review-form">
                    <div class="form-group">
                      <label for="message">Your Review</label>
                      <textarea class="form-control" rows="3" id="message"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" placeholder="Name">
                    </div>  
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" placeholder="example@gmail.com">
                    </div>

                    <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                 </form>
               </div>
              </div>            
            </div>
          </div>
          <div class="aa-product-related-item">
            <h3>Related Products</h3>
            <ul class="aa-product-catg aa-related-item-slider">
              @if (isset($related_product[0]))
              @foreach ($related_product as $relatedproductArr)
                <li>
                  <figure>
                    <a class="aa-product-img" href="{{ url('product') }}/{{$relatedproductArr->slug  }}"><img src="{{ asset('pro_img') }}/{{ $relatedproductArr->image }}" alt="{{$relatedproductArr->slug  }}" class="img-fluid"></a>
                      <figcaption>
                      <h4 class="aa-product-title"><a href="#">{{ $relatedproductArr->product_name }}</a></h4>
                      <span class="aa-product-price">Rs {{ $product_related_attr[$relatedproductArr->id][0]->price }}</span><span class="aa-product-price"><del>Rs {{ $product_related_attr[$relatedproductArr->id][0]->mrp }}</del></span>
                    </figcaption>
                  </figure>                        
                  <div class="aa-product-hvr-content">
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                  </div>
                  <span class="aa-badge aa-sale" href="#">SALE!</span>
                </li>
              @endforeach   
              @endif                
            </ul>
          </div>  
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