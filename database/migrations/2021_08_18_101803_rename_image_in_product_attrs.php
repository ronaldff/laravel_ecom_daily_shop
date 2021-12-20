<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameImageInProductAttrs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_attrs', function (Blueprint $table) {
            $table->renameColumn('image', 'attr_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_attrs', function (Blueprint $table) {
            $table->renameColumn('old_col_name', 'new_col_name');
        });
    }
}
