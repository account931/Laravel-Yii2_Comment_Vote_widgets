<?php
//Test for middle, just the like the one implemented in Yii2 
namespace App\Http\Controllers;

/*
use Illuminate\Http\Request;
use App\models\wpress_blog_post; //model for all posts
use App\models\wpress_category; //model for all wpress_category
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB; //not used
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
*/


class TestMiddleController extends Controller
{
    //public function __construct(){$this->middleware('auth');}
	
	
	
	 /**
     * Show .......
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
        return view('testMiddle.index'/*,  compact('articles', 'categories', 'countArticles')*/);
    }
	
	
	
	
	
	
	
}
