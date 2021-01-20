<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointRoomListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('appoint-room-list')) { //my fix for migration
          Schema::create('appoint-room-list', function (Blueprint $table) {
            $table->increments('r_id');
			$table->string('r_host_name', 88)->nullable()->comment = 'Host name';  //Эквивалент VARCHAR с длинной 88 // 
			$table->string('r_room', 88)->nullable()->comment = 'Host room number';  //Эквивалент VARCHAR с длинной 88 // 
            $table->string('r_address', 88)->nullable()->comment = 'Host address';  
            $table->string('r_phone', 46)->nullable()->comment = 'Host phone'; 

			
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
        Schema::dropIfExists('appoint-room-list');
    }
}