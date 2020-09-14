<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWpressBlogPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpress_blog_post', function (Blueprint $table) {
            $table->increments('wpBlog_id');
			$table->string('wpBlog_title', 222)->nullable();  //Эквивалент VARCHAR с длинной 222 // ->nullable()  is a fix
			$table->text('wpBlog_text')->nullable();        //equivalent for text 
			$table->integer('wpBlog_author')->nullable();  //Эквивалент INTEGER для базы данных
			$table->timestamp('wpBlog_created_at')->default( date('Y-m-d H:i:s') ); //	Эквивалент TIMESTAMP для базы данных
		    $table->integer('wpBlog_category')->nullable();  //Эквивалент INTEGER для базы данных
			$table->enum('wpBlog_status', ['0', '1'])->default('1'); //Эквивалент ENUM для базы данных
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpress_blog_post');
    }
}
