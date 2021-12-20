<?php

namespace App\Http\Traits;
use App\Models\Admin\Colors;
use Illuminate\Support\Facades\DB;

trait ColorsTrait {
    public function getColors() {
        // Fetch all the colors from the 'colors' table.
        return DB::table("colors")->where(['status' => 1])->get()->toArray();
    }
}