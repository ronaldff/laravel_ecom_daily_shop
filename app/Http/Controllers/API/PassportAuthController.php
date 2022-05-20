<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Admin\Customer;
use Illuminate\Support\Facades\Auth;
use Validator;

class PassportAuthController extends BaseController
{
    public function userInfo() 
    {
        $user = Auth::user();
        $user['access_token'] = trim(substr($_SERVER['HTTP_AUTHORIZATION'],6));
        return $this->sendResponse($user, 'User Info');
    //  return response()->json(['user' => $user], 200);
 
    }
}
