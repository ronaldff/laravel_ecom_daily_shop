@extends("admin.pdf.layouts")
@section('content')
  <h1 class="headingText">Category Lists</h1>
  <table id="customers">
    <tr>
      <th>Sr.no</th>
      <th>Category Name</th>
      <th>Category Slug</th>
      <th>Category Status</th>
    </tr>
    @if(count($categories) > 0)
    <?php $i=1; ?>
        @foreach($categories as $key => $category)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ ucfirst($category->category_name) }}</td>
                <td>{{ $category->category_slug}}</td>
                <td><?php echo
                    ($category->status == true) ? "<button type='button' class='btn btn-success'>Active</button>" : "<button type='button' class='btn btn-danger'>Deactive</button>"
                
                ?></td>
            </tr>
        @endforeach
        @else
          <tr ><td class="text-center" colspan="6">No Category Found</td></tr>
    @endif

  </table>
  
@endsection







