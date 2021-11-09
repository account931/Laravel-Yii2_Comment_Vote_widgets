<?php
//seeder for tables => {elastic_search}

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class ElasticSeeder extends Seeder {

    public function run(){
		
		//Start fill DB table {polymorphic_users} with data ---------------
		//Way to set auto increment back to 1 before seeding a table. Instead of DB::table('polymorphic_users')->delete();
		//DB::table('polymorphic_users')->delete();  //whether to Delete old materials
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('elastic_search')->truncate();
        
		//$NUMBER_OF_CATEGORIES = 5;
        $faker = Faker::create();

        //$gender = $faker->randomElement(['male', 'female']);

    	foreach (range(1,20) as $index) {
		
	
            DB::table('elastic_search')->insert([
                'elast_title'      => $faker->name, //$faker->name($gender),
                'elast_text'       => $faker->realText($maxNbChars = 200, $indexSize = 2), //$faker->text,
				'elast_created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                //'wpBlog_author' => 1, //$faker->username,
				//'wpBlog_category' => rand(1, $NUMBER_OF_CATEGORIES), //random string between min and max numbe
                //'wpBlog_status' => $faker->date($format = 'Y-m-d', $max = 'now'),
				
				//'image' => $faker->image(public_path('images/students'),400,300, null, false), //saving images to 'public/images/students. Takes much time
                //'image' => 'http://loremflickr.com/400/300?random='.rand(1, 100),

            ]);
        }   
		
		
        
	}
}

