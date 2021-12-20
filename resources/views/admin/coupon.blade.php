@extends('admin.layouts')
@section("content")
<!-- MAIN CONTENT-->
<div class="main-content">
  <div class="section__content section__content--p30">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="overview-wrap">
                      <h2 class="title-1">Coupon</h2>
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap float-right">
                  <a href="{{ route('add_coupon') }}">
                    <button type="button" class="btn btn-success">Add Coupon</button>
                  </a>
                </div>
            </div>
          </div>

          <div class="row m-t-30">
            <div class="col-md-12">
                @include('admin.alerts')
                <!-- DATA TABLE-->
                <div class="table-responsive m-b-40">
                    <table class="table table-borderless table-data3 text-center">
                        <thead>
                            <tr>
                                <th>Sr.no</th>
                                <th>Coupon Title</th>
                                <th>Coupon Code</th>
                                <th>Coupon value</th>
                                <th>Coupon Type</th>
                                <th>Coupon Min Value</th>
                                <th>Coupon Status</th>
                                <th>Coupon expired</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($coupons) > 0)
                            <?php $i=1; ?>
                                @foreach($coupons as $key => $coupon)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $coupon->title }}</td>
                                        <td>{{ $coupon->code}}</td>
                                        <td>{{ $coupon->value}}</td>
                                        <td>{{ $coupon->coupon_type}}</td>
                                        <td>{{ $coupon->coupon_min_value}}</td>
                                        <td>{{ $coupon->expire_date}}</td>
                                        <td><?php echo
                                            ($coupon->status == true) ? "<button onclick='changCouponStatus($coupon->id,$coupon->status)' type='button' class='btn btn-success'>Active</button>" : "<button onclick='changCouponStatus($coupon->id,$coupon->status)' type='button' class='btn btn-danger'>Deactive</button>"
                                        
                                        ?></td>
                                        <td>
                                            
                                            <a href="{{ route('editCoupon', ['id' => $coupon->id]) }}">
                                                <button class='btn btn-warning'>Edit</button>
                                            </a>

                                            <button class='btn btn-danger' onclick="deletecoupon({{ $coupon->id }})">Delete</button>
                                           
                                        </td>
                                        
                                    </tr>
                                @endforeach
                                @else
                                  <tr ><td class="text-center" colspan="9">No Coupon Found</td></tr>
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
<script>
    // Delete category functionality
    function deletecoupon(coupon_id) {
        if(confirm("Are you sure?")){
            let _token = $('meta[name="csrf-token"]').attr('content');
            let data = {
                _token,
                coupon_id
            };

            $.ajax({
                type:'POST',
                url:"{{ route('deletecoupon') }}",
                data: data,
                success:function(data) {
                    
                    if(data.result == 'success'){
                    alert(data.data);
                    window.location.reload();
                    } else {
                    alert(data.data);
                    window.location.reload();
                    }
                }
            });
        }
    }

    // Change status functionality
    function changCouponStatus(coupon_id, coupon_status){
        if(coupon_status == 1){
            coupon_status = 0;
        } else {
            coupon_status = 1;
        }
        let _token = $('meta[name="csrf-token"]').attr('content');
        let data = {
            _token,
            coupon_status,
            coupon_id
        };
        
        $.ajax({
            type:'POST',
            url:"{{ route('change_coupon_status') }}",
            data: data,
            success:function(data) {
                if(data.result == 'success'){
                alert(data.data);
                window.location.reload();
                } else {
                alert(data.data);
                window.location.reload();
                }
            }
        });  
    }
</script>