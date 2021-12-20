<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Response;
use App\Models\Admin\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BannerController extends Controller
{
   
    public function index(Request $request )
    {
        $page_data['banners'] = Banner::orderBy('id', 'DESC')->get();
        $page_data['title'] = "admin banner";
        return view('admin.banner', $page_data);
    }

    public function manage_banner($id = '', Request $request)
    {
        
        if($id > 0){
            $result = Banner::where(["id" => $id])->first()->toArray();
            $page_data['title'] = "edit banner";
            $page_data['banner_name'] = $result['banner_name'];
            $page_data['banner_image'] = $result['banner_image'];
            $page_data['banner_link'] = $result['banner_link'];
            $page_data['banner_id'] = $result['id'];
        } else {
            $page_data['title'] = "add banner";
            $page_data['banner_name'] = '';
            $page_data['banner_image'] = '';
            $page_data['banner_link'] = '';
            $page_data['banner_id'] = '';
        }
       
       return view("admin.addbanner", $page_data);
    }

   
    public function manage_banner_process(Request $request)
    {
        
        if($request->post('banner_id') > 0) {
            $validate_img = 'mimes:jpeg,png,jpg';
        } else {
            $validate_img = 'required|mimes:jpeg,png,jpg';
        }

        
        $validator = Validator::make($request->all(), [
            'banner_image' =>  $validate_img
        ]);

        if($request->post('banner_id') > 0) {
            if ($validator->fails()) {
                return redirect()->route('editbanner', ['id' => $request->post('banner_id')])
                ->withErrors($validator)
                ->withInput();
            } else {
                $data = Banner::find($request->post('banner_id'));
                $data->banner_name = $request->post("banner_name");

                if($request->hasfile('banner_image')){
                    if($data->id != ''){
                        if($data->banner_image){
                            if(file_exists(public_path("banner_img/".$data->banner_image))){
                                unlink("banner_img/".$data->banner_image);
                            }
                        }
                    }
                }

                if($request->hasfile('banner_image')){
                    $img = $request->file('banner_image');
                    $ext = $img->extension();
                    $imageName = 'banner_img_'.time().'.'.$ext;
                    $request->banner_image->move(public_path('banner_img'), $imageName);
                    $data->banner_image = $imageName;
                }
                
                $data->banner_link = $request->post("banner_link");
    
                $data_validate = $data->save();
                if($data_validate == 1){
                    $request->session()->flash('success', "Banner updated successfully");
                    return redirect()->route('admin_banner');
                } else {
                    $request->session()->flash('error', "Banner not updated successfully");
                    return redirect()->route('admin_banner');
                }
            }
        } else {
            if ($validator->fails()) {
                return redirect()->route('add_banner')
                ->withErrors($validator)
                ->withInput();
            } else {

                $count = Banner::count();

                if($count == 5){
                    return redirect()->route('add_banner')->with('error', 'banner limit exceeded');
                } else {
                    $data = new Banner();
                    $data->banner_name = $request->post("banner_name");
    
                    if($request->hasfile('banner_image')){
                        $img = $request->file('banner_image');
                        $ext = $img->extension();
                        $imageName = 'banner_img_'.time().'.'.$ext;
                        $request->banner_image->move(public_path('banner_img'), $imageName);
                        $data->banner_image = $imageName;
                    }
    
                    $data->banner_link = $request->post("banner_link");
                    
        
                    $data_validate = $data->save();
                    if($data_validate == 1){
                        $request->session()->flash('success', "Banner created successfully");
                        return redirect()->route('admin_banner');
                    } else {
                        $request->session()->flash('error', "Banner not created successfully");
                        return redirect()->route('admin_banner');
                    }
                }
              
            }
        }
       
    }
    
    public function delete(Request $request)
    {
        $banner_id  = $request->post('banner_id');

        $banner_image=Banner::where('id',$banner_id)->first()->toArray();
        
        if(file_exists(public_path("banner_img/".$banner_image['banner_image']))){
            unlink("banner_img/".$banner_image['banner_image']);
        }

        $result=Banner::where('id',$banner_id)->delete();
        if($result == 1){
            return Response::json(array(
                'result' => 'success',
                'data'   => 'Banner Deleted Successfully'
            )); 
        } else {
            return Response::json(array(
                'result' => 'error',
                'data'   => 'Something Went Wrong'
            )); 
        }

    }
    
}
