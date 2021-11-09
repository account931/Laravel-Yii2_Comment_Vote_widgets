<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElasticSearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('elastic_search')) { //my fix for migration     

		    Schema::create('elastic_search', function (Blueprint $table) {
				$table->engine = 'MyISAM'; //need MyISAM for search testing (function emulating Elastic Search won't work with InnoDB)
                $table->increments('elast_id');
			    $table->string('elast_title', 222)->nullable();  //Эквивалент VARCHAR с длинной 222 // ->nullable()  is a fix
			    $table->text('elast_text')->nullable();        //equivalent for text 
			    //$table->integer('elast_author')->nullable();  //Эквивалент INTEGER для базы данных
			    $table->timestamp('elast_created_at')->default( date('Y-m-d H:i:s') );  //use=> ->default(DB::raw('CURRENT_TIMESTAMP'));   //Эквивалент TIMESTAMP для базы данных
		        //$table->integer('elast_category')->nullable();  //Эквивалент INTEGER для базы данных
			    //$table->enum('elast_status', ['0', '1'])->default('1'); //Эквивалент ENUM для базы данных
			
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
		 Schema::dropIfExists('elastic_search');
    }
}
