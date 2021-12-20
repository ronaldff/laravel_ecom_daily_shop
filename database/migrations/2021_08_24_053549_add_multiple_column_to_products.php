<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleColumnToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string("lead_time")->nullable();
            $table->string("tax")->nullable();
            $table->string("tax_type")->nullable();
            $table->boolean("is_promo")->default(0);
            $table->boolean("is_featured")->default(0);
            $table->boolean("is_discounted")->default(0);
            $table->boolean("is_tranding")->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['lead_time',  'tax', 'tax_type','is_promo','is_featured','is_discounted','is_tranding']);
        });
    }
}
