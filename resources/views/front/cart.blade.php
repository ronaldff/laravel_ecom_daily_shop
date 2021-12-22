@extends('front.layouts')
@section('title')
cart
@endsection
@section('content')
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
    <img src="{{ asset('front_assets/img/fashion/fashion-header-bg-8.jpg') }}" alt="fashion img">
    <div class="aa-catg-head-banner-area">
      <div class="container">
       <div class="aa-catg-head-banner-content">
         <h2>Cart Page</h2>
         <ol class="breadcrumb">
           <li><a href="{{ route('home') }}">Home</a></li>                   
           <li class="active">Cart</li>
         </ol>
       </div>
      </div>
    </div>
  </section>
  <!-- / catg header banner section -->

  <!-- Cart view section -->
  <section id="cart-view">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="cart-view-area">
            <div class="cart-view-table" id="new_cart_id">
              @if(count($lists) > 0)
                <form action="" id="cart_form">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Remove</th>
                          <th>Image</th>
                          <th>Product</th>
                          <th>Color</th>
                          <th>Size</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($lists as $key => $list)
                          <tr id="cart_{{ $list->cart_id }}">
                            <td><a class="remove" href="javascript:void(0)"><i class="fa fa-trash" onclick="deleteCartProduct('{{ $list->cart_id }}','{{$list->product_id  }}','{{ $list->size }}','{{ $list->color }}')"></i></a></td>
                            <td><a href="{{ url('product') }}/{{ $list->slug  }}"><img src="{{ asset('pro_img') }}/{{ $list->image }}" alt="{{ $list->image }}"></a></td>
                            <td>
                              <a class="aa-cart-title" href="{{ url('product') }}/{{ $list->slug  }}">{{ $list->product_name}}</a>
                            </td>
                            <td>
                              <?php
                               
                                if($list->color == ''){ ?>
                                  <span style="color:{{ $list->color }}">No-color</span>
                                <?php } else { ?>
                                  <span style="width:100px;height:1;color:{{ $list->color }};background-color:{{ $list->color }}">{{ $list->color }}</span>
                                <?php } 
                              ?>
                            </td>
                            <td>
                              <?php
                               
                                if($list->size == ''){ ?>
                                  <span style="color:{{ $list->color }}">No-size</span>
                                <?php } else { ?>
                                <span style="color:{{ $list->color }}">{{ $list->size }}</span>
                                <?php } 
                              ?>
                            </td>
                            <td>₹{{ $list->price }}</td>
                            <td>
                              <input id="qty{{ $list->product_attr_id }}" class="aa-cart-quantity" type="number" value="{{ $list->qty }}" onchange="updateQty('{{$list->product_id  }}','{{ $list->size }}','{{ $list->color }}','{{ $list->product_attr_id }}','{{ $list->price }}')">
                            </td>
                            <td id="total_price_{{ $list->product_attr_id }}">₹{{ $list->price * $list->qty}}</td>
                          </tr>
                        @endforeach
                       
                        <tr>
                          <td colspan="8" class="aa-cart-view-bottom">
                            <a href="{{ route('checkout') }}"><button class="aa-cart-view-btn" type="button">Checkout</button></a>
                          </td>
                        </tr>
                        </tbody>
                    </table>
                  </div>
                </form>
              
                @else
                <h2>Cart Is Empty</h2>
                
              @endif
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Cart view section -->
  <form id="frmAddToCart">
    <input type="hidden" id="size_id" name="size_id"/>
    <input type="hidden" id="color_id" name="color_id"/>
    <input type="hidden" id="product_id" name="product_id"/>
    <input type="hidden" id="qty" name="qty"/>
  
    @csrf
  
  </form>
@endsection