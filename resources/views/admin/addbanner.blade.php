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
                  <a href="{{ route('admin_banner') }}">
                    <button type="button" class="btn btn-secondary">Go Back</button>
                  </a>
                </div>
            </div>
          </div>
          @include('admin.alerts')
          <div class="row m-t-30">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  
                  <form action="{{ route('manage_banner_process') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="banner_name" class="control-label mb-1">Banner Name</label>
                          <input id="banner_name" name="banner_name" type="text" class="form-control" value="{{ $banner_name }}"  >
                        </div>
                      </div>

                      <input type="hidden" value="{{ $banner_id }}" name="banner_id" />
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="banner_link" class="control-label mb-1">Banner Link</label>
                          <input id="banner_link" name="banner_link" type="text" class="form-control" value="{{ $banner_link }}" >
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="banner_image" class="control-label mb-1">Banner Image</label>
                          <input type="file" id="pro_image" name="banner_image" class="form-control-file" value={{ $banner_image }}>
                        </div>
                        <?php 
                            if($banner_image == ''){
                              $display = 'display : none';
                            } else {
                              $display = 'display : block';
                            }
                            ?>
                        <img  id="preview-image-before-upload" src=""
                            style="max-height: 100px;{{ $display }}">
                        @error('banner_image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      @if ($banner_image == '')
                        <input type="hidden" name="pro_old_img" id="pro_old_img" value="">
                        @else
                          @if(file_exists(public_path("banner_img/".$banner_image)))
                            <input type="hidden" name="pro_old_img" id="pro_old_img" value="{{ asset('banner_img') }}/{{$banner_image  }}">
                          @endif
                      @endif
                    </div>
                    
                    
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            Submit
                        </button>
                        <button style = "{{ ($banner_id > 0) ? 'display:none' : '' }}" id="payment-button" type="reset"  class="btn btn-lg  btn-block btn-secondary">
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