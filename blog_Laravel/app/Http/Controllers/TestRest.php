<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\wpress_blog_post; //model for all posts
use App\models\wpress_category; //model for all wpress_category


class TestRest extends Controller
{
	
  /**
   * Display page to test REST Api via ajax (90% is JS)
   * @return \Illuminate\Http\Response
   */
	public function index()
    {
		
		$articles   = wpress_blog_post::all(); //Eloquent ORM to create dropdown with article to select to be fetched by ajax
		$categories = wpress_category::all();
		
        return view('testRest.restOne', compact('articles', 'categories'));
    }
	
	
}
