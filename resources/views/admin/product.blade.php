@extends('admin.layouts')
@section("content")
<!-- MAIN CONTENT-->
<div class="main-content">
  <div class="section__content section__content--p30">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="overview-wrap">
                      <h2 class="title-1">Product</h2>
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap float-right">
                  <a href="{{ route('add_product') }}">
                    <button type="button" class="btn btn-success">Add Product</button>
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
                                <th>Product Name</th>
                                <th>Product Slug</th>
                                <th>Product Image</th>
                                <th>Product Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($products) > 0)
                            <?php $i=1; ?>
                                @foreach($products as $key => $product)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->slug }}</td>
                                        <td>
                                            @if ($product->image)
                                                @if(file_exists(public_path("pro_img/".$product->image)))
                                                    <a target="_blank" href="{{ asset('pro_img') }}/{{ $product->image }}"><img width="50" src="{{ asset('pro_img') }}/{{ $product->image }}" /></a> 
                                                @else
                                                    <a target="_blank" href="{{ asset('pro_img') }}/download.png"><img width="50" src="{{ asset('pro_img') }}/download.png" /></a>
                                                @endif
                                            @else
                                                <a target="_blank" href="{{ asset('pro_img') }}/download.png"><img width="50" src="{{ asset('pro_img') }}/download.png" /></a>
                                            @endif
                                        </td>
                                        <td><?php echo
                                            ($product->status == true) ? "<button onclick='changProStatus($product->id,$product->status)' type='button' class='btn btn-success'>Active</button>" : "<button onclick='changProStatus($product->id,$product->status)' type='button' class='btn btn-danger'>Deactive</button>"
                                        
                                        ?></td>
                                        <td>
                                            
                                            <a href="{{ route('editproduct', ['id' => $product->id]) }}">
                                                <button class='btn btn-warning'>Edit</button>
                                            </a>

                                            <button class='btn btn-danger' onclick="deletePro({{ $product->id }})">Delete</button>
                                           
                                        </td>
                                        
                                    </tr>
                                @endforeach
                                @else
                                  <tr ><td class="text-center" colspan="6">No Product Found</td></tr>

                                  
                            @endif

                            

                        </tbody>
                    </table>
                    @if(count($products) > 0)
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                Showing {{ $firstItem }} to {{ $lastItem }} of {{ $total }} entries
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="paginateData float-right">
                                    {!! $products->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    @endif
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
    // Delete product functionality
    function deletePro(product_id) {
        if(confirm("Are you sure?")){
            let _token = $('meta[name="csrf-token"]').attr('content');
            let data = {
                _token,
                product_id
            };

            $.ajax({
                type:'GET',
                url:"{{ route('deleteproduct') }}",
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
    function changProStatus(product_id, product_status){
        if(product_status == 1){
            product_status = 0;
        } else {
            product_status = 1;
        }
        let _token = $('meta[name="csrf-token"]').attr('content');
        let data = {
            _token,
            product_status,
            product_id
        };
        
        $.ajax({
            type:'POST',
            url:"{{ route('change_product_status') }}",
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