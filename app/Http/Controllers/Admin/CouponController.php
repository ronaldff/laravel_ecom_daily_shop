<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $page_data['title'] = "admin coupon";
        $page_data['coupons'] = Coupon::orderBy('id', 'DESC')->get();
        return view('admin.coupon', $page_data);
    }

    /**
     * Show the form for creating a new resource. and editing
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_coupon($id = '', Request $request)
    {
        if($id > 0){
            $result = Coupon::where(["id" => $id])->first()->toArray();
            $page_data['title'] = "edit coupon";
            $page_data['coupon_title'] = $result['title'];
            $page_data['code'] = $result['code'];
            $page_data['value'] = $result['value'];
            $page_data['coupon_type'] = $result['coupon_type'];
            $page_data['coupon_min_value'] = $result['coupon_min_value'];
            $page_data['expire_date'] = $result['expire_date'];
            $page_data['id'] = $result['id'];
            $page_data['is_one_time'] = $result['is_one_time'];

        } else {
            $page_data['title'] = "add coupon";
            $page_data['coupon_title'] = '';
            $page_data['code'] = '';
            $page_data['value'] = '';
            $page_data['coupon_type'] = '';
            $page_data['coupon_min_value'] = '';
            $page_data['expire_date'] = '';
            $page_data['id'] = '';
            $page_data['is_one_time'] = '';
        }
       
       return view("admin.addcoupon", $page_data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_coupon_process(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'coupon_title' => 'required|unique:coupons,title,'.$request->post('coupon_id'),
            'coupon_code' => 'required|unique:coupons,code,'.$request->post('coupon_id'),
            'coupon_value' => 'required',
            'coupon_type' => 'required',
            'coupon_min_value' => 'required',
            'expire_date' => 'required',
        ]);

        if($request->post('coupon_id') > 0) {
            if ($validator->fails()) {
                return redirect()->route('editCoupon', ['id' => $request->post('coupon_id')])
                ->withErrors($validator)
                ->withInput();
            } else {
                $data = Coupon::find($request->post('coupon_id'));
                $data->title = $request->post("coupon_title");
                $data->code = $request->post("coupon_code");
                $data->value = $request->post("coupon_value");
                $data->coupon_type = $request->post("coupon_type");
                $data->coupon_min_value = $request->post("coupon_min_value");
                $data->expire_date = $request->post("expire_date");
                $data->is_one_time = $request->post("is_one_time");
    
                $data_validate = $data->save();
                if($data_validate == 1){
                    $request->session()->flash('success', "Coupon updated successfully");
                    return redirect()->route('admin_coupon');
                } else {
                    $request->session()->flash('error', "Coupon not updated successfully");
                    return redirect()->route('admin_coupon');
                }
            }
        } else {
            if ($validator->fails()) {
                return redirect()->route('add_coupon')
                ->withErrors($validator)
                ->withInput();
            } else {
                $data = new Coupon();
                $data->title = $request->post("coupon_title");
                $data->code = $request->post("coupon_code");
                $data->value = $request->post("coupon_value");
                $data->coupon_type = $request->post("coupon_type");
                $data->coupon_min_value = $request->post("coupon_min_value");
                $data->expire_date = $request->post("expire_date");
                $data->is_one_time = $request->post("is_one_time");
    
                $data_validate = $data->save();
                if($data_validate == 1){
                    $request->session()->flash('success', "Coupon created successfully");
                    return redirect()->route('admin_coupon');
                } else {
                    $request->session()->flash('error', "Coupon not created successfully");
                    return redirect()->route('admin_coupon');
                }
            }
        }
       
    }


    /**
     * Change Status of Coupon.
     *
     * @param  \App\Models\Admin\Coupon  $Coupon
     * @return \Illuminate\Http\Response
     */
    public function change_coupon_status(Request $request ){
      
        $coupon_status = $request->post('coupon_status');
        $coupon_id  = $request->post('coupon_id');
        $data = array('status'=>$coupon_status);
        $result = DB::table('coupons')->where('id',$coupon_id)->update($data);
        if($result == 1){
            return Response::json(array(
                'result' => 'success',
                'data'   => 'Coupon Status Updated'
            )); 
        } else {
            return Response::json(array(
                'result' => 'error',
                'data'   => 'Coupon Status Not Updated'
            )); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $coupon_id  = $request->post('coupon_id');
        $result=Coupon::where('id',$coupon_id)->delete();
        if($result == 1){
            return Response::json(array(
                'result' => 'success',
                'data'   => 'Coupon Deleted Successfully'
            )); 
        } else {
            return Response::json(array(
                'result' => 'error',
                'data'   => 'Something Went Wrong'
            )); 
        }

    }
}
