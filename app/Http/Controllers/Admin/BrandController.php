<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Response;

class BrandController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $page_data['title'] = "admin brand";
        $page_data['brands'] = Brand::orderBy('id', 'DESC')->get();
        return view('admin.brand', $page_data);
    }

    /**
     * Show the form for creating a new resource. and editing
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_brand($id = '', Request $request)
    {
        if($id > 0){
            $result = Brand::where(["id" => $id])->first()->toArray();
            $page_data['title'] = "edit brand";
            $page_data['brand'] = $result['brand'];
            $page_data['image'] = $result['image'];
            $page_data['brand_id'] = $result['id'];

        } else {
            $page_data['title'] = "add brand";
            $page_data['brand'] = "";
            $page_data['brand_id'] = '';
            $page_data['image'] = "";
        }
       
       return view("admin.addbrand", $page_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_brand_process(Request $request)
    {
       
        if($request->post('brand_id') > 0) {
            $validate_img = 'mimes:jpeg,png,jpg';
        } else {
            $validate_img = 'required|mimes:jpeg,png,jpg';
        }
        
        $validator = Validator::make($request->all(), [
            'brand' => 'required|unique:brands,brand,'.$request->post('brand_id'),
            'image' => $validate_img
        ]);

        if($request->post('brand_id') > 0) {
            if ($validator->fails()) {
                return redirect()->route('editbrand', ['id' => $request->post('brand_id')])
                ->withErrors($validator)
                ->withInput();
            } else {
                $data = Brand::find($request->post('brand_id'));

                if($request->hasFile('image')){
                    if($data->id != ''){
                        if($data->image){
                            if(file_exists(public_path("pro_brand_img/".$data->image))){
                                unlink("pro_brand_img/".$data->image);
                            }
                        }
                    }
                }

                if($request->hasfile('image')){
                    

                    $img = $request->file('image');
                    $ext = $img->extension();
                    $imageName = 'pro_brand_'.time().'.'.$ext;
                    $request->image->move(public_path('pro_brand_img'), $imageName);
                    $data->image = $imageName;
                }

                $data->brand = $request->post("brand");
    
                $data_validate = $data->save();
                if($data_validate == 1){
                    $request->session()->flash('success', "Brand updated successfully");
                    return redirect()->route('admin_brand');
                } else {
                    $request->session()->flash('error', "Brand not updated successfully");
                    return redirect()->route('admin_brand');
                }
            }
        } else {
            if ($validator->fails()) {
                return redirect()->route('add_brand')
                ->withErrors($validator)
                ->withInput();
            } else {
                $data = new Brand();
                if($request->hasfile('image')){
                    $img = $request->file('image');
                    $ext = $img->extension();
                    $imageName = 'pro_brand_'.time().'.'.$ext;
                    $request->image->move(public_path('pro_brand_img'), $imageName);
                    $data->image = $imageName;
                }
                $data->brand = $request->post("brand");
    
                $data_validate = $data->save();
                if($data_validate == 1){
                    $request->session()->flash('success', "Brand created successfully");
                    return redirect()->route('admin_brand');
                } else {
                    $request->session()->flash('error', "Brand not created successfully");
                    return redirect()->route('admin_brand');
                }
            }
        }
       
    }

    /**
     * Change Status of brand.
     *
     * @param  \App\Models\Admin\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function change_brand_status(Request $request ){
        $brand_status = $request->post('brand_status');
        $brand_id  = $request->post('brand_id');
        $data = array('status'=>$brand_status);
        $result = DB::table('brands')->where('id',$brand_id)->update($data);
        if($result == 1){
            return Response::json(array(
                'result' => 'success',
                'data'   => 'Brand Status Updated'
            )); 
        } else {
            return Response::json(array(
                'result' => 'error',
                'data'   => 'Brand Status Not Updated'
            )); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $brand_id  = $request->post('brand_id');
        $brand_img=Brand::where('id',$brand_id)->first()->toArray();

        if(file_exists(public_path("pro_brand_img/".$brand_img['image']))){
            unlink("pro_brand_img/".$brand_img['image']);
        }

        $result=Brand::where('id',$brand_id)->delete();
        if($result == 1){
            return Response::json(array(
                'result' => 'success',
                'data'   => 'Brand Deleted Successfully'
            )); 
        } else {
            return Response::json(array(
                'result' => 'error',
                'data'   => 'Something Went Wrong'
            )); 
        }

    }
}
