/** 
  * Template Name: Daily Shop
  * Version: 1.0  
  * Template Scripts
  * Author: PIYUSH SHYAM
  * Author URI: https://piyush-shyam-portfolio.herokuapp.com/

  File Name : Custom JS
**/

// import { result } from "lodash";

jQuery(function($){


  /* ----------------------------------------------------------- */
  /*  1. CARTBOX 
  /* ----------------------------------------------------------- */
    
     jQuery(".aa-cartbox").hover(function(){
      jQuery(this).find(".aa-cartbox-summary").fadeIn(500);
    }
      ,function(){
          jQuery(this).find(".aa-cartbox-summary").fadeOut(500);
      }
     );   
  
  /* ----------------------------------------------------------- */
  /*  2. TOOLTIP
  /* ----------------------------------------------------------- */    
    jQuery('[data-toggle="tooltip"]').tooltip();
    jQuery('[data-toggle2="tooltip"]').tooltip();

  /* ----------------------------------------------------------- */
  /*  3. PRODUCT VIEW SLIDER 
  /* ----------------------------------------------------------- */    

    jQuery('#demo-1 .simpleLens-thumbnails-container img').simpleGallery({
        loading_image: 'demo/images/loading.gif'
    });

    jQuery('#demo-1 .simpleLens-big-image').simpleLens({
        loading_image: 'demo/images/loading.gif'
    });

  /* ----------------------------------------------------------- */
  /*  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-popular-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    }); 

  
  /* ----------------------------------------------------------- */
  /*  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-featured-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });
    
  /* ----------------------------------------------------------- */
  /*  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      
    jQuery('.aa-latest-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */     
    
    jQuery('.aa-testimonial-slider').slick({
      dots: true,
      infinite: true,
      arrows: false,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true
    });

  /* ----------------------------------------------------------- */
  /*  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */  

    jQuery('.aa-client-brand-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  9. PRICE SLIDER  (noUiSlider SLIDER)
  /* ----------------------------------------------------------- */        

    jQuery(function(){
      if($('body').is('.productPage')){
       var skipSlider = document.getElementById('skipstep');
       let range_start = $("#range_start").val();
       let range_end = $("#range_end").val();

       if(range_start){
        range_start = range_start;
       } else {
        range_start = 100;
       }

       if(range_end){
        range_end = range_end;
       } else {
        range_end = 5000;
       }

        noUiSlider.create(skipSlider, {
            range: {
                'min': 0,
                '10%': 1000,
                '20%': 2000,
                '30%': 3000,
                '40%': 4000,
                '50%': 5000,
                '60%': 6000,
                '70%': 7000,
                '80%': 10000,
                '90%': 20000,
                'max': 25000
            },
            snap: true,
            connect: true,
            start: [range_start, range_end]
        });
        // for value print
        var skipValues = [
          document.getElementById('skip-value-lower'),
          document.getElementById('skip-value-upper')
        ];

        skipSlider.noUiSlider.on('update', function( values, handle ) {
          skipValues[handle].innerHTML = values[handle];
        });
      }
    });


    
  /* ----------------------------------------------------------- */
  /*  10. SCROLL TOP BUTTON
  /* ----------------------------------------------------------- */

  //Check to see if the window is top if not then display button

    jQuery(window).scroll(function(){
      if ($(this).scrollTop() > 300) {
        $('.scrollToTop').fadeIn();
      } else {
        $('.scrollToTop').fadeOut();
      }
    });
     
    //Click event to scroll to top

    jQuery('.scrollToTop').click(function(){
      $('html, body').animate({scrollTop : 0},800);
      return false;
    });
  
  /* ----------------------------------------------------------- */
  /*  11. PRELOADER
  /* ----------------------------------------------------------- */

    jQuery(window).load(function() { // makes sure the whole site is loaded      
      jQuery('#wpf-loader-two').delay(100).fadeOut('slow'); // will fade out      
    })

  /* ----------------------------------------------------------- */
  /*  12. GRID AND LIST LAYOUT CHANGER 
  /* ----------------------------------------------------------- */

  jQuery("#list-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").addClass("list");
  });
  jQuery("#grid-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").removeClass("list");
  });


  /* ----------------------------------------------------------- */
  /*  13. RELATED ITEM SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-related-item-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    }); 
    
});

 /* ----------------------------------------------------------- */
  /*  14. CHANGE PRODUCT COLOR IMAGE
  /* ----------------------------------------------------------- */ 

function change_product_color_image(img_src,color){
  $(".simpleLens-big-image-container").html(`<a data-lens-image="${img_src}" class="simpleLens-lens-image"><img src="${img_src}" class="simpleLens-big-image"></a>`);
  $(".color_link").css('border','0px','!important');
  $(`#color_${color}`).css('border','2px solid black','!important');
  $("#color_id").val(color);
}

 /* ----------------------------------------------------------- */
  /*  15. SHOW COLOR WISE SIZES
  /* ----------------------------------------------------------- */
function showColor(size)
{
  $("#size_id").val(size);
  $(".product_color").hide();
  $(`.size_${size}`).show();
  $(".size_link").css('border','0px','!important')
  $(`#size_${size}`).css('border','2px solid black','!important');
}

 /* ----------------------------------------------------------- */
  /*  16. ADD PRODUCT IN THE CART
  /* ----------------------------------------------------------- */
function add_to_cart(pid,size_str_id,color_str_id,qty = ''){
  let routes = $("#routes").val();
  $("#add_to_cart_msg").html("");
  let color_id = $("#color_id").val();
  let size_id = $("#size_id").val();

  if(size_str_id == 0 && color_str_id == 0){
    color_str_id = 'no';
    size_str_id = 'no';
  } 

  if(size_id == '' && size_str_id != 'no' && size_str_id != 0){
    $("#add_to_cart_msg").html(`<p class="mt-5 text-danger">please select size</p>`);
  } else if(color_id == '' && color_str_id != 'no' && color_str_id != 0){
    $("#add_to_cart_msg").html(`<p class="mt-5 text-danger">please select color</p>`);
  } else {

    $("#product_id").val(pid);

    if(qty === ''){
      $("#qty").val($("#quantity").val());
    } else if(qty === 0) {
      $("#qty").val(qty);
    } else if(qty > 0) {
      $("#qty").val(qty);
    } else {
      $("#qty").val($("#quantity").val());
    }

    let output = '';
    $.ajax({
      type:'POST',
      url:"/add_to_cart",
      data: $("#frmAddToCart").serialize(),
      success:function(data) {
        let results = data;
        
        if(results.result.length > 0){
          let total = 0;
          output += `<a class="aa-cart-link" href="/cart"><span class="fa fa-shopping-basket"></span><span class="aa-cart-title">SHOPPING CART</span><span class="aa-cart-notify">${results.result.length}</span></a><div class="aa-cartbox-summary"><ul>`;
          results.result.forEach(list => {
            total += list.qty * list.price;
            
            output +=`  
              <li>
                <a class="aa-cartbox-img" href="/product/${list.slug}"><img src="${routes}pro_img/${list.image}" alt="${list.image}"></a>
                <div class="aa-cartbox-info">
                  <h4><a href="/product/${list.slug}">${list.product_name}</a></h4>
                  <p>${list.qty} x ₹${list.price}</p>
                </div>
                <a class="aa-remove-product" onclick="deleteCartProduct('${list.cart_id}','${list.product_id}','${list.size}','${list.color}')"  href="javascript:void(0)"><span class="fa fa-times"></span></a>
              </li>
            `;
          });

          output += `<li>
            <span class="aa-cartbox-total-title">
              Total
            </span>
            <span class="aa-cartbox-total-price">
              ₹${total}
            </span>
          </li>
          </ul> 
          <a class="aa-cartbox-checkout aa-primary-btn" href="/cart">Cart</a></div>`;
          $("#box_cart_dynamic").html(output);
          $(".table-responsive").load(location.href + " .table-responsive");
          $(".aa-order-summary-area").load(location.href + '.aa-order-summary-area');
        } else {
          $(".aa-cart-notify").text(results.result.length);
          $(".aa-cartbox-summary").remove();
          if(results.result.length == 0){
            $("#cart_form").remove();
            $("#new_cart_id").html(`<h2>Cart Is Empty</h2>`); 
          }
        }
        showAlertBox(results.msg);
        $("html, body").animate({ scrollTop: 0 }, 800);
        // alert(results.msg);
      }
  });

  }
  
}

 /* ----------------------------------------------------------- */
  /*  17. UPDATE PRODUCT QTY IN THE CART 
  /* ----------------------------------------------------------- */
function updateQty(pid,size,color,pattr_id,price){
  $("#product_id").val(pid);
  let qty = $(`#qty${pattr_id}`).val();
  $("#size_id").val(size);
  $("#color_id").val(color);
  $("#qty").val(qty);
  $(`#total_price_${pattr_id}`).html(`₹${qty * price}`);
  add_to_cart(pid,size,color,qty);
}

 /* ----------------------------------------------------------- */
  /*  18. DELETE PRODUCT FROM THE CART 
  /* ----------------------------------------------------------- */
function deleteCartProduct(cart_id,pid,size,color)
{
  $("#product_id").val(pid);
  let qty = 0;
  $("#size_id").val(size);
  $("#color_id").val(color);
  $("#qty").val(qty);
  add_to_cart(pid,size,color,qty);
  $(`#cart_${cart_id}`).remove();
}

/* ----------------------------------------------------------- */
  /*  19. Sort 
  /* ----------------------------------------------------------- */

function sortBy(data)
{
  let sortBy = $(data).val();
  $("#sort_by_value").val(sortBy);
  $("#categoryFilter").submit();
}

/* ----------------------------------------------------------- */
  /*  20. Sort  By Price
  /* ----------------------------------------------------------- */

function sortPriceFilter()
{
  let start = $("#skip-value-lower").html();
  let end = $("#skip-value-upper").html();

  start = Math.round(Number(start));
  end = Math.round(Number(end));

  $("#filter_price_start").val(start);
  $("#filter_price_end").val(end);

  $("#categoryFilter").submit();

}

/* ----------------------------------------------------------- */
  /*  21. Sort  By Color
  /* ----------------------------------------------------------- */

function filterColor(id,type)
{
  let getFormInputColor  = $("#filterData").val();
  if(type == '1'){
    $new_FormInputColor = getFormInputColor.replace(`${id}:`,'');
    $("#filterData").val(`${$new_FormInputColor}`);
    $("#categoryFilter").submit();
  } else {
    $("#filterData").val(`${id}:${getFormInputColor}`);
    $("#categoryFilter").submit();
  }
}

/* ----------------------------------------------------------- */
  /*  22. Search The Product
  /* ----------------------------------------------------------- */
function searchProduct()
{
  let searchText = $("#search").val();
  if(searchText != ''){
    if(searchText.length >= 3){
      window.location.href = `/search/${searchText}`;

    }
  }
}

/* ----------------------------------------------------------- */
  /*  23. Customer Registration Form and Send Emai Verify Link
  /* ----------------------------------------------------------- */

$("#frmRegistration").submit((e) => {
  e.preventDefault();
  $(".fields_error").html('');
  $("#thank_you").html('');
  $.ajax({
    url : "registartion_process",
    type : "POST",
    data : $("#frmRegistration").serialize(),
    success : function(res){
      if(res.status == 'error'){
        $.each(res.error, (key,val) => {
          $(`#${key}_error`).html(val[0]);
        })
      }

      if(res.status == 'success'){
        $(`#thank_you`).html(`${res.msg} 😃`);
        setTimeout(() => {
          $(`#thank_you`).html('');
        },3000);
        $("#frmRegistration")[0].reset();
      }
    }
  })
 
})

/* ----------------------------------------------------------- */
  /*  24. Login 
  /* ----------------------------------------------------------- */

$("#loginForm").submit((e) => {
  e.preventDefault();
  $("#log_error").html('');
  $.ajax({
    url : "/login_process",
    type : "POST",
    data : $("#loginForm").serialize(),
    success : function(res){
      if(res.status == 'error'){
        $("#log_error").html(res.msg);
        setTimeout(() => {
          $(`#log_error`).html('');
        },3000);
        
      }

      if(res.status == 'success'){
        window.location.href = window.location.href ;
      }
    }
  })
 
})

/* ----------------------------------------------------------- */
  /*  25. Show Forget Password Form 
  /* ----------------------------------------------------------- */
function showForgetPasswordForm()
{
  $("#forget_form").show();
  $("#login_form").hide();
}

/* ----------------------------------------------------------- */
  /*  26. Show Login Form 
  /* ----------------------------------------------------------- */
function showLoginForm()
{
  $("#forget_form").hide();
  $("#login_form").show();
}

/* ----------------------------------------------------------- */
  /*  27. Show Form And Send Forget Password Link 
  /* ----------------------------------------------------------- */
$("#forgetForm").submit((e) => {
  e.preventDefault();
  $("#forget_error").html('');
  $("#forget_error").html('Please Wait... 😃');
  $.ajax({
    url : "/forgot_password",
    type : "POST",
    data : $("#forgetForm").serialize(),
    success : function(res){
      
      if(res.status == 'error'){
        $("#forget_error").html(res.msg);
        setTimeout(() => {
          $(`#forget_error`).html('');
        },3000);
      }

      if(res.status == 'success'){
        $("#forget_error").html(res.msg);
        setTimeout(() => {
          $(`#forget_error`).html('');
          window.location.href = window.location.href ;
        },3000);
      }
    }
  })
 
})


/* ----------------------------------------------------------- */
  /*  28. New Password Form 
  /* ----------------------------------------------------------- */
$("#frmNewPassword").submit((e) => {
  e.preventDefault();
  $("#forget_error").html('');
  $.ajax({
    url : "/new_password",
    type : "POST",
    data : $("#frmNewPassword").serialize(),
    success : function(res){
      if(res.status == 'error'){
        $("#forget_error").html(res.msg);
        setTimeout(() => {
          $(`#forget_error`).html('');
        },3000);
      }

      if(res.status == 'success'){
        $("#forget_error").html(res.msg);
        setTimeout(() => {
          $(`#forget_error`).html('');
          window.location.href = window.location.href;
        },2000);
      }
    }
  })
 
})




/* ----------------------------------------------------------- */
  /*  29. Alerts
  /* ----------------------------------------------------------- */
const alertBox=document.querySelector(".alert-box");
const closeBtn=document.querySelector("#close-alert");
let timer;
  
function showAlertBox(msg){

  alertBox.classList.remove("hide");
  alertBox.classList.add("show");
  $("#message_data").html(`${msg}`);
  // hide animation onload 
  if(alertBox.classList.contains("hidden")){
      alertBox.classList.remove("hidden");
  }
  timer=setTimeout(function(){
      hideAlertBox();
  },6000)
}
  
function hideAlertBox(){
  alertBox.classList.remove("show");
  alertBox.classList.add("hide");
}



/* ----------------------------------------------------------- */
  /*  30. coupon code integration 
  /* ----------------------------------------------------------- */
function getCouponCode()
{
  $("#placed_msg").html("");
  $("#coupon_error_msg").html('');
  $("#coupon_success_msg").html('');
  let cart_actual_val = $("#actual_cart_val").val();

  let coupon_code = $("#coupon_code").val();
  let _token = $("input[name='_token']").val();


  if(coupon_code != ''){
    let data = {coupon_code, _token};

    $.ajax({
      url : '/coupon_code',
      type : 'POST',
      data : data,
      success : (res) => {
        console.log(res);
        
        if(res.status == 'error')
        {
          $("#coupon_error_msg").html(res.msg);
          $(".show_coupon_box").addClass('hide');
          $("#coupon_code_str").html('');
          $("#total_price").html(`INR${cart_actual_val}`);

        } else {
          $("#coupon_success_msg").html(res.msg);
          $(".show_coupon_box").removeClass('hide');
          $("#coupon_code_str").html(coupon_code);
          $("#coupon_code_val").html(res.coupon_val);
          $("#coupon_code_type").html(res.coupon_type);
          $("#total_price").html(`INR${res.result}`);
          $(".aa-coupon-code").addClass('hide');
          $(".aa-browse-btns").addClass('hide');

        }
      }
    });
  } else {
    $("#coupon_error_msg").html('Please insert the coupon code');
  }

}

function remove_coupon_code()
{
  $("#coupon_success_msg").html('');
  let cart_actual_val = $("#actual_cart_val").val();
  $(".show_coupon_box").addClass('hide');
  $("#total_price").html(`INR${cart_actual_val}`);
  $(".aa-coupon-code").removeClass('hide');
  $(".aa-coupon-code").val('');
  $(".aa-browse-btns").removeClass('hide');
}


$("#frmPlaceOrder").submit((e) => {
  e.preventDefault();
  $("#placed_msg").html("");
  $("#placed_msg").html("please wait...");
  $.ajax({
    url:'/placeorder',
    type : 'POST',
    data : $("#frmPlaceOrder").serialize(),
    success : (res) => {
      if(res.status == 'error')
      {
        $("#placed_msg").html(res.msg);
      } else if(res.status == 'success') {
        $("#placed_msg").html(res.msg);
        if(res.payment_url != '' ){
          window.location.href = res.payment_url;
        } else {
          setTimeout(() => {
            window.location.href = '/order_placed';
          },2000);
        }
        
      }
    }
  })
})

function print_page()
{
  window.print();
  return false;
}
