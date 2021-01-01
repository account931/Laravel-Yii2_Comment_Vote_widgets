<?php
//Rest Api with access by token only
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


class TokenGuardController extends Controller
{
    //public function __construct(){$this->middleware('auth');}
	
	
	
	 /**
     * Show .......
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
        return view('tokenGuard.index'/*,  compact('articles', 'categories', 'countArticles')*/);
    }
	
	
	
	
	
	
	
}
