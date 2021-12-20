@extends('front.layouts')
@section('title')
Forgot Password
@endsection
@section('content')
 <!-- Cart view section -->
 <section id="aa-myaccount">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
       <div class="aa-myaccount-area">         
          <div class="row">
            <div class="col-md-6">
              <div class="aa-myaccount-register">                 
                <h4>Forgot Password</h4>
                <form class="aa-login-form" action="" id="frmNewPassword">
                  @csrf
                  <input type="hidden" name="id"  value="{{ $id }}">

                  <label for="new_password">New Password<span>*</span></label>
                  <input type="password" name="new_password" placeholder="Enter New Password" required>

                  <button id="btnNewPassword" type="submit" class="aa-browse-btn" style="margin-bottom: 12px;">Submit</button> 
                  <p id="forget_error"></p>                   
                </form>
              </div>
              <p id="thank_you"></p>
              
            </div>
          </div>          
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / Cart view section -->
@endsection