@extends('admin.layouts')
@section("content")
<!-- MAIN CONTENT-->
<div class="main-content">
  <div class="section__content section__content--p30">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="overview-wrap">
                      <h2 class="title-1">Size</h2>
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap float-right">
                  <a href="{{ route('add_size') }}">
                    <button type="button" class="btn btn-success">Add Size</button>
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
                                <th>Size Name</th>
                                <th>Size Sequence</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($sizes) > 0)
                            <?php $i=1; ?>
                                @foreach($sizes as $key => $size)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $size->size }}</td>
                                        <td>{{ $size->sequence}}</td>
                                        <td><?php echo
                                            ($size->status == true) ? "<button onclick='changSizeStatus($size->id,$size->status)' type='button' class='btn btn-success'>Active</button>" : "<button onclick='changSizeStatus($size->id,$size->status)' type='button' class='btn btn-danger'>Deactive</button>"
                                        
                                        ?></td>
                                        <td>
                                            
                                            <a href="{{ route('editsize', ['id' => $size->id]) }}">
                                                <button class='btn btn-warning'>Edit</button>
                                            </a>

                                            <button class='btn btn-danger' onclick="deleteSize({{ $size->id }})">Delete</button>
                                           
                                        </td>
                                        
                                    </tr>
                                @endforeach
                                @else
                                  <tr ><td class="text-center" colspan="6">No Size Found</td></tr>
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
    // Delete Size functionality
    function deleteSize(size_id) {
        if(confirm("Are you sure?")){
            let _token = $('meta[name="csrf-token"]').attr('content');
            let data = {
                _token,
                size_id
            };

            $.ajax({
                type:'POST',
                url:"{{ route('deletesize') }}",
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
    function changSizeStatus(size_id, size_status){
        if(size_status == 1){
            size_status = 0;
        } else {
            size_status = 1;
        }
        let _token = $('meta[name="csrf-token"]').attr('content');
        let data = {
            _token,
            size_status,
            size_id
        };
        
        $.ajax({
            type:'POST',
            url:"{{ route('change_size_status') }}",
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