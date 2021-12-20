<?php

namespace App\Http\Traits;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\DB;

trait CategoriesTrait {
    public function getCategories($cat_id = null) {

        if($cat_id != null){
            return DB::table("categories")->where('status',1)->where('id', '!=' , $cat_id)->get()->toArray();
        } else {
            // Fetch all the categories from the 'categories' table.
            return DB::table("categories")->where(['status' => 1])->get()->toArray();
        }
        
    }
}