<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\wpress_blog_post; //model for all posts
use App\models\wpress_category; //model for all wpress_category

use Illuminate\Support\Facades\DB;


class WpBlog extends Controller
{
    //
	 /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//$articles = wpress_blog_post::all(); //Eloquent ORM
		$articles = wpress_blog_post::where('wpBlog_status', '1')->get();
		$categories = wpress_category::all();//for dropdown
		
	if (!isset($_GET['category'])){ $articles = wpress_blog_post::where('wpBlog_status', '1')->get();}
		
		if(isset($_GET['category']) && $_GET['category'] == 1 ){
			$articles = wpress_blog_post::where('wpBlog_status', '1')->where('wpBlog_category', 1)->get();
		}
		
		if(isset($_GET['category']) && $_GET['category'] == 2 ){
			$articles = wpress_blog_post::where('wpBlog_status', '1')->where('wpBlog_category', 2)->get();
		}
		
		if(isset($_GET['category']) && $_GET['category'] == 3 ){
			$articles = wpress_blog_post::where('wpBlog_status', '1')->where('wpBlog_category', 3)->get();
		}
		
        return view('wpBlog.wpblog',  compact('articles', 'categories'));
    }
}
