@extends('front.layouts')
@section('title')
checkout
@endsection
@section('content')
 <!-- catg header banner section -->
 <section id="aa-catg-head-banner">
  <img src="{{ asset('front_assets/img/fashion/fashion-header-bg-8.jpg') }}" alt="fashion img">
  <div class="aa-catg-head-banner-area">
   <div class="container">
    <div class="aa-catg-head-banner-content">
      <h2>Checkout Page</h2>
      <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>                   
        <li class="active">Checkout</li>
      </ol>
    </div>
   </div>
 </div>
</section>
<!-- / catg header banner section -->

<!-- Cart view section -->
<section id="checkout">
 <div class="container">
   <div class="row">
     <div class="col-md-12">
      <div class="checkout-area">
        <form id="frmPlaceOrder">
          <div class="row">
            <div class="col-md-8">
              <div class="checkout-left">
                <div class="panel-group" >
                  <!-- Coupon section -->
                  <div class="panel panel-default aa-checkout-billaddress">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a>
                          User Details Address
                        </a>
                      </h4>
                    </div>
                    <div class="panel-collapse">
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="aa-checkout-single-bill">
                              <input name="name" type="text" required placeholder="First Name*" value="{{ $customer['name'] }}">
                            </div>                             
                          </div>
                          <div class="col-md-4">
                            <div class="aa-checkout-single-bill">
                              <input type="email" required placeholder="Email Address*" name="email" value="{{ $customer['email'] }}">
                            </div>                             
                          </div>
                          <div class="col-md-4">
                            <div class="aa-checkout-single-bill">
                              <input type="tel" name="mobile" required placeholder="Phone*" value="{{ $customer['mobile'] }}">
                            </div>
                          </div>
                        </div> 
                        <div class="row">
                          <div class="col-md-4">
                            <div class="aa-checkout-single-bill">
                              <input type="text" name="city" required placeholder="City / Town*" value="{{ $customer['city'] }}">
                            </div>
                          </div>
                        
                          <div class="col-md-4">
                            <div class="aa-checkout-single-bill">
                              <input type="text" required placeholder="State*" name="state" value="{{ $customer['state'] }}">
                            </div>                             
                          </div>
                          <div class="col-md-4">
                            <div class="aa-checkout-single-bill">
                              <input type="text" name="zip" required placeholder="Postcode / ZIP*" value="{{ $customer['zip'] }}">
                            </div>
                          </div>
                        </div> 
                        <div class="row">
                          <div class="col-md-12">
                            <div class="aa-checkout-single-bill">
                              <textarea name="address"  placeholder="Address*" required value="{{ $customer['address'] }}">{{ $customer['address'] }}</textarea>
                            </div>                             
                          </div>                            
                        </div>                                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="checkout-right">
                <h4>Order Summary</h4>
                <div class="aa-order-summary-area">
                  <table class="table table-responsive">
                    <thead>
                      <tr>
                        <th>Product</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $total = 0
                      @endphp
                      @foreach($carts as $key => $cart)
                        @php
                          $total += $cart->price * $cart->qty
                        @endphp
                        <tr>
                          <td>{{ $cart->product_name }} <strong> x  {{ $cart->qty }}</strong>
                            <br>
                            <span class="color_checkout">{{ $cart->color }}</span>
                            <br>
                            <span class="size_checkout">{{ $cart->size }}</span>

                          </td>
                          <td>INR{{ $cart->price * $cart->qty }}</td>
                        </tr>
                      @endforeach
                      
                    </tbody>
                    <tfoot>
                      
                      <tr class="hide show_coupon_box">
                        <th>Coupon Code <a class="remove remove_coupon" title="remove coupon" href="javascript:void(0)" onclick="remove_coupon_code()"><i class="fa fa-trash"></a></th>
                        <td id="coupon_code_str"></td>
                      </tr>
                      <tr class="hide show_coupon_box">
                        <th>Coupon Val</th>
                        <td id="coupon_code_val"></td>
                      </tr>
                      <tr class="hide show_coupon_box">
                        <th>Coupon Type</th>
                        <td id="coupon_code_type"></td>
                      </tr>
                      <tr>
                        <th>Total</th>
                        <td id="total_price">INR{{ $total }}</td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <input type="hidden" id="actual_cart_val" value="{{ $total }}">
                <div class="panel panel-default aa-checkout-coupon">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a>
                        Have a Coupon?
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                      <input type="text" placeholder="Coupon Code" class="aa-coupon-code" name="coupon_code" id="coupon_code">
                      
                      @csrf
                      <input type="button" value="Apply Coupon" class="aa-browse-btns" onclick="getCouponCode()">

                      <div id="coupon_error_msg"></div>
                      <div id="coupon_success_msg"></div>
                    </div>
                  </div>
                </div>
                <h4>Payment Method</h4>
                <div class="aa-payment-method">                    
                  <label for="cashdelivery"><input type="radio" id="cashdelivery" name="payment_type" value="COD" checked> Cash on Delivery </label>
                  <label for="instamojo"><input type="radio" id="instamojo" name="payment_type" value="Gateway"> Via Instamojo </label>
                    
                  <input type="submit" value="Place Order" class="aa-browse-btn" id="btnPlaceOrder">                
                </div>
                <div id="placed_msg" style="margin-top:10px;color:rgb(212, 37, 37);"></div>
              </div>
            </div>
          </div>
        </form>
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