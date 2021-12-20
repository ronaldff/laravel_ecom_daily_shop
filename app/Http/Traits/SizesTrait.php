<?php

namespace App\Http\Traits;
use App\Models\Admin\Sizes;
use Illuminate\Support\Facades\DB;

trait SizesTrait {
    public function getSizes() {
        // Fetch all the sizes from the 'sizes' table.
        return DB::table("sizes")->where(['status' => 1])->get()->toArray();
    }
}