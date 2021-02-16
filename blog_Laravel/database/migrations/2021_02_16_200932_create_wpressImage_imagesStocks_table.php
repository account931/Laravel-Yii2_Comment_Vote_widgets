<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWpressImageImagesStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		if (!Schema::hasTable('wpressImage_ImagesStock')) { //my fix for migration
		  Schema::create('wpressImage_ImagesStock', function (Blueprint $table) {
            $table->increments('wpImStock_id');
			$table->string('wpImStock_name', 77)->nullable();  //Эквивалент VARCHAR с длинной 222 // ->nullable()  is a fix
            
			//Create Foreign key for table {wpressImages_blog_posts}	
			$table->unsignedInteger('wpImStock_postID')->nullable();
            $table->foreign('wpImStock_postID')->references('wpBlog_id')->on('wpressImages_blog_posts')->onUpdate('cascade')->onDelete('cascade');
	        //End Create Foreign key for table {wpressImages_blog_posts}	
			
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
		Schema::dropIfExists('wpressImage_ImagesStock');
    }
	
}
