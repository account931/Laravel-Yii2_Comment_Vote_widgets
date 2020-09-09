<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\users;

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
					
		    if(Auth::check()){
                $user = Auth::user();
                // Get the currently authenticated user's ID...
               //$id = Auth::id();	
               $id = auth()->user()->id;
			   $name = auth()->user()->name;
			   $email = auth()->user()->email;
			} else {
				$id = "Not logged, No ID";
				$name = "Not logged, No Name";
				$email = "No email";
			}				
					
        //return view('showprofile'); //just return
		//return view('showprofile', compact('$user'));
		return view('showprofile')->with(compact('id', 'name', 'email'));

    }
}
