<?php
  use Illuminate\Support\Facades\DB;
  // print array data format
  if(!function_exists('prx')){
    function prx($result){
      echo "<pre>";
      print_r($result);

      echo "</pre>";

      die();

    }
  }

  // print array data format
  if(!function_exists('getTopNavCat')){
    function getTopNavCat(){
      $result['home_categories'] = DB::table('categories')->where(['status' => 1])->get();
      $arr=[];
      foreach($result['home_categories'] as $row){
        $arr[$row->id]['category_name']=$row->category_name;
        $arr[$row->id]['parent_category_id']=$row->parent_category_id;
        $arr[$row->id]['category_slug']=$row->category_slug;
      }
      $str = buildTreeView($arr, 0);
      return $str;
    }
  }

  if(!function_exists('buildTreeView')){
    $html = '';
    function buildTreeView($arr,$parent,$level=0,$prelevel= -1){
      global $html;
      foreach($arr as $id=>$data){
        if($parent==$data['parent_category_id']){
          if($level>$prelevel){
            if($html==''){
              $html.='<ul class="nav navbar-nav">';
            }else{
              $html.='<ul class="dropdown-menu">';
            }
            
          }
          if($level==$prelevel){
            $html.='</li>';
          }
          $route = url('/');
          $html.='<li>
          <a href="'.$route.'/category/'.$data['category_slug'].'">'.$data['category_name'].'<span></span></a>';
          if($level>$prelevel){
            $prelevel=$level;
          }
          $level++;
          buildTreeView($arr,$id,$level,$prelevel);
          $level--;
        }
      }
      if($level==$prelevel){
        $html.='</li></ul>';
      }
      
      return $html;
    }

  }


  if(!function_exists('getUserTempId')){
    function getUserTempId(){
      
      if(session()->has("USER_TEMP_ID") == ''){
        $rand = rand(111111111,999999999);
        session()->put('USER_TEMP_ID',$rand);
        return $rand;
      } else {
        return session()->get("USER_TEMP_ID");
      }
    }
  }

  if(!function_exists('getAddtoCartTotalItems')){
    function getAddtoCartTotalItems(){
      if(session()->has("FRONT_USER_LOGIN")){
        $user_id = session()->get("FRONT_USER_LOGIN");
        $user_type = "Reg";
      } else {
          $user_id = getUserTempId();
          $user_type = "Not-Reg";
      }

      $result = DB::table("carts")
      ->select("carts.qty","carts.id as cart_id","products.product_name","products.slug","product_attrs.price","product_attrs.mrp","products.image","carts.product_id","carts.product_attr_id","colors.id as color_id","colors.color","sizes.id as size_id","sizes.size")
      ->leftJoin('product_attrs', 'product_attrs.id', '=', 'carts.product_attr_id')
      ->leftJoin('products', 'products.id', '=', 'carts.product_id')
      ->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
      ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
      ->where('user_id', $user_id)
      ->where('user_type', $user_type)
      ->get()->toArray();

      return $result;

    }
  }

  if(!function_exists('decrementProductQtyInProductTable')){
    function decrementProductQtyInProductTable($product_id, $cart_qty)
    {
      
      $db_product_data = DB::table('product_attrs')->where(['products_id' => $product_id])->select('qty as db_qty','products_id as db_product_id')->get()->toArray();
     
      if($db_product_data[0]->db_product_id == $product_id){
        if($db_product_data[0]->db_qty - $cart_qty >= 0){
          DB::table('product_attrs')->where(['products_id' => $product_id])->update(['qty' => $db_product_data[0]->db_qty - $cart_qty]);
        }
      }
    }
  }

  if(!function_exists('apply_coupon_code')){
    function apply_coupon_code($coupon_code)
    {
      $status = '';
      $msg = '';
      $coupon_val = '';
      $coupon_type = '';
      $total = 0;
          
      $check = DB::table('coupons')->where(['code'=> $coupon_code])->get()->toArray();
      if(isset($check[0])){
          if($check[0]->status == 1){

              if($check[0]->is_one_time != 1){
                  $coupon_min_val = $check[0]->coupon_min_value;
                  
                  if($coupon_min_val > 0){
                      $getCartDatas = getAddtoCartTotalItems();
                      

                      foreach ($getCartDatas as $key => $getCartData) {
                          $total += $getCartData->price * $getCartData->qty;
                      }

                      if($total > $coupon_min_val){
                          $status = 'success';
                          $msg = 'Coupon code successfully applied';
                          $coupon_val = $check[0]->value;
                          $coupon_type = $check[0]->coupon_type;
                      } else {
                          $status = 'error';
                          $msg = "Cart amount must be greater than $coupon_min_val";
                      }
                  } else {
                      $status = 'success';
                      $msg = 'Coupon code successfully applied';
                      $coupon_val = $check[0]->value;
                      $coupon_type = $check[0]->coupon_type;
                  }
                  
              } else {
                  $status = 'error';
                  $msg = 'Coupon code already used';
              }
              
          } else {
              $status = 'error';
              $msg = 'Coupon code deactivated';
          }
          
      } else {
          $status = 'error';
          $msg = 'Please enter valid coupon code.';
      }

      if($status == 'success')
      {
          if($coupon_type == 'Percent'){
              $newPrice = ($coupon_val/100)*$total;
              $total = round($total - $newPrice);
          }else if($coupon_type == 'Amount'){
              $total = $total - $coupon_val;
          }
      }

      return json_encode(array(
          'status' => $status,
          'msg' => $msg,
          'result' => $total,
          'coupon_val'=>$coupon_val,
          'coupon_type'=>$coupon_type
      ));
    }
  }
 

?>