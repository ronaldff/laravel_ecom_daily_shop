@extends('front.layouts')
@section('title')
registration
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
                <h4>Register</h4>
                <form class="aa-login-form" action="" id="frmRegistration">
                  @csrf
                  <label for="username">Username<span>*</span><span class="fields_error" id="name_error" ></span></label>
                  <input type="text" name="name"  placeholder="Enter Username">
                  
                  <label for="email">Email<span>*</span><span class="fields_error" id="email_error" ></span></label>
                  <input type="email" name="email"  placeholder="Enter EmailId">

                  <label for="password">Password<span>*</span><span class="fields_error" id="password_error" ></span></label>
                  <input type="password" name="password" placeholder="Enter Password">

                  <label for="mobile">Mobile Number<span>*</span><span class="fields_error" id="mobile_error" ></span></label>
                  <input type="text" name="mobile" placeholder="Enter Mobile Number">

                  <button id="btnRegistration" type="submit" class="aa-browse-btn" style="margin-bottom: 12px;">Register</button>                    
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