<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\users; //model for table users, but this model does not contain use Zizaco\Entrust\Traits\EntrustUserTrait; so have no $user->roles() hasMany relations (used in view/showOne)
use App\User; //model for table users. Contains use Zizaco\Entrust\Traits\EntrustUserTrait, so have no $user->roles() hasMany relations (used in view/showOne)
//use Illuminate\Database\Eloquent\Model;
use App\models\wpress_blog_post; //model for all posts



class AllUsersEloquent extends Controller
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
		$f = User::all();
		
        return view('allUsersEloquent.eloquentview', compact('f'));
        //return view('home2');
    }
	
	
	/**
     * Show one user profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function showOne($id)
    {
		//find the user by id
		$userOne = User::where('id', $id)->get();
		
		//find One users article
		$userOneArticles = wpress_blog_post::where('wpBlog_author', $id)->get();
		
        return view('allUsersEloquent.showOne', compact('userOne', 'userOneArticles'));
        
    }
}
