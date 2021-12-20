@extends('admin.layouts')
@section("content")
<!-- MAIN CONTENT-->
<div class="main-content">
  <div class="section__content section__content--p30">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="overview-wrap">
                      <h2 class="title-1">Banner</h2>
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="overview-wrap float-right">
                <a href="{{ route('add_banner') }}">
                  <button type="button" class="btn btn-success">Add Banner</button>
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
                                <th>Banner Name</th>
                                <th>Banner Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @if(count($banners) > 0)
                            <?php $i=1; ?>
                                @foreach($banners as $key => $banner)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ ucfirst($banner->banner_name) }}</td>
                                        
                                        <td>
                                            @if ($banner->banner_image)
                                                @if(file_exists(public_path("banner_img/".$banner->banner_image)))
                                                    <a target="_blank" href="{{ asset('banner_img') }}/{{ $banner->banner_image }}"><img width="50" src="{{ asset('banner_img') }}/{{ $banner->banner_image }}" /></a> 
                                                @else
                                                    <a target="_blank" href="{{ asset('pro_img') }}/download.png"><img width="50" src="{{ asset('pro_img') }}/download.png" /></a>
                                                @endif
                                            @else
                                                <a target="_blank" href="{{ asset('pro_img') }}/download.png"><img width="50" src="{{ asset('pro_img') }}/download.png" /></a>
                                            @endif
                                        </td>
                                        
                                        <td>
                                          <a href="{{ route('editbanner', ['id' => $banner->id]) }}">
                                              <button class='btn btn-warning'>Edit</button>
                                          </a>

                                          <button class='btn btn-danger' onclick="deleteBanner({{ $banner->id }})">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                  <tr ><td class="text-center" colspan="6">No Banner Found</td></tr>
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
    function deleteBanner(banner_id) {
        if(confirm("Are you sure?")){
            let _token = $('meta[name="csrf-token"]').attr('content');
            let data = {
                _token,
                banner_id
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
  
</script>