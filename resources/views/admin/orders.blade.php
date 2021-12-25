@extends('admin.layouts')
@section("content")
<!-- MAIN CONTENT-->
<div class="main-content">
  <div class="section__content section__content--p30">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="overview-wrap">
                      <h2 class="title-1">Sales</h2>
                  </div>
              </div>
          </div>

          <div class="row m-t-30">
            <div class="col-md-12">
                <!-- DATA TABLE-->
                <div class="table-responsive m-b-40">
                  <table class="table table-borderless table-data3 text-center">
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
                              <a  href="{{ route('admin_order_details',['id' => $value->id]) }}"><button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
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
                <!-- END DATA TABLE-->
            </div>
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
