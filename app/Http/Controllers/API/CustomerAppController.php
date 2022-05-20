<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Http\Resources\Categories as CategoryResource;

class CustomerAppController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sendResponse(CategoryResource::collection(Category::all()), 'All Categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Category::find($id)){
            return $this->sendResponse( new CategoryResource(Category::find($id)), 'Individual Category');
        } else {
            return $this->sendError('No Data Found');
        }
    }

}
