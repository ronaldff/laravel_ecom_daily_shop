@extends('admin.layouts')
@section("content")
<!-- MAIN CONTENT-->
<div class="main-content">
  <div class="section__content section__content--p30">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="overview-wrap">
                      <h2 class="title-1">Category</h2>
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap float-right">
                  <a href="{{ route('add_category') }}">
                    <button type="button" class="btn btn-success">Add Category</button>
                  </a>
                </div>
                <div class="overview-wrap float-right mr-3">
                    <button class='btn btn-warning' onclick="activateAll()">Activate All Category</button>
                </div>
                <div class="overview-wrap float-right mr-3">
                    <a href="{{ route('downloadPdfCat') }}">
                        <button type="button" class="btn btn-secondary">PDF</button>
                    </a>
                </div>
                <div class="overview-wrap float-right mr-3">
                    <input id="searchCat" name="searchCat" type="text" class="form-control" placeholder="Search Category" onkeyup="searchCat()">
                </div>
               
            </div>
          </div>
          <div class="row mt-3">
              <div class="col-md-12">
                  <div id="insertErr">

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
                                <th>Category Name</th>
                                <th>Category Slug</th>
                                <th>Category Image</th>
                                <th>Category Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @if(count($categories) > 0)
                            <?php $i=1; ?>
                                @foreach($categories as $key => $category)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ ucfirst($category->category_name) }}</td>
                                        <td>{{ $category->category_slug}}</td>
                                        <td>
                                            @if ($category->category_image)
                                                @if(file_exists(public_path("category_image/".$category->category_image)))
                                                    <a target="_blank" href="{{ asset('category_image') }}/{{ $category->category_image }}"><img width="50" src="{{ asset('category_image') }}/{{ $category->category_image }}" /></a> 
                                                @else
                                                    <a target="_blank" href="{{ asset('pro_img') }}/download.png"><img width="50" src="{{ asset('pro_img') }}/download.png" /></a>
                                                @endif
                                            @else
                                                <a target="_blank" href="{{ asset('pro_img') }}/download.png"><img width="50" src="{{ asset('pro_img') }}/download.png" /></a>
                                            @endif
                                        </td>

                                        <td><?php echo
                                            ($category->status == true) ? "<button onclick='changCatStatus($category->id,$category->status)' type='button' class='btn btn-success'>Active</button>" : "<button onclick='changCatStatus($category->id,$category->status)' type='button' class='btn btn-danger'>Deactive</button>"
                                        
                                        ?></td>
                                        <td>
                                            
                                            <a href="{{ route('editCat', ['id' => $category->id]) }}">
                                                <button class='btn btn-warning'>Edit</button>
                                            </a>

                                            <button class='btn btn-danger' onclick="deleteCat({{ $category->id }})">Delete</button>
                                           
                                        </td>
                                        
                                    </tr>
                                @endforeach
                                @else
                                  <tr ><td class="text-center" colspan="6">No Category Found</td></tr>
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
    // Activate all category
    function activateAll(){
        let _token = $('meta[name="csrf-token"]').attr('content');
        let data = {
            _token
        };
        $.ajax({
            type:'POST',
            url:"{{ route('activateAll') }}",
            data: data,
            success:function(data) {
                alert(data.data);
                window.location.reload();
            }
        });
    }

    // Search Category functionality
    function searchCat(){
        $("#insertErr").html("");
        $("#insertErr").css("display","block");
        let searchText = $("#searchCat").val();
        var letters = /^[A-Za-z]+$/;
        if(searchText === ''){
            window.location.reload();
        } else {
            if(searchText.length > 2){
                if(searchText.match(letters)){
                    let _token = $('meta[name="csrf-token"]').attr('content');
                    let data = {
                        _token,
                        searchText
                    };

                    $.ajax({
                        type:'POST',
                        url:"{{ route('search_category') }}",
                        data: data,
                        success:function(data) {
                            $("#tbody").html(data);
                        }
                    });
                } else {
                    $("#insertErr").html(` <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Please Insert Characters Only</strong>
                    </div>`);
                }
            } else {
                $("#insertErr").html(` <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Please Insert more than 2 characters</strong>
                </div>`);
            }
        }
        

        setTimeout(function(){
            $("#insertErr").css("display","none");
        }, 3000);
       
    }

    // Delete category functionality
    function deleteCat(cat_id) {
        if(confirm("Are you sure?")){
            let _token = $('meta[name="csrf-token"]').attr('content');
            let data = {
                _token,
                cat_id
            };

            $.ajax({
                type:'POST',
                url:"{{ route('deletecat') }}",
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
    function changCatStatus(cat_id, cat_status){
        if(cat_status == 1){
            cat_status = 0;
        } else {
            cat_status = 1;
        }
        let _token = $('meta[name="csrf-token"]').attr('content');
        let data = {
            _token,
            cat_status,
            cat_id
        };
        
        $.ajax({
            type:'POST',
            url:"{{ route('change_cat_status') }}",
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