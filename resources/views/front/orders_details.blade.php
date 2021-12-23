@extends('front.layouts')
@section('title')
Orders Details
@endsection
@section('content')
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
    <img src="{{ asset('front_assets/img/fashion/fashion-header-bg-8.jpg') }}" alt="fashion img">
    <div class="aa-catg-head-banner-area">
      <div class="container">
       <div class="aa-catg-head-banner-content">
         <h2>Orders Details Page</h2>
         <ol class="breadcrumb">
           <li><a href="{{ route('home') }}">Home</a></li>                   
           <li class="active">Orders Details</li>
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
          <div id="go_back_div">
            <a href="{{ route('order') }}"><button id="go_back" class="btn btn-primary">Go Back</button></a>
            <button id="go_back" class="btn btn-warning" onclick="print_page()">Print</button>
          </div>
        </div>
      </div>
      <div id="printarea">
        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-header text-center text-uppercase">
                User Details
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Name</strong> : {{ $orders[0]->name }}</li>
                <li class="list-group-item"><strong>Email</strong> : {{ $orders[0]->email }}</li>
                <li class="list-group-item"><strong>Mobile No</strong> : {{ $orders[0]->mobile }}</li>
                <li class="list-group-item"><strong>Address</strong> : {{ $orders[0]->address }}</li>
                <li class="list-group-item"><strong>City</strong> : {{ $orders[0]->city }}</li>
                <li class="list-group-item"><strong>State</strong> : {{ $orders[0]->state }}</li>
                <li class="list-group-item"><strong>zip</strong> : {{ $orders[0]->zip }}</li>
              </ul>
            </div>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header text-center text-uppercase">
                Invoice/transaction details
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Invoice No</strong> : {{ $orders[0]->sale_code }}</li>
                <li class="list-group-item"><strong>Payment Type</strong> : 
                  
                  <?php
                    if($orders[0]->payment_type == 'Gateway'){ 
                      echo "Instamojo";
                    } else { 
                      echo "Cash On Delivery";
                    } 
                  ?>
                </li>
                <li class="list-group-item"><strong>Order Status</strong> : {{  $orders[0]->order_status }}</li>
                <li class="list-group-item"><strong>Payment Status</strong> : {{  $orders[0]->payment_status }}</li>
                <li class="list-group-item"><strong>Txn-ID</strong> : 
                  <?php 
                    if($orders[0]->txn_id != ""){
                      echo $orders[0]->txn_id;
                    } else {
                      echo 0;
                    }
                  ?>
                </li>
                <li class="list-group-item"><strong>Payment Id</strong> : 
                  <?php 
                    if($orders[0]->payment_id != ""){
                      echo $orders[0]->payment_id;
                    } else {
                      echo 0;
                    }
                  ?>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="cart-view-area">
              <div class="cart-view-table" id="new_cart_id">
                <div class="table-responsive">
                  <h3 class="text-center">Products</h3>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Sr.no</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Placed At</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Sub Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($orders[0]))
                        @php
                          $i = 1;
                          $sub_total = 0;
                        @endphp
                        @foreach($orders as $key => $value)
                          <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $value->product_name }}</td>
                            <td><img src="{{ asset('pro_img') }}/{{ $value->image }}" alt="{{ $value->image }}"></td>
                            
                            <td>{{ date('Y/m/d',strtotime($value->added_on)) }}</td>
                            <td>INR {{ $value->price }}</td>
                            <td>{{ $value->qty }}</td>
                            <td>INR {{ $value->price * $value->qty }}</td>
                            <?php $sub_total += $value->price * $value->qty;?>
                          </tr>
                        @endforeach
                        <?php  
                          if($orders[0]->coupon_type == "Percent"){
                            $coupon_val = $orders[0]->coupon_value.'%';
                                    
                          } else if($orders[0]->coupon_type == "Amount"){
                            $coupon_val = $orders[0]->coupon_value.'₹';
                          } else {
                            $coupon_val =  0;
                          }

                          if($orders[0]->coupon_code != ''){
                            $coupon_code = $orders[0]->coupon_code;
                          } else {
                            $coupon_code = 'no-coupon applied';
                          }
                        ?>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td><strong>Total</strong></td>
                          <td>INR {{  $sub_total }}</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td><strong>Coupon Code</strong></td>
                          <td>{{ $coupon_code }}</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td><strong>Coupon value</strong></td>
                          <td>{{ $coupon_val }}</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td><strong>Grand Total</strong></td>
                          <td>INR {{ $orders[0]->grand_total }}</td>
                        </tr>
                      @else
                        <h2>No Details Found</h2>
                      @endif
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </section>
@endsection