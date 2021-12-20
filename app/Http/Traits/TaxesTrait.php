<?php

namespace App\Http\Traits;
use App\Models\Admin\Taxes;
use Illuminate\Support\Facades\DB;

trait TaxesTrait {
    public function getTaxes() {
        // Fetch all the sizes from the 'sizes' table.
        return DB::table("taxes")->where(['status' => 1])->get()->toArray();
    }
}