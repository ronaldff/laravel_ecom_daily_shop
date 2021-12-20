@extends('admin.layouts')
@section("content")
<!-- MAIN CONTENT-->
<div class="main-content">
  <div class="section__content section__content--p30">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="overview-wrap">
                      <h2 class="title-1">{{ ucfirst($title) }}</h2>
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap float-right">
                  <a href="{{ route('admin_category') }}">
                    <button type="button" class="btn btn-secondary">Go Back</button>
                  </a>
                </div>
            </div>
          </div>

          <div class="row m-t-30">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
    
                  <form action="{{ route('manage_category_process') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="category_name" class="control-label mb-1">Name</label>
                          <input id="category_name" name="category_name" type="text" class="form-control" value="{{ $category_name }}"  >
                          @error('category_name')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <input type="hidden" value="{{ $category_id }}" name="cat_id" />
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="category_slug" class="control-label mb-1">Slug</label>
                          <input id="category_slug" name="category_slug" type="text" class="form-control" value="{{ $category_slug }}" >
                          @error('category_slug')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="parent_category_id" class="control-label mb-1">Parent Cat</label>
                          <select name="parent_category_id" id="parent_category_id" class="form-control">
                            <option value="">select Parent Category</option>
                            @if(count($categories) > 0)
                            @foreach($categories as $key => $category)
                            <option value="{{ $category->id }}" {{  ($parent_category_id == $category->id) ? "selected=selected" : "" }}>{{ $category->category_name }}</option>
                            @endforeach
                            @else
                            <option value="">Please Insert Category From Admin Category Section OR Activate The Category</option>
                            @endif
                          </select>
                          @error('category')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="image" class="control-label mb-1">Category Image</label>
                          <input type="file" id="pro_image" name="category_image" class="form-control-file" value={{ $category_image }}>
                        </div>
                        <?php 
                            if($category_image == ''){
                              $display = 'display : none';
                            } else {
                              $display = 'display : block';
                            }
                            ?>
                        <img  id="preview-image-before-upload" src=""
                            style="max-height: 100px;{{ $display }}">
                        @error('category_image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      @if ($category_image == '')
                        <input type="hidden" name="pro_old_img" id="pro_old_img" value="">
                        @else
                          @if(file_exists(public_path("category_image/".$category_image)))
                            <input type="hidden" name="pro_old_img" id="pro_old_img" value="{{ asset('category_image') }}/{{$category_image  }}">
                          @endif
                      @endif

                      <div class="col-md-2">
                        <label class="form-check-label" for="defaultCheck1">
                          Is Home
                        </label>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="is_home" {{ $is_home==0 ? '' : 'checked' }}>
                       
                        </div>
                      </div>

                    </div>
                    
                    
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            Submit
                        </button>
                        <button style = "{{ ($category_id > 0) ? 'display:none' : '' }}" id="payment-button" type="reset"  class="btn btn-lg  btn-block btn-secondary">
                          Reset
                        </button>
                    </div>
                  </form>
                </div>
              </div>
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