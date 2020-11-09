<?php
//shows my profile (a profile of currently logged user)
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\models\wpress_blog_post; //model for all posts
use App\users;
use Illuminate\Support\Facades\Log; //Logging

class ShowProfile extends Controller
{
    //
	
	public function __construct()
    {
        //$this->middleware('auth');
    }

	
	
	public function index()
    {
			//$user1 = auth()->user();
			//$userName = $this->auth->user(); //$user1->name;
			
			//$userInfo = users::find(Auth::id())->with('personalInfo')->first();
                    //print($user->id);
                    //print($user->name);
			
            //logging
			Log::info('ShowProfile is visited by user"s IP  ' . $_SERVER['REMOTE_ADDR']);
				
		    if(Auth::check()){
                $user = Auth::user();
                // Get the currently authenticated user's ID...
                //$id = Auth::id();	
                $id = auth()->user()->id;
			    $name = auth()->user()->name;
			    $email = auth()->user()->email;
				
			} else {
				$text = 'You are not logged, <a href="'. route('login') . '"> click here  </a>  to login';
			    throw new \App\Exceptions\myException( $text ); //my custom exception
		        //throw new \App\Exceptions\myException('You are not logged, do it firstly.'); //my custom exception

                //return "You can't access here!";
				//abort(403, 'Unauthorized action.');
			    //throw new ModelNotFoundException('User not found by ID ' );
                //dd('hhhh');
				//throw new ModelNotFoundException('User not found by ID ');

                //below is not used
				$id = "Not logged, No ID";
				$name = "Not logged, No Name";
				$email = "No email";
			}				
		
		//get all your articles
		$yourArticles = wpress_blog_post::where('wpBlog_author', auth()->user()->id)->get();
		
        //return view('showprofile'); //just return
		//return view('showprofile', compact('$user'));
		return view('showprofile')->with(compact('id', 'name', 'email', 'yourArticles', 'user'));

    }
}
