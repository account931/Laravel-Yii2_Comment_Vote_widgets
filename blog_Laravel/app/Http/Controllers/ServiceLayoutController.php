<?php
//shows my profile (a profile of currently logged user)
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\models\wpress_blog_post; //model for all posts
use App\users;
use Illuminate\Support\Facades\Log; //Logging

class ServiceLayoutController extends Controller
{
    //
	
	public function __construct()
    {
        //$this->middleware('auth');
    }

	
	
	public function index()
    {
		
		
        return view('service-layout.index'); //just return
		//return view('showprofile', compact('$user'));
		//return view('showprofile')->with(compact('id', 'name', 'email', 'yourArticles', 'user'));

    }
}
