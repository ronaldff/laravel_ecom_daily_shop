<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Response;
use DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $page_data['title'] = "customer";
        return view('admin.customer', $page_data);
    }

    public function manage_customer_process(Request $request)
    {
        if ($request->ajax()) {
              
            $data = Customer::all();
   
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('company'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains($row['company'], $request->get('company')) ? true : false;
                            });
                        }

                        if (!empty($request->get('name'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains(Str::lower($row['name']), ($request->get('name'))) ? true : false;
                            });
                        }

                        if (!empty($request->get('id'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains(Str::lower($row['id']), ($request->get('id'))) ? true : false;
                            });
                        }

                        if (!empty($request->get('city'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains(Str::lower($row['city']), ($request->get('city'))) ? true : false;
                            });
                        }

                        if (!empty($request->get('status'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains($row['status'], ($request->get('status'))) ? true : false;
                            });
                        }
   
                        if (!empty($request->get('search'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                if (Str::contains(Str::lower($row['company']), Str::lower($request->get('search')))){
                                    return true;
                                }else if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))) {
                                    return true;
                                }else if (Str::contains(Str::lower($row['city']), Str::lower($request->get('search')))) {
                                    return true;
                                }else if (Str::contains(Str::lower($row['id']), Str::lower($request->get('search')))) {
                                    return true;
                                }
   
                                return false;
                            });
                        }
                        
   
                    })
                    ->addColumn('status',function($row){
                        $status = '';
                        if($row->status == 0){
                            $status = "Deactive";

                        } else {
                            $status = "Active";
                        }
  
                            return $status;
                    })
                    ->make(true);
        }
    
        return view('admin.customer');
    }


    // public function manage_customer_process(Request $request){

       














        // $resultList = Customer::all()->toArray();
        
        // $result = array();
		// $button = '';
		// $i = 1;
		// foreach ($resultList as $key => $value) {
        //     if($value['status'] == 0){
        //         $status = "Deactive";
        //         $button = '<a class="btn-sm btn-danger text-light" onclick="changeStatusFun('.$value['id'].','.$value['status'].')" href="#">Deactive</a> ';
        //     } else {
        //         $status = "Active";
        //         $button = '<a class="btn-sm btn-success text-light" onclick="changeStatusFun('.$value['id'].','.$value['status'].')" href="#">Active</a> ';
        //     }
			

		// 	$button .= ' <a class="btn-sm btn-danger text-light" onclick="deleteFun('.$value['id'].')" href="#"> Delete</a>';

            

		// 	$result['data'][] = array(
		// 		$i++,
		// 		$value['name'],
		// 		$value['city'],
        //         $status,
		// 		$button
		// 	);
		// }
		// echo json_encode($result);
    // }

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
