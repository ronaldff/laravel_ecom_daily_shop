@extends('admin.layouts')
@section("content")
<!-- MAIN CONTENT-->
<div class="main-content">
  <div class="section__content section__content--p30">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="overview-wrap">
                      <h2 class="title-1">Tax</h2>
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap float-right">
                  <a href="{{ route('add_tax') }}">
                    <button type="button" class="btn btn-success">Add Tax</button>
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
                                <th>Tax Value</th>
                                <th>Tax Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($taxes) > 0)
                            <?php $i=1; ?>
                                @foreach($taxes as $key => $tax)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $tax->tax_value }}</td>
                                        <td>{{ $tax->tax_desc}}</td>
                                        <td><?php echo
                                            ($tax->status == true) ? "<button onclick='changTaxStatus($tax->id,$tax->status)' type='button' class='btn btn-success'>Active</button>" : "<button onclick='changTaxStatus($tax->id,$tax->status)' type='button' class='btn btn-danger'>Deactive</button>"
                                        
                                        ?></td>
                                        <td>
                                            
                                            <a href="{{ route('edittax', ['id' => $tax->id]) }}">
                                                <button class='btn btn-warning'>Edit</button>
                                            </a>

                                            <button class='btn btn-danger' onclick="deleteTax({{ $tax->id }})">Delete</button>
                                           
                                        </td>
                                        
                                    </tr>
                                @endforeach
                                @else
                                  <tr ><td class="text-center" colspan="6">No Tax Found</td></tr>
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
    // Delete Tax functionality
    function deleteTax(tax_id) {
        if(confirm("Are you sure?")){
            let _token = $('meta[name="csrf-token"]').attr('content');
            let data = {
                _token,
                tax_id
            };

            $.ajax({
                type:'POST',
                url:"{{ route('deletetax') }}",
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
    function changTaxStatus(tax_id, tax_status){
        if(tax_status == 1){
            tax_status = 0;
        } else {
            tax_status = 1;
        }
        let _token = $('meta[name="csrf-token"]').attr('content');
        let data = {
            _token,
            tax_status,
            tax_id
        };
        
        $.ajax({
            type:'POST',
            url:"{{ route('change_tax_status') }}",
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