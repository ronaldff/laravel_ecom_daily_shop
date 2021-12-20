<?php

namespace App\Http\Traits;
use App\Models\Admin\Brand;
use Illuminate\Support\Facades\DB;

trait BrandsTrait {
    public function getBrands() {
        // Fetch all the categories from the 'categories' table.
        return DB::table("brands")->where(['status' => 1])->get()->toArray();
    }
}