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
                  <a href="{{ route('admin_color') }}">
                    <button type="button" class="btn btn-secondary">Go Back</button>
                  </a>
                </div>
            </div>
          </div>

          <div class="row m-t-30">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
    
                  <form action="{{ route('manage_color_process') }}" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="color" class="control-label mb-1">Color Name</label>
                      <input id="color" name="color" type="text" class="form-control" value="{{ $color }}"  >
                      @error('color')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <input type="hidden" value="{{ $color_id }}" name="color_id" />
                    <div class="form-group">
                      <label for="sequence" class="control-label mb-1">Color Sequence</label>
                      <input id="sequence" name="sequence" type="text" class="form-control" value="{{ $sequence }}" >
                      @error('sequence')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            Submit
                        </button>
                        <button style = "{{ ($color_id > 0) ? 'display:none' : '' }}" id="payment-button" type="reset"  class="btn btn-lg  btn-block btn-secondary">
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
                <p>Copyright ?? @php
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