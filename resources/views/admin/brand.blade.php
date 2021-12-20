@extends('admin.layouts')
@section("content")
<!-- MAIN CONTENT-->
<div class="main-content">
  <div class="section__content section__content--p30">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="overview-wrap">
                      <h2 class="title-1">Brand</h2>
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap float-right">
                  <a href="{{ route('add_brand') }}">
                    <button type="button" class="btn btn-success">Add Brand</button>
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
                                <th>Brand Name</th>
                                <th>Brand Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($brands) > 0)
                            <?php $i=1; ?>
                                @foreach($brands as $key => $brand)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $brand->brand }}</td>
                                        <td>
                                          @if ($brand->image)
                                              @if(file_exists(public_path("pro_brand_img/".$brand->image)))
                                                  <a target="_blank" href="{{ asset('pro_brand_img') }}/{{ $brand->image }}"><img width="50" src="{{ asset('pro_brand_img') }}/{{ $brand->image }}" /></a> 
                                              @else
                                                  <a target="_blank" href="{{ asset('pro_img') }}/download.png"><img width="50" src="{{ asset('pro_img') }}/download.png" /></a>
                                              @endif
                                          @else
                                              <a target="_blank" href="{{ asset('pro_img') }}/download.png"><img width="50" src="{{ asset('pro_img') }}/download.png" /></a>
                                          @endif
                                        </td>
                                        <td><?php echo
                                            ($brand->status == true) ? "<button onclick='changBrandStatus($brand->id,$brand->status)' type='button' class='btn btn-success'>Active</button>" : "<button onclick='changBrandStatus($brand->id,$brand->status)' type='button' class='btn btn-danger'>Deactive</button>"
                                        
                                        ?></td>
                                        <td>
                                            
                                            <a href="{{ route('editbrand', ['id' => $brand->id]) }}">
                                                <button class='btn btn-warning'>Edit</button>
                                            </a>

                                            <button class='btn btn-danger' onclick="deleteBrand({{ $brand->id }})">Delete</button>
                                           
                                        </td>
                                        
                                    </tr>
                                @endforeach
                                @else
                                  <tr ><td class="text-center" colspan="6">No Brand Found</td></tr>
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
    // Delete Brand functionality
    function deleteBrand(brand_id) {
        if(confirm("Are you sure?")){
            let _token = $('meta[name="csrf-token"]').attr('content');
            let data = {
                _token,
                brand_id
            };

            $.ajax({
                type:'POST',
                url:"{{ route('deletebrand') }}",
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
    function changBrandStatus(brand_id, brand_status){
        if(brand_status == 1){
            brand_status = 0;
        } else {
            brand_status = 1;
        }
        let _token = $('meta[name="csrf-token"]').attr('content');
        let data = {
            _token,
            brand_status,
            brand_id
        };
        
        $.ajax({
            type:'POST',
            url:"{{ route('change_brand_status') }}",
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