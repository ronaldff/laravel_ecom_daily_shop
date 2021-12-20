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
                  <a href="{{ route('admin_coupon') }}">
                    <button type="button" class="btn btn-secondary">Go Back</button>
                  </a>
                </div>
            </div>
          </div>

          <div class="row m-t-30">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
    
                  <form action="{{ route('manage_coupon_process') }}" method="post">
                    @csrf
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="coupon_title" class="control-label mb-1">Coupon Title</label>
                          <input id="coupon_title" name="coupon_title" type="text" class="form-control" value="{{ $coupon_title }}"  >
                          @error('coupon_title')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                    
                      <input type="hidden" value="{{ $id }}" name="coupon_id" />
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="coupon_code" class="control-label mb-1">Coupon Code</label>
                          <input id="coupon_code" name="coupon_code" type="text" class="form-control" value="{{ $code }}" >
                          @error('coupon_code')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="coupon_value" class="control-label mb-1">Coupon Value</label>
                          <input id="coupon_value" name="coupon_value" type="text" class="form-control" value="{{ $value }}"  >
                          @error('coupon_value')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                    
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="coupon_type" class="control-label mb-1">Coupon type</label>
                          <select name="coupon_type" id="coupon_type" class="form-control">
                            <option value="">select Coupon type</option>
                            <option value="Percent" {{  ($coupon_type == "Percent") ? "selected=selected" : "" }}>Percent</option>
                            <option value="Amount" {{  ($coupon_type == "Amount") ? "selected=selected" : "" }}>Amount</option>
                          </select>

                          @error('coupon_type')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="coupon_min_value" class="control-label mb-1">Coupon Minimum Value</label>
                          <input id="coupon_min_value" name="coupon_min_value" type="text" class="form-control" value="{{ $coupon_min_value }}"  >
                          @error('coupon_min_value')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                    
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="expire_date" class="control-label mb-1">Coupon Expired</label>
                          <input id="expire_date" name="expire_date" type="date" class="form-control" value="{{ $expire_date }}" >
                          @error('expire_date')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="is_one_time" class="control-label mb-1"> Select Is One Time Coupon</label>
                          <select name="is_one_time" id="is_one_time" class="form-control">
                            <option value="">select coupon time</option>
                            <option value="{{ $is_one_time == 0 ? 0 : 0 }}" {{  ($is_one_time == 0) ? "selected=selected" : "" }}>No</option>
                            <option value="{{ $is_one_time == 1 ? 1 : 1 }}" {{  ($is_one_time == 1) ? "selected=selected" : "" }}>Yes</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            Submit
                        </button>
                      </button>
                      <button style = "{{ ($id > 0) ? 'display:none' : '' }}" id="payment-button" type="reset"  class="btn btn-lg  btn-block btn-secondary">
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