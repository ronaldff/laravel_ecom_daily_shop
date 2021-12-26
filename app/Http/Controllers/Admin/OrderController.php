<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $page_data['title'] = "admin orders";
        // $page_data['sales'] = Brand::orderBy('id', 'DESC')->get();
        $page_data['orders'] = DB::table('sales')->join('sales_status','sales_status.id','=','sales.order_status')->select('sales.id','sales.sale_code','sales.payment_type','sales.payment_status','sales.grand_total','sales_status.sales_status as order_status','added_on')->orderBy('sales.id','DESC')->get()->toArray();
        
        return view('admin.orders', $page_data);
    }

    public function order_details(Request $request, $id)
    {
        $result['title'] = "Sale Details";
        $result['orders'] = DB::table('sales')->where(['sales.id' => $id])->join('sales_status','sales_status.id','=','sales.order_status')
        ->join('sale_details','sale_details.sale_id','=','sales.id')
        ->join('product_attrs','product_attrs.id','=','sale_details.product_attr_id')
        ->join('products','products.id','=','sale_details.product_id')
        ->leftJoin('coupons','coupons.code','=','sales.coupon_code')
        ->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
        ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
        ->select('sales.id','sales.sale_code','sales.name','sales.email','sales.mobile','sales.address','sales.city','sales.state','sales.zip','sales.txn_id','sales.payment_id','coupons.code as coupon_code','coupons.value as coupon_value','coupons.coupon_type','sales.payment_type','sales.payment_status','sales.grand_total','sales_status.sales_status as order_status','added_on','sale_details.price','sale_details.qty','sizes.size','colors.color','products.product_name','products.image','sale_details.product_id','sale_details.product_attr_id')
        ->get()->toArray();

        

        $result['order_status_data'] = DB::table('sales_status')->get()->toArray();

        $result['payment_status_data'] = ['Pending','Success','Failed'];

        
        if(!empty($result['orders'])){
            return view("admin.orders_details",$result);
        } else {
            return redirect('/admin/order');
        }
    }

    public function update_sales_status(Request $request)
    {
        if($request->post('type') === 'order_status_id'){

            $data = DB::table('sales')->where(['id' => $request->post('sale_id')])->update(['order_status' => $request->post('order_status_id')]);
            
            echo "success";
        } else {
            $data = DB::table('sales')->where(['id' => $request->post('sale_id')])->update(['payment_status' => $request->post('payment_status')]);
            
            echo "success";
        }

    }
}
