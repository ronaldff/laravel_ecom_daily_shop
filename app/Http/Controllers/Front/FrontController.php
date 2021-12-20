<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Admin\Customer;
use App\Events\CustomerEmailVerification;
use App\Events\SendForgetLink;
use App\Http\Traits\ColorsTrait;
use App\Http\Traits\CategoriesTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Response;
use DB;
use Cookie;
use Mail;

class FrontController extends Controller
{
    use ColorsTrait;
    use CategoriesTrait;
   
    public function index(Request $request)
    {
        $result['home_categories'] = DB::table('categories')->where(['status' => 1, 'is_home'=>1])->get();

        $result['home_brands'] = DB::table('brands')->where(['status' => 1])->get();

        $result['home_banner'] = DB::table('banners')->get();

        foreach($result['home_categories'] as $list){
            $result['home_categories_product'][$list->id] = 
                DB::table('products')
                    ->where(['status' => 1])
                    ->where(['category_id' => $list->id])
                    ->get();
            foreach ($result['home_categories_product'][$list->id] as $key => $list1) {
                $result['home_product_attr'][$list1->id] = 
                    DB::table('product_attrs')
                        ->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
                        ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
                        ->where(['product_attrs.products_id' => $list1->id])
                        ->get();
            }
            
        }

        $result['home_featured_product'] = 
        DB::table('products')
            ->where(['status' => 1])
            ->where(['is_featured' => 1])
            ->get();

        foreach ($result['home_featured_product'] as $key => $list1) {
            $result['home_featured_product_attr'][$list1->id] = 
                DB::table('product_attrs')
                    ->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
                    ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
                    ->where(['product_attrs.products_id' => $list1->id])
                    ->get();
        }

        $result['home_tranding_product'] = 
        DB::table('products')
            ->where(['status' => 1])
            ->where(['is_tranding' => 1])
            ->get();

        foreach ($result['home_tranding_product'] as $key => $list1) {
            $result['home_tranding_product_attr'][$list1->id] = 
                DB::table('product_attrs')
                    ->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
                    ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
                    ->where(['product_attrs.products_id' => $list1->id])
                    ->get();
        }

        $result['home_discounted_product'] = 
        DB::table('products')
            ->where(['status' => 1])
            ->where(['is_discounted' => 1])
            ->get();

        foreach ($result['home_discounted_product'] as $key => $list1) {
            $result['home_discounted_product_attr'][$list1->id] = 
                DB::table('product_attrs')
                    ->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
                    ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
                    ->where(['product_attrs.products_id' => $list1->id])
                    ->get();
        }

        return view('front.index', $result);
    }

    public function registration(Request $request)
    {
        if($request->session()->has('FRONT_USER_VAL')){
            return redirect('/');
        }
        $result = [];
        return view('front.registration',$result);
    }

    public function registartion_process(Request $request)
    {
       
        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required',
            'mobile' => 'required|numeric|digits:10'

        ]);

        if(!$validate->passes()){
            return Response::json(array(
                'status' => 'error',
                'error' => $validate->errors()->toArray()
            ));
        } else {
            $rand_num = rand(111111111,999999999);
            $customer = new Customer();
            $customer->name = $request->post('name');
            $customer->email = $request->post('email');
            $customer->password = Hash::make($request->post('password'));
            $customer->mobile = $request->post('mobile');
            $customer->rand_num = $rand_num;

            if(!$customer->save()){
                return Response::json(array(
                    'status' => 'error',
                    'msg' => 'Something Went Wrong...'
                ));
            } else {
                event(new CustomerEmailVerification($request->post('email'),$request->post('name'),$rand_num));
                return Response::json(array(
                    'status' => 'success',
                    'msg' => "Registered Successfully. please check your Email Id for verification."
                ));
            }

            
        }
    }

    public function forgot_password(Request $request)
    {
        $status = '';
        $msg = '';

        $check_data = DB::table("customers")->where([
            'email' => $request->post('str_forget_email'),
            ])->get(); 

        if(isset($check_data[0])){
            
            $rand_forget_id = rand(111111111,999999999);
            $data = array(
                'is_forget_password' => 1,
                'rand_forget_id' => $rand_forget_id
            );

            if(DB::table('customers')->where(['id' => $check_data[0]->id])->update($data)){
                event(new SendForgetLink($request->post('str_forget_email'),$check_data[0]->name,$rand_forget_id));

                $status = 'success';
                $msg = 'please check your Email Id for forget password';
            } else {
                $status = 'error';
                $msg = 'Something went wrong...';
            }
           
        } else {
            $status = 'error';
            $msg = 'Email Id Not Registered With Us...';
        }

        return Response::json(array(
            'status' => $status,
            'msg' => $msg
        ));
    }

    public function login_process(Request $request)
    {
        
        $status = '';
        $msg = '';
        $check_data = DB::table("customers")->where([
           'email' => $request->post('str_login_email'),
           ])->get(); 

        if(isset($check_data[0])){

            $db_status = $check_data[0]->status;
            $db_is_verify = $check_data[0]->is_verify;
            
            if($db_is_verify == 0){
                $status = 'error';
                $msg = 'Please verify your email id';
            } else if($db_status == 0){
                $status = 'error';
                $msg = 'your account has been deactivated';
            } else {
                if (Hash::check($request->post('str_login_password'), $check_data[0]->password)) {

                    if($request->post('rememberme') !== 'on'){
                        Cookie::queue(Cookie::forget('xx1_df_java_xsrf'));
                        Cookie::queue(Cookie::forget('xx2_df_java_xsrf'));
                    } else {
                        $lifetime = time() + 60 * 60 * 24 * 365; // 1 year
                        Cookie::queue(Cookie::make('xx1_df_java_xsrf', $request->post('str_login_email'), $lifetime)); 
                        Cookie::queue(Cookie::make('xx2_df_java_xsrf', $request->post('str_login_password'), $lifetime)); 
                    }
                    
                    $request->session()->put('FRONT_USER_VAL',true);
                    $request->session()->put('FRONT_USER_LOGIN',$check_data[0]->id);
                    $request->session()->put('FRONT_USER_NAME',$check_data[0]->name);
    
                    $status = 'success';
                    $msg = 'login successfully';
                    
                } else {
                    $status = 'error';
                    $msg = 'Please Check The Credentials';
                }
            }

        } else {
            $status = 'error';
            $msg = 'Please Check The Credentials';
        }

        return Response::json(array(
            'status' => $status,
            'msg' => $msg
        ));
        
    }

    public function verification(Request $request,$id)
    {
        $check_data = DB::table("customers")->where([
            'rand_num' => $id,
            ])->get();

        if(isset($check_data[0])){
            $data = array('is_verify'=>1,'rand_num'=>'');
            DB::table("customers")->where([
                'id' =>$check_data[0]->id,
                ])->update($data);
                return view('front.success_verification');
        } else {
            return redirect('/');
        }
    }

    public function forgot_new_password(Request $request,$id)
    {
        $data['id'] = '';
        $check_data = DB::table("customers")->where([
            'rand_forget_id' => $id,
            'is_forget_password'=>1
            ])->get();

        if(isset($check_data[0])){
            $data['id'] = $check_data[0]->id;
            return view('front.forget_password_change',$data);
        } else {
            return redirect('/');
        }
        
    }

    public function new_password(Request $request)
    {
        $status = '';
        $msg = '';

        $check_data = DB::table("customers")->where([
            'id' => $request->post('id'),
            ])->get();
        if(isset($check_data[0])){
            
            if((Cookie::get('xx2_df_java_xsrf') != '') &&  (Cookie::get('xx1_df_java_xsrf') != '')){
                $lifetime = time() + 60 * 60 * 24 * 365; // 1 year
                Cookie::queue(Cookie::make('xx1_df_java_xsrf', $check_data[0]->email, $lifetime)); 
                Cookie::queue(Cookie::make('xx2_df_java_xsrf', $request->post('new_password'), $lifetime)); 
            }
            $data = array(
                'is_forget_password' => 0,
                'rand_forget_id'=>'',
                'password'=>Hash::make($request->post('new_password'))
            );

            DB::table("customers")->where([
                'id' =>$check_data[0]->id,
                ])->update($data);

            $status = "success";
            $msg = "New Password Generated Please login...";

        } else {
            $status = "error";
            $msg = "No data found";
        }

        return Response::json(array(
            'status' => $status,
            'msg' => $msg
        ));

    }

    public function logout(Request $request)
    {
        $request->session()->forget('FRONT_USER_VAL');
        $request->session()->forget('FRONT_USER_LOGIN');
        $request->session()->forget('FRONT_USER_NAME');

        return redirect('/');
    }

    public function category(Request $request, $slug)
    {
        $sort = "";
        $get_colors  =  "";
        $colorArr = [];
        $cat_name="";
        if($request->get('sort_by_value') !== null){
            $sort = $request->get('sort_by_value');
        }

        $cat_name = $slug;

        

        $query = DB::table('products');
        $query = $query->leftJoin('categories', 'categories.id', '=', 'products.category_id');
        $query = $query->leftJoin('product_attrs', 'product_attrs.products_id', '=', 'products.id');
        $query = $query->select('products.*','categories.category_name','categories.category_slug','product_attrs.id as product_attr_id','product_attrs.mrp','product_attrs.price','product_attrs.id');
        $query = $query->where(['products.status' => 1]);
        $query = $query->where(['categories.category_slug' => $slug]);
        if($sort === 'name'){
            $query = $query->orderBy('products.product_name','desc');
        }

        if($sort === 'date'){
            $query = $query->orderBy('products.id','desc');
        }

        if($sort === 'price_desc'){
            $query = $query->orderBy('product_attrs.price','desc');
        }

        if($request->get('filter_price_start') !== null && $request->get('filter_price_end') !== null){
            $filter_price_start = $request->get('filter_price_start');
            $filter_price_end = $request->get('filter_price_end');

            $query = $query->whereBetween('product_attrs.price',[$filter_price_start, $filter_price_end]);
        }

        if($sort === 'price_asc'){
            $query = $query->orderBy('product_attrs.price','asc');
        }

        if($request->get('filter_color') !== null ){
            $getFormColorData  = $request->get('filter_color');
            $getFormColorData = explode(':',$getFormColorData);
            $getFormColorData = array_filter($getFormColorData);

            $query = $query->where(['product_attrs.color_id' => $request->get('filter_color')]);

            $get_colors = $request->get('filter_color');
            $colorArr = $getFormColorData;
        }

        $query = $query->get();

        $result['products'] = $query;
        $result['banner_txt'] = $slug;
        $result['colors'] = $this->getColors();
        $result['categories'] = $this->getCategories();
        $result['get_colors'] = $get_colors;
        $result['colorArry'] = $colorArr;
        $result['slug_val'] = $cat_name;
        
        return view('front.category',$result);
    }

    public function search(Request $request, $text)
    {
        $query = DB::table('products');
        $query = $query->leftJoin('categories', 'categories.id', '=', 'products.category_id');
        $query = $query->leftJoin('product_attrs', 'product_attrs.products_id', '=', 'products.id');
        $query = $query->select('products.*','categories.category_name','categories.category_slug','product_attrs.id as product_attr_id','product_attrs.mrp','product_attrs.price','product_attrs.id');
        $query = $query->where(['products.status' => 1]);
        $query = $query->where('products.product_name','like',"%$text%");
        $query = $query->orwhere('products.brand','like',"%$text%");
        $query = $query->orwhere('products.model','like',"%$text%");
        $query = $query->orwhere('products.short_desc','like',"%$text%");
        $query = $query->orwhere('products.desc','like',"%$text%");
        $query = $query->orwhere('products.keywords','like',"%$text%");
        $query = $query->orwhere('products.technical_specification','like',"%$text%");
        $query = $query->orwhere('products.warranty','like',"%$text%");
        $query = $query->get();

        $result['products'] = $query;
        $result['banner_txt'] = $text;
        return view ('front.search',$result);

    }


    public function product(Request $request, $slug)
    {
        $result['product'] = 
        DB::table('products')
            ->Join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.*','categories.category_name','categories.category_slug')
            ->where(['products.status' => 1])
            ->where(['products.slug' => $slug])
            ->get();


        if(isset($result['product'][0])){
            foreach ($result['product'] as $key => $list1) {
                $result['product_attr'][$list1->id] = 
                    DB::table('product_attrs')
                        ->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
                        ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
                        ->where(['product_attrs.products_id' => $list1->id])
                        ->get();
            }

            $result['related_product'] = DB::table('products')
            ->where(['status' => 1])
            ->where(['category_id' => $result['product'][0]->category_id])
            ->where('id', '!=', $result['product'][0]->id)
            ->get();

            foreach ($result['related_product'] as $key => $list2) {
                $result['product_related_attr'][$list2->id] = 
                    DB::table('product_attrs')
                        ->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
                        ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
                        ->where(['product_attrs.products_id' => $list2->id])
                        ->get();
            }

            foreach ($result['product'] as $key => $list1) {
                $result['product_images'][$list1->id] = 
                    DB::table('productmulti_images')
                        ->where(['productmulti_images.products_id' => $list1->id])
                        ->get();
            }

            $result['banner_txt'] = $slug;
            return view('front.product', $result);
        } else {
            return redirect()->route('home');
        }

       
    }


    public function add_to_cart(Request $request)
    {
        if($request->session()->has("FRONT_USER_LOGIN")){
            $user_id = $request->session()->get("FRONT_USER_LOGIN");
            $user_type = "Reg";
        } else {
            $user_id = getUserTempId();
            $user_type = "Not-Reg";
        }

        $size_id = $request->post("size_id");
        $color_id = $request->post("color_id");

        if($size_id == 'null'){
            $size_id = null;

        } else {
            $size_id = $size_id;
        }

        if($color_id == 'null'){
            $color_id = null;

        } else {
            $color_id = $color_id;
        }
        $product_id = $request->post("product_id");
        $qty = $request->post("qty");
        
        $result= 
        DB::table('product_attrs')
            ->select("product_attrs.id")
            ->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
            ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
            ->where(['product_attrs.products_id' => $product_id])
            ->where(['sizes.size' => $size_id])
            ->where(['colors.color' => $color_id])
            ->get();
        

        $product_attr_id = $result[0]->id;

        $check = DB::table("carts")
                    ->where('user_id', $user_id)
                    ->where('user_type', $user_type)
                    ->where('product_id', $product_id)
                    ->where('product_attr_id', $product_attr_id)
                    ->get();

        if(isset($check[0])){
            if($qty == 0){
                $cart_id = $request->post("cart_id");
                DB::table("carts")->where('product_id',$product_id)->delete();
                $msg = "Product Deleted From Cart";
            } else {
                $update_id = $check[0]->id;
                DB::table("carts")
                    ->where('id',$update_id)
                    ->update(['qty' => $qty, 'updated_at' => date('Y-m-d h:i:s')]);
                
                $msg = "Cart Updated Successfully";
            }
                
        } else {
            $id = DB::table("carts")->insertGetId(
                [
                    'user_id' => $user_id,
                    'user_type' => $user_type,
                    'product_id' => $product_id,
                    'product_attr_id' => $product_attr_id,
                    'qty' => $qty,
                    'updated_at' => date('Y-m-d h:i:s')
                ]
            );

            $msg = "Cart Added Successfully";
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

        return Response::json(array(
            'msg' => $msg,
            'result' => $result
        )); 


    }

    public function cart(Request $request)
    {
        if($request->session()->has("FRONT_USER_LOGIN")){
            $user_id = $request->session()->get("FRONT_USER_LOGIN");
            $user_type = "Reg";
        } else {
            $user_id = getUserTempId();
            $user_type = "Not-Reg";
        }

        $result['lists'] = DB::table("carts")
        ->select("carts.qty","carts.id as cart_id","products.product_name","products.slug","product_attrs.price","product_attrs.mrp","products.image","carts.product_id","carts.product_attr_id","colors.id as color_id","colors.color","sizes.id as size_id","sizes.size")
        ->leftJoin('product_attrs', 'product_attrs.id', '=', 'carts.product_attr_id')
        ->leftJoin('products', 'products.id', '=', 'carts.product_id')
        ->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
        ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
        ->where('user_id', $user_id)
        ->where('user_type', $user_type)
        ->get()->toArray();
        return view('front.cart', $result);
    }

    public function checkout(Request $request)
    {
        echo 'checkout page';
    }


}
