<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN')){
            return redirect()->route("admin_dashboard");
        } else {
            $page_data['title'] = "admin";
            return view('admin.login',$page_data);
        }
        
    }

    /**
     * check the details of admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin_login')
                        ->withErrors($validator)
                        ->withInput();
        } else {

            $email = $request->post('email');
            $password = $request->post('password');
            $result = Admin::where(['email' => $email])->get()->toArray();
            
            if(!empty($result)){
                $data = $result[0];
                if (Hash::check($password, $data['password'])) {
                    $request->session()->put('ADMIN_LOGIN',true);
                    $request->session()->put('ADMIN_ID',$data['id']);
                    return redirect()->route("admin_dashboard");
                    
                } else {
                    return redirect()->route('admin_login')->with('error', "password is incorrect");
                }
            } else {
                return redirect()->route('admin_login')->with('error', "Email address is incorrect");
            }
        }
    }


    /**
     * Display a admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $page_data['title'] = "admin dashboard";
        return view('admin.dashboard',$page_data);
    }

     /**
     * Display a admin logout.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->session()->forget('ADMIN_LOGIN');
        $request->session()->forget('ADMIN_ID');
        return redirect()->route('admin_login')->with('success', 'Logout successfully');
    }

   

    

   
    

   
}
