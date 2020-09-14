<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWpressCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpress_category', function (Blueprint $table) {
            $table->increments('wpCategory_id');
			$table->string('wpCategory_name', 77)->nullable();  //Эквивалент VARCHAR с длинной 222 // ->nullable()  is a fix
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
        Schema::dropIfExists('wpress_category');
    }
}
