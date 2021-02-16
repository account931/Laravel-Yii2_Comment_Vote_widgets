<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWpressImageCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //
	  if (!Schema::hasTable('wpressImage_category')) { //my fix for migration
		Schema::create('wpressImage_category', function (Blueprint $table) {
            $table->increments('wpCategory_id');
			$table->string('wpCategory_name', 77)->nullable();  //Эквивалент VARCHAR с длинной 222 // ->nullable()  is a fix
            $table->timestamps();
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
        //
		 Schema::dropIfExists('wpressImage_category');
    }
}
