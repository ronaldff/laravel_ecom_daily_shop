<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Response;

class ColorController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $page_data['title'] = "admin color";
        $page_data['colors'] = Color::orderBy('sequence', 'ASC')->get();
        return view('admin.color', $page_data);
    }

    /**
     * Show the form for creating a new resource. and editing
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_color($id = '', Request $request)
    {
        if($id > 0){
            $result = Color::where(["id" => $id])->first()->toArray();
            $page_data['title'] = "edit color";
            $page_data['color'] = $result['color'];
            $page_data['sequence'] = $result['sequence'];
            $page_data['color_id'] = $result['id'];

        } else {
            $page_data['title'] = "add color";
            $page_data['color'] = "";
            $page_data['sequence'] = "";
            $page_data['color_id'] = '';
        }
       
       return view("admin.addcolor", $page_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_color_process(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'color' => 'required|unique:colors,color,'.$request->post('color_id'),
            'sequence' => 'required|unique:colors,sequence,'.$request->post('color_id'),
        ]);

        if($request->post('color_id') > 0) {
            if ($validator->fails()) {
                return redirect()->route('editcolor', ['id' => $request->post('color_id')])
                ->withErrors($validator)
                ->withInput();
            } else {
                $data = Color::find($request->post('color_id'));
                $data->color = $request->post("color");
                $data->sequence = $request->post("sequence");
    
                $data_validate = $data->save();
                if($data_validate == 1){
                    $request->session()->flash('success', "Color updated successfully");
                    return redirect()->route('admin_color');
                } else {
                    $request->session()->flash('error', "Color not updated successfully");
                    return redirect()->route('admin_color');
                }
            }
        } else {
            if ($validator->fails()) {
                return redirect()->route('add_color')
                ->withErrors($validator)
                ->withInput();
            } else {
                $data = new Color();
                $data->color = $request->post("color");
                $data->sequence = $request->post("sequence");
    
                $data_validate = $data->save();
                if($data_validate == 1){
                    $request->session()->flash('success', "Color created successfully");
                    return redirect()->route('admin_color');
                } else {
                    $request->session()->flash('error', "Color not created successfully");
                    return redirect()->route('admin_color');
                }
            }
        }
       
    }

    /**
     * Change Status of color.
     *
     * @param  \App\Models\Admin\color  $color
     * @return \Illuminate\Http\Response
     */
    public function change_color_status(Request $request ){
        $color_status = $request->post('color_status');
        $color_id  = $request->post('color_id');
        $data = array('status'=>$color_status);
        $result = DB::table('colors')->where('id',$color_id)->update($data);
        if($result == 1){
            return Response::json(array(
                'result' => 'success',
                'data'   => 'Color Status Updated'
            )); 
        } else {
            return Response::json(array(
                'result' => 'error',
                'data'   => 'Color Status Not Updated'
            )); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\color  $color
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $color_id  = $request->post('color_id');
        $result=Color::where('id',$color_id)->delete();
        if($result == 1){
            return Response::json(array(
                'result' => 'success',
                'data'   => 'Color Deleted Successfully'
            )); 
        } else {
            return Response::json(array(
                'result' => 'error',
                'data'   => 'Something Went Wrong'
            )); 
        }

    }
}
