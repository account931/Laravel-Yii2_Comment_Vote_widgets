<?php
//Test for middle, just the like the one implemented in Yii2 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User; //model for Users
use Illuminate\Support\Facades\Auth; //for Auth::check()
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
     * Show start page with prompt to enter email .......
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
        return view('testMiddle.index'/*,  compact('articles', 'categories', 'countArticles')*/);
    }
	
	
	
	
	 /**
     * Gets <form> data via $_POST from {TestMiddleController@index} page ()) and redirects either to custom login or register.  .......
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkMail(Request $request)
    {
		//if $_POST['productID'] is not passed. In case the user navigates to this page by enetering URL directly, without submitting from with $_POST
		if(!$request->input('user-email')){
			throw new \App\Exceptions\myException('Bad request, You are not expected to enter this page.');
		}
		
		
		$rules = [
			'user-email' => ['required', 'email',  ] , 
			//'productID'      => [ 'required', 'integer' ] , 
			
		];
		
	    //creating custom error messages. Should pass it as 3rd param in Validator::make()
	    $mess = [ 'user-email.email' => 'Give us a real email address',];
		
	    $validator = Validator::make($request->all(),$rules, $mess);
	    if ($validator->fails()) {
			return redirect('/testMiddle')->withInput()->with('flashMessageFailX', 'Validation Failed' )->withErrors($validator);
	    }
		
		//gets email from form $_POST[]
		$userMail = $request->input('user-email'); 
		
		if(User::where('email', $request->input('user-email'))->exists()) {
			//User email exists, make login
			return redirect('/customLogin')->with('flashMessageX', "Your email exists, please enter password")->with(compact('userMail'));
		} else {
			//User email Does not exist, make registration
			return redirect('/customRegister')->with('flashMessageX', "Your email is new for us, please register")->with(compact('userMail'));
		}			

       
    }
	
	
	 /**
     * Show custom login page.......
     *
     * @return \Illuminate\Http\Response
     */
    public function customLogin()
    {
		//Case when a user is already Authenticated. In case if the user navigates to this page by enetering URL directly
		if(Auth::check()){
			return redirect('/testMiddle')->withInput()->with('flashMessageX', 'You are successfully logged' ); //->withErrors($validator);
		}
		
		//Case if session()->get('userMail'))  is not passed. I.e if u enetered this page without "->with(compact('userMail')". In case the user navigates to this page by enetering URL directly
		if(!session()->get('userMail')){
			//$text = 'Bad request, You are not expected to enter this page without some session data. Go back to <a href="'. route('testMiddle') . '">Start page</a>.';
			//throw new \App\Exceptions\myException( $text );
			return redirect('/testMiddle')->withInput()->with('flashMessageFailX', 'You are back here from Login page as you had Bad request, You were not expected to enter Login page without e-mail session data' ); //->withErrors($validator);

		}
		
		$mailX = session()->get('userMail'); //gets the email from ->with section {return redirect('/customLogin')->with('flashMessageX', "Your email exists, please enter password")->with(compact('userMail'));}
		
        return view('testMiddle.customLogin',  compact('mailX'));
    }
	
	
	 /**
     * Show custom Register page.......
     *
     * @return \Illuminate\Http\Response
     */
    public function customRegister()
    {
			
		//Case when a user is already Authenticated. In case if the user navigates to this page by enetering URL directly
		if(Auth::check()){
			return redirect('/testMiddle')->withInput()->with('flashMessageX', 'You are successfully registered and logged' ); //->withErrors($validator);
		}
		
		//Case if session()->get('userMail'))  is not passed. I.e if u enetered this page without "->with(compact('userMail')". In case the user navigates to this page by enetering URL directly
		if(!session()->get('userMail')){
			//$text = 'Bad request, You are not expected to enter this page without some session data. Go back to <a href="'. route('testMiddle') . '">Start page</a>.';
			//throw new \App\Exceptions\myException( $text );
			return redirect('/testMiddle')->withInput()->with('flashMessageFailX', 'You are back here from Register page as you had Bad request, You were not expected to enter Register page without e-mail session data' ); //->withErrors($validator);

		}
		
		$mailX = session()->get('userMail'); //gets the email from ->with section {return redirect('/customLogin')->with('flashMessageX', "Your email exists, please enter password")->with(compact('userMail'));}

        return view('testMiddle.customRegister',  compact('mailX'));
    }
}
