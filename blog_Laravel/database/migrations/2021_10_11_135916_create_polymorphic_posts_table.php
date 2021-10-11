<?php
//migration to test polymorphic eloquent relation. Table {polymorphic_posts}

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolymorphicPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	    if (!Schema::hasTable('polymorphic_posts')) { //my fix for migration
		    Schema::create('polymorphic_posts', function (Blueprint $table) {
                $table->increments('id');
			    $table->string('post_name', 77)->nullable()->comment = 'post name';  //Эквивалент VARCHAR с длинной 222 // ->nullable()  is a fix
                $table->text('post_text')->nullable()->comment = 'post text';       //equivalent for text 
				
				//Foreign key
				$table->bigInteger('author_id')->unsigned()->comment = 'Author Id from table (polymorphic_users) (ForeignKey)'; 
                $table->foreign('author_id')->references('id')->on('polymorphic_users')->onUpdate('cascade')->onDelete('cascade');  //Id from table {abz_ranks}
	            //End Foreign key
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
        Schema::dropIfExists('polymorphic_posts');
    }
}
