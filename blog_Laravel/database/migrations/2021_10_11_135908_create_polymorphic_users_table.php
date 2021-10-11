<?php
//migration to test polymorphic eloquent relation. Table {polymorphic_users}

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolymorphicUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	    if (!Schema::hasTable('polymorphic_users')) { //my fix for migration
		    Schema::create('polymorphic_users', function (Blueprint $table) {
                $table->increments('id');
			    $table->string('user_name', 77)->nullable()->comment = 'user name';  //Эквивалент VARCHAR с длинной 222 // ->nullable()  is a fix
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
        Schema::dropIfExists('polymorphic_users');
    }
}
