<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\users;
//use Illuminate\Database\Eloquent\Model;



class HomeController2 extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');  //i.e ACF in Yii2, let only logged users
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	
    }
	
	
	 /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function eloquentt()
    {
		$f = users::all();
		
        return view('eloquentview', compact('f'));
        //return view('home2');
    }
	
}
