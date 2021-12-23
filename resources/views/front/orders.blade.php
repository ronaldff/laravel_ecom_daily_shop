@extends('front.layouts')
@section('title')
My Orders
@endsection
@section('content')
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
    <img src="{{ asset('front_assets/img/fashion/fashion-header-bg-8.jpg') }}" alt="fashion img">
    <div class="aa-catg-head-banner-area">
      <div class="container">
       <div class="aa-catg-head-banner-content">
         <h2>Orders Page</h2>
         <ol class="breadcrumb">
           <li><a href="{{ route('home') }}">Home</a></li>                   
           <li class="active">Orders</li>
         </ol>
       </div>
      </div>
    </div>
  </section>
  <!-- / catg header banner section -->

  <!-- Cart view section -->
  <section id="cart-view">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="cart-view-area">
            <div class="cart-view-table" id="new_cart_id">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Sr.no</th>
                      <th>Invoice No</th>
                      <th>Payment Type</th>
                      <th>Order Status</th>
                      <th>Payment Status</th>
                      <th>Grand Total</th>
                      <th>Placed At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($orders[0]))
                      @php
                        $i = 1;
                      @endphp
                      @foreach($orders as $key => $value)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $value->sale_code }}</td>
                          <td>
                            <?php
                                if($value->payment_type == 'Gateway'){ 
                                  echo "Instamojo";
                                } else { 
                                  echo "Cash on delivary";
                               } 
                            ?>
                          </td>
                          <td>{{ $value->order_status}}</td>
                          <td>{{ $value->payment_status}}</td>
                          <td>{{ $value->grand_total }}</td>
                          <td>{{ date('Y/m/d',strtotime($value->added_on)) }}</td>
                          <td>
                            <a  href="{{ url('/order_details') }}/{{ $value->id }}"><button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                            <a  href="{{ url('/downloadOrdersPdf') }}/{{ $value->id }}"><button class="btn btn-warning"><i class="fa fa-download" aria-hidden="true"></i></button></a>
                          </td>

                        </tr>

                      @endforeach
                    @else
                      <h2>No Order Found</h2>
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