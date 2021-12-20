<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attrs', function (Blueprint $table) {
            $table->id();
            $table->integer("products_id")->nullable();
            $table->string("sku")->nullable();
            $table->string("image")->nullable();
            $table->integer("mrp")->nullable();
            $table->integer("price")->nullable();
            $table->integer("qty")->nullable();
            $table->integer("size_id")->nullable();
            $table->integer("color_id")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attrs');
    }
}
