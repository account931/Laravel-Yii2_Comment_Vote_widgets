<?php
//seeder for 3 tables => {polymorphic_posts}, {polymorphic_users}, {polymorphic_images},

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PolymorphicSeeder extends Seeder {

    public function run(){
		
		//Start fill DB table {polymorphic_users} with data ---------------
		//Way to set auto increment back to 1 before seeding a table. Instead of DB::table('polymorphic_users')->delete();
		//DB::table('polymorphic_users')->delete();  //whether to Delete old materials
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('polymorphic_users')->truncate();

        DB::table('polymorphic_users')->insert(['id' => 1, 'user_name' => 'Polymorph User 1']);
        DB::table('polymorphic_users')->insert(['id' => 2, 'user_name' => 'Polymorph User 2']);
		DB::table('polymorphic_users')->insert(['id' => 3, 'user_name' => 'Polymorph User 3']);
		
		
		
		
		
	    //Start fill DB table {polymorphic_posts} with data ---------------
		//Way to set auto increment back to 1 before seeding a table. Instead of DB::table('polymorphic_posts')->delete();
		//DB::table('polymorphic_posts')->delete();  //whether to Delete old materials
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('polymorphic_posts')->truncate();

        DB::table('polymorphic_posts')->insert(['id' => 1, 'post_name' => 'Post 1', 'post_text' => 'Some Post 1"s text goes here..', 'author_id' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s') ]);
	    DB::table('polymorphic_posts')->insert(['id' => 2, 'post_name' => 'Post 2', 'post_text' => 'Some Post 2"s text goes here..', 'author_id' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s') ]);
        DB::table('polymorphic_posts')->insert(['id' => 3, 'post_name' => 'Post 3', 'post_text' => 'Some Post 3"s text goes here..', 'author_id' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s') ]);

		
		
	

		
		
		
		//Start fill DB table {polymorphic_images} with data ---------------
		//Way to set auto increment back to 1 before seeding a table. Instead of DB::table('polymorphic_images')->delete();
		//DB::table('polymorphic_images')->delete();  //whether to Delete old materials
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('polymorphic_images')->truncate();

        //The imageable_id column will contain the ID value of the post or use
        DB::table('polymorphic_images')->insert(['id' => 1, 'url' => '/images/polymorphic/copenn.jpg',  'imageable_id' => 1, 'imageable_type'=> 'App\Models\Polymorphic\Polymorphic_Posts']);
        DB::table('polymorphic_images')->insert(['id' => 2, 'url' => '/images/polymorphic/copenn2.jpg', 'imageable_id' => 1, 'imageable_type'=> 'App\Models\Polymorphic\Polymorphic_Users']);
        DB::table('polymorphic_images')->insert(['id' => 3, 'url' => '/images/polymorphic/copenn2.jpg', 'imageable_id' => 3, 'imageable_type'=> 'App\Models\Polymorphic\Polymorphic_Posts']);

	}
}

