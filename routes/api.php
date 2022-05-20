<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\Api\CustomerAppController;
use App\Http\Controllers\API\PassportAuthController;





/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('api_auth_key')->group(function(){
    Route::post('register',[RegisterController::class,'register']);
    Route::post('login',[LoginController::class,'login']);

    Route::middleware('auth:api')->group(function () {
        Route::get('get-user', [PassportAuthController::class, 'userInfo']);
    });

    Route::resource('categories',CustomerAppController::class)->only(['index','show']);
});





