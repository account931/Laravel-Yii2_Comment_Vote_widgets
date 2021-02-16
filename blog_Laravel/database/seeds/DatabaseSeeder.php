<?php
//This is the MAIN SEEDER!!!!

use Illuminate\Database\Seeder;
//use App\database\seeds\SeedersFiles\ShopSimpleSeeder;
//use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		//specify whta data to run
        // $this->call(UsersTableSeeder::class);
		
		 $this->call('Wpress_blog_post_Seeder'); //fill DB table {Wpress_blog} with data
         $this->call('WpressCategory_Seeder');
		 $this->call('Users_Seeder');  //fill DB table {users} with data
		 $this->call('Roles_Seeder');  //fill DB table {roles} with data {4 roles}
		 $this->call('RoleUsers_Seeder');  //fill DB table {role_user} with data {assign admin to Dima}
		 $this->call('ShopCategories_Seeder');  //fill DB table {shop_categories} with data. MUST BE BEFORE {ShopSimpleSeeder} as contains Forein Keys for {ShopSimpleSeeder}
		 
		 //Seeder in separated file
    	 $this->call('ShopSimpleSeeder');  //fill DB table {shopsimple} with data. SEEDER IS IN SUBFOLDER /SeedersFiles.
		 
		 $this->call('Shop_Quantity_Seeder');  //fill DB table {shop_quantity} with data. 
		 
         $this->call('AppointRoomList_Seeder');  //fill DB table {appoint-room-list} with data.
         //$this->call('Students_Seeder');  //fill DB table {appoint-room-list} with data. //Not used here. Used in {abz_Laravel_6_LTS} as Abz_Employees_Seeder
		 
		 $this->call('Wpressimage_category_Seeder');    //fill DB table {wpressimage_category} with data
		 $this->call('WpressImages_blog_Post_Seeder');  //fill DB table {	wpressimages_blog_post} with data

		 
		 
		 $this->command->info('Seedering action was successful!');
    }
	
	
  
}
//------------------- ALL SEEDERS CLASS -----------------------------------

//fill DB table {Wpress_blog} with data 
class Wpress_blog_post_Seeder extends Seeder {

  public function run()
  {
    DB::table('wpress_blog_post')->delete();  //whether to Delete old materials

    //User::create(['email' => 'foo@bar.com']);
    DB::table('wpress_blog_post')->insert(['wpBlog_title' => 'Setting  Enum in PhpMyAdmin', 'wpBlog_text' => "Setting  Enum in SQL\r\nunder your phpmyadmin\r\n\r\nchoose enum\r\n\r\nin Length/Values column put there : ''0'' ,''1''\r\n\r\nand your done ", 'wpBlog_author' => 1, 'wpBlog_category' =>1 ]);
	DB::table('wpress_blog_post')->insert(['wpBlog_title' => 'Milgram experiment', 'wpBlog_text' => 'The Milgram experiment on obedience to authority figures was a series of social psychology experiments conducted by Yale University psychologist Stanley Milgram. They measured the willingness of study participants, men from a diverse range of occupations with varying levels of education, to obey an authority figure who instructed them to perform acts conflicting with their personal conscience. Participants were led to believe that they were assisting an unrelated experiment, in which they had to administer electric shocks to a "learner." These fake electric shocks gradually increased to levels that would have been fatal had they been real', 'wpBlog_author' => 1, 'wpBlog_category' =>3 ]);
    DB::table('wpress_blog_post')->insert(['wpBlog_title' => 'Milgram results', 'wpBlog_text' => 'The extreme willingness of adults to go to almost any lengths on the command of an authority constitutes the chief finding of the study and the fact most urgently demanding explanation.\r\n\r\nOrdinary people, simply doing their jobs, and without any particular hostility on their part, can become agents in a terrible destructive process. Moreover, even when the destructive effects of their work become patently clear, and they are asked to carry out actions incompatible with fundamental standards of morality, relatively few people have the resources needed to resist authority', 'wpBlog_author' => 1, 'wpBlog_category' =>1 ]);
    DB::table('wpress_blog_post')->insert(['wpBlog_title' => 'Hygge', 'wpBlog_text' => 'Hygge is a Danish and Norwegian word for a mood of coziness and comfortable conviviality with feelings of wellness and contentment. As a cultural category with its sets of associated practices hygge has more or less the same meanings in Danish and Norwegian, but the notion is more central in Denmark than in Norway. The emphasis on hygge as a core part of Danish culture is a recent phenomenon, dating to the late 20th century.', 'wpBlog_author' => 1, 'wpBlog_category' =>2 ]);

  }
}

//fill DB table {WpressCategory} with data 
class WpressCategory_Seeder extends Seeder {

  public function run()
  {
    DB::table('wpress_category')->delete();  //whether to Delete old materials

    //User::create(['email' => 'foo@bar.com']);
    DB::table('wpress_category')->insert(['wpCategory_id' => 1, 'wpCategory_name' => 'General' ]);
	DB::table('wpress_category')->insert(['wpCategory_id' => 2, 'wpCategory_name' => 'Science' ]);
	DB::table('wpress_category')->insert(['wpCategory_id' => 3, 'wpCategory_name' => 'Tips and Tricks' ]);

  }
}


//fill DB table {users} with data 
class Users_Seeder extends Seeder {

  public function run()
  {
    DB::table('users')->delete();  //whether to Delete old materials

    //User::create(['email' => 'foo@bar.com']);
    DB::table('users')->insert(['id' => 1, 'name' => 'Admin', 'email' => 'admin@ukr.net', 'password' => bcrypt('adminadmin') ]);
	DB::table('users')->insert(['id' => 2, 'name' => 'Dima', 'email' => 'dimmm931@gmail.com', 'password' => bcrypt('dimadima') ]);
	DB::table('users')->insert(['id' => 3, 'name' => 'Olya', 'email' => 'olya@gmail.com', 'password' => bcrypt('olyaolya') ]);

  }
}


//fill DB table {roles} with data (create 4 roles)
class Roles_Seeder extends Seeder {
  public function run()
  {
    DB::table('roles')->delete();  //whether to Delete old materials

    //User::create(['email' => 'foo@bar.com']);
    DB::table('roles')->insert(['id' => 12, 'name' => 'owner', 'display_name' => 'Project Owner', 'description' => 'User is the owner of a given project', 'created_at' => date('Y-m-d H:i:s') ]);
	DB::table('roles')->insert(['id' => 13, 'name' => 'admin', 'display_name' => 'User Administrator', 'description' => 'User is allowed to manage and edit other users', 'created_at' =>  date('Y-m-d H:i:s') ]);
    DB::table('roles')->insert(['id' => 14, 'name' => 'manager', 'display_name' => 'Company Manager', 'description' => 'User is a manager of a Department', 'created_at' =>  date('Y-m-d H:i:s') ]);
    DB::table('roles')->insert(['id' => 15, 'name' => 'commander', 'display_name' => 'custom role', 'description' => 'Wing Commander', 'created_at' => date('Y-m-d H:i:s') ]);
  }
}



//fill DB table {role_user} with data 
class RoleUsers_Seeder extends Seeder {
  public function run()
  {
    DB::table('role_user')->delete();  //whether to Delete old materials

    DB::table('role_user')->insert(['user_id' => 2, 'role_id' => 13 ]);
  }
}




//fill DB table {shop_categories} with data.
class ShopCategories_Seeder extends Seeder {
  public function run()
  {
    DB::table('shop_categories')->delete();  //whether to Delete old materials

    DB::table('shop_categories')->insert(['categ_id' => 1, 'categ_name' => 'Desktop' ]);
	DB::table('shop_categories')->insert(['categ_id' => 2, 'categ_name' => 'Mobile' ]);
	DB::table('shop_categories')->insert(['categ_id' => 3, 'categ_name' => 'Tablet' ]);
	DB::table('shop_categories')->insert(['categ_id' => 4, 'categ_name' => 'Audio Pro' ]);
  }
}





//fill DB table {shop_quantity} with data.
class Shop_Quantity_Seeder extends Seeder {
  public function run()
  {
    DB::table('shop_quantity')->delete();  //whether to Delete old materials

    DB::table('shop_quantity')->insert(['id' => 1, 'product_id' => 1, 'all_quantity' => 200, 'left_quantity' => 200 ]);
	DB::table('shop_quantity')->insert(['id' => 2, 'product_id' => 2, 'all_quantity' => 20,  'left_quantity' => 20 ]);
	DB::table('shop_quantity')->insert(['id' => 3, 'product_id' => 3, 'all_quantity' => 10,  'left_quantity' => 10 ]);
	DB::table('shop_quantity')->insert(['id' => 4, 'product_id' => 4, 'all_quantity' => 10,  'left_quantity' => 10 ]);
	DB::table('shop_quantity')->insert(['id' => 5, 'product_id' => 5, 'all_quantity' => 10,  'left_quantity' => 10 ]);
	DB::table('shop_quantity')->insert(['id' => 6, 'product_id' => 6, 'all_quantity' => 10,  'left_quantity' => 10 ]);
	DB::table('shop_quantity')->insert(['id' => 7, 'product_id' => 7, 'all_quantity' => 10,  'left_quantity' => 10 ]);
	DB::table('shop_quantity')->insert(['id' => 8, 'product_id' => 8, 'all_quantity' => 10,  'left_quantity' => 10 ]);
	DB::table('shop_quantity')->insert(['id' => 9, 'product_id' => 9, 'all_quantity' => 10,  'left_quantity' => 10 ]);
	DB::table('shop_quantity')->insert(['id' => 10, 'product_id' => 10, 'all_quantity' => 3,   'left_quantity' => 3 ]);
  }
}





//fill DB table {appoint-room-list} with data.
class AppointRoomList_Seeder extends Seeder {
  public function run()
  {
    DB::table('appoint-room-list')->delete();  //whether to Delete old materials

    DB::table('appoint-room-list')->insert(['r_id' => 1, 'r_host_name' => 'Alex Perez',       'r_room' => 1, 'r_address' => 'Kobenhaven, Gothersgade 93', 'r_phone' => '+380978786565' ]);
	DB::table('appoint-room-list')->insert(['r_id' => 2, 'r_host_name' => ' Milan Heyboer',   'r_room' => 2, 'r_address' => 'Kobenhaven, Gothersgade 94', 'r_phone' => '+380978786565' ]);
    DB::table('appoint-room-list')->insert(['r_id' => 3, 'r_host_name' => 'Mark Calvert',     'r_room' => 3, 'r_address' => 'Kobenhaven, Gothersgade 95', 'r_phone' => '+380978744565' ]);
    DB::table('appoint-room-list')->insert(['r_id' => 4, 'r_host_name' => 'Torgeir Byrknes',  'r_room' => 4, 'r_address' => 'Kobenhaven, Gothersgade 96', 'r_phone' => '+380978786599' ]);
    DB::table('appoint-room-list')->insert(['r_id' => 5, 'r_host_name' => 'Mark Caro',        'r_room' => 5, 'r_address' => 'Kobenhaven, Gothersgade 97', 'r_phone' => '+380978786538' ]);
	DB::table('appoint-room-list')->insert(['r_id' => 6, 'r_host_name' => 'Edward Stein',     'r_room' => 6, 'r_address' => 'Kobenhaven, Gothersgade 98', 'r_phone' => '+380978786564' ]);


  }
}



//Not used here. Used in {abz_Laravel_6_LTS} as Abz_Employees_Seeder
//fill DB table {students} with data.
/*
class Students_Seeder extends Seeder {
  public function run()
  {
    
	    DB::table('students')->delete();  //whether to Delete old materials
		 
        $faker = Faker::create();

        $gender = $faker->randomElement(['male', 'female']);

    	foreach (range(1,20) as $index) {
		
	
            DB::table('students')->insert([
                'name' => $faker->name($gender),
                'email' => $faker->email,
                'username' => $faker->username,
                'phone' => $faker->phoneNumber,
                'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
				'image' => $faker->image(public_path('images/students'),400,300, null, false), //saving images to 'public/images/students. Takes much time
                //'image' => 'http://loremflickr.com/400/300?random='.rand(1, 100),

            ]);
        }

  } 
} */



//fill DB table {wpressimage_category} with data.

class Wpressimage_category_Seeder extends Seeder {
  public function run()
  {
    
	    DB::table('wpressimage_category')->delete();  //whether to Delete old materials
		
        DB::table('wpressimage_category')->insert(['wpCategory_id' => 1, 'wpCategory_name' => 'News' ]);
		DB::table('wpressimage_category')->insert(['wpCategory_id' => 2, 'wpCategory_name' => 'Art' ]);
		DB::table('wpressimage_category')->insert(['wpCategory_id' => 3, 'wpCategory_name' => 'Sport' ]);
		DB::table('wpressimage_category')->insert(['wpCategory_id' => 4, 'wpCategory_name' => 'Geeks' ]);
		DB::table('wpressimage_category')->insert(['wpCategory_id' => 5, 'wpCategory_name' => 'Drops' ]);
		
        

  } 
} 






//fill DB table {	wpressimages_blog_post} with data.

class WpressImages_blog_Post_Seeder extends Seeder {
  public function run()
  {
    
	    DB::table('wpressimages_blog_post')->delete();  //whether to Delete old materials
		$NUMBER_OF_CATEGORIES = 5;
        $faker = Faker::create();

        $gender = $faker->randomElement(['male', 'female']);

    	foreach (range(1,20) as $index) {
		
	
            DB::table('wpressimages_blog_post')->insert([
                'wpBlog_title' => $faker->name, //$faker->name($gender),
                'wpBlog_text' =>  $faker->realText($maxNbChars = 200, $indexSize = 2), //$faker->text,
                'wpBlog_author' => 1, //$faker->username,
				'wpBlog_category' => rand(1, $NUMBER_OF_CATEGORIES), //random string between min and max numbe
                //'wpBlog_status' => $faker->date($format = 'Y-m-d', $max = 'now'),
				
				//'image' => $faker->image(public_path('images/students'),400,300, null, false), //saving images to 'public/images/students. Takes much time
                //'image' => 'http://loremflickr.com/400/300?random='.rand(1, 100),

            ]);
        }
		
        

  } 
}
