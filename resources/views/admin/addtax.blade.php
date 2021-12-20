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
                  <a href="{{ route('admin_tax') }}">
                    <button type="button" class="btn btn-secondary">Go Back</button>
                  </a>
                </div>
            </div>
          </div>

          <div class="row m-t-30">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
    
                  <form action="{{ route('manage_tax_process') }}" method="post">
                    @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="tax_value" class="control-label mb-1">Tax value</label>
                          <input id="tax_value" name="tax_value" type="text" class="form-control" value="{{ $tax_value }}"  >
                          @error('tax_value')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      
                      <input type="hidden" value="{{ $tax_id }}" name="tax_id" />
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="tax_desc" class="control-label mb-1">Tax Description</label>
                          <input id="tax_desc" name="tax_desc" type="text" class="form-control" value="{{ $tax_desc }}" >
                          @error('tax_desc')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>

                    </div>
                    
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            Submit
                        </button>
                        <button style = "{{ ($tax_id > 0) ? 'display:none' : '' }}" id="payment-button" type="reset"  class="btn btn-lg  btn-block btn-secondary">
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