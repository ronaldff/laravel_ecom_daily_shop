@extends('admin.layouts')
@section("content")
<!-- MAIN CONTENT-->
<div class="main-content">
  <div class="section__content section__content--p30">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="overview-wrap">
                      <h2 class="title-1">Customer</h2>
                  </div>
              </div>
          </div>

          <div class="row m-t-30">
            <div class="col-md-12 table-responsive">
                @include('admin.alerts')
                <!-- DATA TABLE-->
                <table class="table table-striped text-center data-table">
                    <thead class="thead-dark">
                        <tr>
                            <th width="103px">SR.No</th>
                            <th width="100px">Name</th>
                            <th width="20px">Company</th>
                            <th width="20px">City</th>
                            <th width="100px">Status</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <td>
                                <input type="text" name="id" class="form-control ID" placeholder="ID">
                            </td>
                            <td>
                                <input type="text" name="name" class="form-control sendName" placeholder="Name">
                            </td>
                            <td>
                                <input type="text" name="company" class="form-control searchCompany" placeholder="Company">
                            </td>
                            <td>
                                <input type="text" name="city" class="form-control searchCity" placeholder="City">
                            </td>
                            <td>
                                <select name="status" id="statusData" class="form-control" >
                                    <option value="">Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Deactive">Deactive</option>
                                </select>
                            </td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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

<script>
  $(document).ready(function(){
    loadDatatableAjax();
  });

  function loadDatatableAjax(){
    var table = $('.data-table').DataTable({
        
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('manage_customer_process') }}",
          data: function (d) {
                d.name = $('.sendName').val(),
                d.id = $('.ID').val(),
                d.company = $('.searchCompany').val(),
                d.city = $('.searchCity').val(),
                d.status = $('#statusData').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'company', name: 'company'},
            {data: 'city', name: 'city'},
            {data: 'status', name: 'status',orderable: false, searchable: false}
        ]
    });

    $(".searchCompany").keyup(function(){
        table.draw();
    });

    $(".searchCity").keyup(function(){
        table.draw();
    });

    $(".sendName").keyup(function(){
        table.draw();
    });

    $(".ID").keyup(function(){
        table.draw();
    });

    $("#statusData").change(function(){
        table.draw();
    });
  }
  
</script>

@endsection


