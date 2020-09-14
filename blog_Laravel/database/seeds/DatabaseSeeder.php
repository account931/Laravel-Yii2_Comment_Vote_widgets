<?php

use Illuminate\Database\Seeder;

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
		 $this->call('Wpress_blog_post_Seeder');
         $this->call('WpressCategory_Seeder');
         $this->command->info('Таблица пользователей загружена данными!');
    }
	
	
  
}


class Wpress_blog_post_Seeder extends Seeder {

  public function run()
  {
    DB::table('wpress_blog_post')->delete();  //if Delete old materials

    //User::create(['email' => 'foo@bar.com']);
    DB::table('wpress_blog_post')->insert(['wpBlog_title' => 'Setting  Enum in PhpMyAdmin', 'wpBlog_text' => "Setting  Enum in SQL\r\nunder your phpmyadmin\r\n\r\nchoose enum\r\n\r\nin Length/Values column put there : ''0'' ,''1''\r\n\r\nand your done ", 'wpBlog_author' => 2, 'wpBlog_category' =>1 ]);
	DB::table('wpress_blog_post')->insert(['wpBlog_title' => 'Milgram experiment', 'wpBlog_text' => 'The Milgram experiment on obedience to authority figures was a series of social psychology experiments conducted by Yale University psychologist Stanley Milgram. They measured the willingness of study participants, men from a diverse range of occupations with varying levels of education, to obey an authority figure who instructed them to perform acts conflicting with their personal conscience. Participants were led to believe that they were assisting an unrelated experiment, in which they had to administer electric shocks to a "learner." These fake electric shocks gradually increased to levels that would have been fatal had they been real', 'wpBlog_author' => 2, 'wpBlog_category' =>3 ]);
    DB::table('wpress_blog_post')->insert(['wpBlog_title' => 'Milgram results', 'wpBlog_text' => 'The extreme willingness of adults to go to almost any lengths on the command of an authority constitutes the chief finding of the study and the fact most urgently demanding explanation.\r\n\r\nOrdinary people, simply doing their jobs, and without any particular hostility on their part, can become agents in a terrible destructive process. Moreover, even when the destructive effects of their work become patently clear, and they are asked to carry out actions incompatible with fundamental standards of morality, relatively few people have the resources needed to resist authority', 'wpBlog_author' => 2, 'wpBlog_category' =>2 ]);
  }
}


class WpressCategory_Seeder extends Seeder {

  public function run()
  {
    DB::table('wpress_category')->delete();  //if Delete old materials

    //User::create(['email' => 'foo@bar.com']);
    DB::table('wpress_category')->insert(['wpCategory_id' => 1, 'wpCategory_name' => 'General' ]);
	DB::table('wpress_category')->insert(['wpCategory_id' => 2, 'wpCategory_name' => 'Science' ]);
	DB::table('wpress_category')->insert(['wpCategory_id' => 3, 'wpCategory_name' => 'Tips and Tricks' ]);



	


  }
}