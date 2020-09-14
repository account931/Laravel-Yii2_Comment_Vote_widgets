<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\wpress_blog_post; //model
//use App\wpress_blog_post; //model

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
		$articles = wpress_blog_post::all();
        return view('wpBlog.wpblog',  compact('articles'));
    }
}
