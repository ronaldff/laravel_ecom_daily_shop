<?php

namespace App\Http\Middleware;
use App\Http\Controllers\API\BaseController as BaseController;
use Closure;
use Illuminate\Http\Request;
use DB;

class ApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $obj = new BaseController;
        $db_apiKey = DB::table('apikeys')->pluck('apikey')->first();
        if(!isset($_SERVER['HTTP_X_API_KEY']) || empty(trim($_SERVER['HTTP_X_API_KEY'])) || trim($db_apiKey) != trim($_SERVER['HTTP_X_API_KEY'])){
            return  $obj->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
        return $next($request);
    }
}
