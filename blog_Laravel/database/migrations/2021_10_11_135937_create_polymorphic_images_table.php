<?php
//migration to test polymorphic eloquent relation. Table {polymorphic_images}, serves both for table {polymorphic_users} and {polymorphic_posts}

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolymorphicImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	    if (!Schema::hasTable('polymorphic_images')) { //my fix for migration
		    Schema::create('polymorphic_images', function (Blueprint $table) {
                $table->increments('id');
			    $table->string('url', 77)           ->nullable()->comment = 'image url';  //Эквивалент VARCHAR с длинной 222 // ->nullable()  is a fix
                $table->integer('imageable_id')     ->nullable()->comment = 'column will contain the ID value of the post or user';  //Эквивалент INTEGER для базы данных
				$table->string('imageable_type', 77)->nullable()->comment = 'column will contain the class name of the parent model';  //Эквивалент VARCHAR с длинной 222 // ->nullable()  is a fix

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
         Schema::dropIfExists('polymorphic_images');
    }
}
