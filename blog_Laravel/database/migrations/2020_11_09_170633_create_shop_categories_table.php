<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('shop_categories')) { //my fix for migration
        // Create table for categories
        Schema::create('shop_categories', function (Blueprint $table) {
            $table->increments('categ_id');
            $table->string('categ_name', 22)->nullable();
        });
	  }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shop_categories');
    }
}
