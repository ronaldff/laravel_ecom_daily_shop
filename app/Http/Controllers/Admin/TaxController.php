<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Response;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $page_data['title'] = "admin tax";
        $page_data['taxes'] = Tax::orderBy('id', 'DESC')->get();
        return view('admin.tax', $page_data);
    }

    /**
     * Show the form for creating a new resource. and editing
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_tax($id = '', Request $request)
    {
        if($id > 0){
            $result = Tax::where(["id" => $id])->first()->toArray();
            $page_data['title'] = "edit tax";
            $page_data['tax_value'] = $result['tax_value'];
            $page_data['tax_desc'] = $result['tax_desc'];
            $page_data['tax_id'] = $result['id'];

        } else {
            $page_data['title'] = "add tax";
            $page_data['tax_value'] = "";
            $page_data['tax_desc'] = "";
            $page_data['tax_id'] = '';
        }
       
       return view("admin.addtax", $page_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_tax_process(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'tax_value' => 'required|unique:taxes,tax_value,'.$request->post('tax_id'),
            'tax_desc' => 'required'
        ]);

        if($request->post('tax_id') > 0) {
            if ($validator->fails()) {
                return redirect()->route('edittax', ['id' => $request->post('tax_id')])
                ->withErrors($validator)
                ->withInput();
            } else {
                $data = Tax::find($request->post('tax_id'));
                $data->tax_value = $request->post("tax_value");
                $data->tax_desc = $request->post("tax_desc");
    
                $data_validate = $data->save();
                if($data_validate == 1){
                    $request->session()->flash('success', "Tax updated successfully");
                    return redirect()->route('admin_tax');
                } else {
                    $request->session()->flash('error', "Tax not updated successfully");
                    return redirect()->route('admin_tax');
                }
            }
        } else {
            if ($validator->fails()) {
                return redirect()->route('add_tax')
                ->withErrors($validator)
                ->withInput();
            } else {
                $data = new Tax();
                $data->tax_value = $request->post("tax_value");
                $data->tax_desc = $request->post("tax_desc");
    
                $data_validate = $data->save();
                if($data_validate == 1){
                    $request->session()->flash('success', "Tax created successfully");
                    return redirect()->route('admin_tax');
                } else {
                    $request->session()->flash('error', "Tax not created successfully");
                    return redirect()->route('admin_tax');
                }
            }
        }
       
    }

    /**
     * Change Status of tax.
     *
     * @param  \App\Models\Admin\tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function change_tax_status(Request $request ){
        $tax_status = $request->post('tax_status');
        $tax_id  = $request->post('tax_id');
        $data = array('status'=>$tax_status);
        $result = DB::table('taxes')->where('id',$tax_id)->update($data);
        if($result == 1){
            return Response::json(array(
                'result' => 'success',
                'data'   => 'Tax Status Updated'
            )); 
        } else {
            return Response::json(array(
                'result' => 'error',
                'data'   => 'Tax Status Not Updated'
            )); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $tax_id  = $request->post('tax_id');
        $result=Tax::where('id',$tax_id)->delete();
        if($result == 1){
            return Response::json(array(
                'result' => 'success',
                'data'   => 'tax Deleted Successfully'
            )); 
        } else {
            return Response::json(array(
                'result' => 'error',
                'data'   => 'Something Went Wrong'
            )); 
        }

    }
}
