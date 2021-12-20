<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Response;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $page_data['title'] = "admin size";
        $page_data['sizes'] = Size::orderBy('sequence', 'ASC')->get();
        return view('admin.size', $page_data);
    }

    /**
     * Show the form for creating a new resource. and editing
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_size($id = '', Request $request)
    {
        if($id > 0){
            $result = Size::where(["id" => $id])->first()->toArray();
            $page_data['title'] = "edit size";
            $page_data['size'] = $result['size'];
            $page_data['sequence'] = $result['sequence'];
            $page_data['size_id'] = $result['id'];

        } else {
            $page_data['title'] = "add size";
            $page_data['size'] = "";
            $page_data['sequence'] = "";
            $page_data['size_id'] = '';
        }
       
       return view("admin.addsize", $page_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_size_process(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'size' => 'required|unique:sizes,size,'.$request->post('size_id'),
            'sequence' => 'required|unique:sizes,sequence,'.$request->post('size_id'),
        ]);

        if($request->post('size_id') > 0) {
            if ($validator->fails()) {
                return redirect()->route('editsize', ['id' => $request->post('size_id')])
                ->withErrors($validator)
                ->withInput();
            } else {
                $data = Size::find($request->post('size_id'));
                $data->size = strtoupper($request->post("size"));
                $data->sequence = $request->post("sequence");
    
                $data_validate = $data->save();
                if($data_validate == 1){
                    $request->session()->flash('success', "Size updated successfully");
                    return redirect()->route('admin_size');
                } else {
                    $request->session()->flash('error', "Size not updated successfully");
                    return redirect()->route('admin_size');
                }
            }
        } else {
            if ($validator->fails()) {
                return redirect()->route('add_size')
                ->withErrors($validator)
                ->withInput();
            } else {
                $data = new Size();
                $data->size = strtoupper($request->post("size"));
                $data->sequence = $request->post("sequence");
    
                $data_validate = $data->save();
                if($data_validate == 1){
                    $request->session()->flash('success', "Size created successfully");
                    return redirect()->route('admin_size');
                } else {
                    $request->session()->flash('error', "Size not created successfully");
                    return redirect()->route('admin_size');
                }
            }
        }
       
    }

    /**
     * Change Status of size.
     *
     * @param  \App\Models\Admin\size  $size
     * @return \Illuminate\Http\Response
     */
    public function change_size_status(Request $request ){
        $size_status = $request->post('size_status');
        $size_id  = $request->post('size_id');
        $data = array('status'=>$size_status);
        $result = DB::table('sizes')->where('id',$size_id)->update($data);
        if($result == 1){
            return Response::json(array(
                'result' => 'success',
                'data'   => 'Size Status Updated'
            )); 
        } else {
            return Response::json(array(
                'result' => 'error',
                'data'   => 'Size Status Not Updated'
            )); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\size  $size
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $size_id  = $request->post('size_id');
        $result=Size::where('id',$size_id)->delete();
        if($result == 1){
            return Response::json(array(
                'result' => 'success',
                'data'   => 'Size Deleted Successfully'
            )); 
        } else {
            return Response::json(array(
                'result' => 'error',
                'data'   => 'Something Went Wrong'
            )); 
        }

    }
}
