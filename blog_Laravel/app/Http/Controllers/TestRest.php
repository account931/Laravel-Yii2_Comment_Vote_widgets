<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\wpress_blog_post; //model for all posts


class TestRest extends Controller
{
	
  /**
   * Display page to test REST Api via ajax (90% is JS)
   * @return \Illuminate\Http\Response
   */
	public function index()
    {
		
		$articles = wpress_blog_post::all(); //Eloquent ORM
		
        return view('testRest.restOne', compact('articles'));
    }
	
	
}
