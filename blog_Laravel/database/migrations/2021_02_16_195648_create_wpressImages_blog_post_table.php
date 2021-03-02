<?php
//if troubles with time of creation at 'wpBlog_created_at', set it's default value as null
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWpressImagesBlogPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('wpressImages_blog_post')) { //my fix for migration     
		    Schema::create('wpressImages_blog_post', function (Blueprint $table) {
                $table->increments('wpBlog_id');
			    $table->string('wpBlog_title', 222)->nullable();  //Эквивалент VARCHAR с длинной 222 // ->nullable()  is a fix
			    $table->text('wpBlog_text')->nullable();        //equivalent for text 
			    $table->integer('wpBlog_author')->nullable();  //Эквивалент INTEGER для базы данных
			    $table->timestamp('wpBlog_created_at')->nullable(); //->default( date('Y-m-d H:i:s') );  //use=> ->default(DB::raw('CURRENT_TIMESTAMP'));   //Эквивалент TIMESTAMP для базы данных
		        //$table->integer('wpBlog_category')->nullable();  //Эквивалент INTEGER для базы 
				
				
			    //Create Foreign key for table {}	
			    $table->unsignedInteger('wpBlog_category')->nullable();
                $table->foreign('wpBlog_category')->references('wpCategory_id')->on('wpressImage_category')->onUpdate('cascade')->onDelete('cascade');
	            //End Create Foreign key for table {}	
			
			    $table->enum('wpBlog_status', ['0', '1'])->default('1'); //Эквивалент ENUM для базы данных
  
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
        Schema::dropIfExists('wpressImages_blog_post');
    }
}
