<?php

use Illuminate\Database\Seeder;
//use App\database\seeds\SeedersFiles\ShopSimpleSeeder;

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
		 $this->call('ShopSimpleSeeder');  //fill DB table {shopsimple} with data. SEEDER IS IN SUBFOLDER /SeedersFiles.
		 
		 $this->command->info('Таблица пользователей загружена данными!');
    }
	
	
  
}

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
