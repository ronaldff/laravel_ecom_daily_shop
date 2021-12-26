@extends('admin.layouts')
@section("content")
<style>
  .table td, .table th {
    padding: 0.75rem;
    vertical-align: baseline;
    border-top: 1px solid #dee2e6;
}
</style>
<!-- MAIN CONTENT-->


<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="overview-wrap">
            <h2 class="title-1">Sale Details</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="overview-wrap float-right">
            <a href="{{ route('admin_order') }}">
              <button id="go_back" class="btn btn-primary mr-3">Go Back</button>
            </a>
          </div>
        </div>
      </div>
      <div class="main-content pt-5" style="min-height: auto;">
        <div class="section__content">
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-5">
                  <div class="card-body">
                    <div>
                      1) Update Order Status
                      <select name="parent_category_id" id="order_status" class="form-control col-md-4 mt-2" name="order_status" onchange="changeOrderStatus()">
                        @foreach($order_status_data as $key => $order_status_d)
                          <option value="{{ $order_status_d->id }}" {{  ($order_status_d->sales_status == $orders[0]->order_status) ? "selected=selected" : "" }}>{{ $order_status_d->sales_status }}</option>
                        @endforeach
                      </select>
                    </div>
                    
                    <?php
                    if($orders[0]->payment_type != "Gateway"){ ?>
    <div class="mt-5">
      2) Update Payment Status
      <select name="payment_status" id="payment_status" class="form-control col-md-4 mt-2" onchange="changePaymentStatus()">
        @foreach($payment_status_data as $key => $payment_status_d)
          <option value="{{ $payment_status_d }}" {{  ($payment_status_d == $orders[0]->payment_status) ? "selected=selected" : "" }}>{{ $payment_status_d }}</option>
        @endforeach
      </select>
    </div>
                    <?php }

                    ?>
                
                    

                  </div>
                  
                </div>
              </div>
            </div>
        </div>
      </div>
      <input type="hidden" id="sale_id" value="{{ $orders[0]->id }}">

      <div class="row m-t-30">
        <section id="cart-view">
          <div class="container-fluid">
            <div id="printarea">
              <div class="row">
                <div class="col-md-5">
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
                
                <div class="col-md-2"></div>
                <div class="col-md-5">
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
                      <h3 class="text-center mb-2">Products</h3>
                      <table class="table table-bordered table-data3 text-center">
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
                                <td><img style="width:80px;" src="{{ asset('pro_img') }}/{{ $value->image }}" alt="{{ $value->image }}"></td>
                                
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
        </section> 
      </div>

      
        
        
      <div class="row">
        <div class="col-md-12">
          <div class="copyright">
              <p>Copyright © @php
                  echo date('Y')
              @endphp Colorlib. All rights reserved. Developed by <a href="{{ route('admin_dashboard') }}">Piyush Shyam</a>.</p>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
<script>
  function changeOrderStatus()
  {
    let order_status_id = $("#order_status").val();
    let sale_id = $("#sale_id").val();
    let type = 'order_status_id';
    let _token = $("meta[name='csrf-token']").attr('content');
    let data = {order_status_id, type,_token,sale_id}
    $.ajax({
      url:'/admin/update_sales_status',
      type : 'POST',
      data : data,
      success : (res) => {
        if(res == "success"){
          location.reload();
        }
      }
    });
  }

  function changePaymentStatus()
  {
    let payment_status = $("#payment_status").val();
    let sale_id = $("#sale_id").val();
    let type = 'payment_status_id';
    let _token = $("meta[name='csrf-token']").attr('content');
    let data = {payment_status, type,_token,sale_id}
    $.ajax({
      url:'/admin/update_sales_status',
      type : 'POST',
      data : data,
      success : (res) => {
        if(res == "success"){
          location.reload();
        }
      }
    });
  }

  
</script>

