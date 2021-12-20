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
                  <a href="{{ route('admin_brand') }}">
                    <button type="button" class="btn btn-secondary">Go Back</button>
                  </a>
                </div>
            </div>
          </div>

          <div class="row m-t-30">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
    
                  <form action="{{ route('manage_brand_process') }}" method="post" enctype="multipart/form-data">
                    @csrf
                      <div class="row">
                      <div class="form-group col-md-6">
                        <label for="brand" class="control-label mb-1">Brand Name</label>
                        <input id="brand" name="brand" type="text" class="form-control" value="{{ $brand }}"  >
                        @error('brand')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <input type="hidden" value="{{ $brand_id }}" name="brand_id" />

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="image" class="control-label mb-1">Product Image</label>
                          <input type="file" id="pro_image" name="image" class="form-control-file" value={{ $image }}>
                        </div>
                        <?php 
                            if($image == ''){
                              $display = 'display : none';
                            } else {
                              $display = 'display : block';
                            }
                            ?>
                        <img  id="preview-image-before-upload" src=""
                            style="max-height: 100px;{{ $display }}">
                        @error('image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      @if ($image == '')
                      <input type="hidden" name="pro_old_img" id="pro_old_img" value="">
                      @else
                        @if(file_exists(public_path("pro_brand_img/".$image)))
                          <input type="hidden" name="pro_old_img" id="pro_old_img" value="{{ asset('pro_brand_img') }}/{{$image  }}">
                        @endif
                      @endif
                    </div>
                   
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            Submit
                        </button>
                        <button style = "{{ ($brand_id > 0) ? 'display:none' : '' }}" id="payment-button" type="reset"  class="btn btn-lg  btn-block btn-secondary">
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