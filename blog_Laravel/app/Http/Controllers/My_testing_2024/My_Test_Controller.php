<?php

namespace App\Http\Controllers\My_testing_2024;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Contracts\Validation\Validator;
//use Illuminate\Support\Facades\Validator; //from ABZ + Controllers/WpBlog_Admin_Part/WpBlog_Admin_Rest_API_Contoller.php
use Illuminate\Support\Facades\Session;
//use Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
//use App\Http\Requests\Captcha_2020\FormValidateRequest; //Form Validation via Request Class 

use App\Http\Controllers\Controller; //to place controller in subfolder
//use App\models\Elastic_search\Elastic_Posts;        //model for all elastic posts (test posts to perform search
//use App\Http\Requests\Elastic\ElasticUpdateRequest; //Validation via Request Class (both for create and update)
//use App\models\Captcha_2022\Img_Captcha_2022; //my model, not connected to DB


class My_Test_Controller extends Controller
{
    public function __construct(){
	    $this->middleware('auth'); //logged users only	
        session_start();		
	}
	
	
	/**
     * Show start page with my testing stuff
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {   
	    $a = '1112031584';
		$s = '';
		//dd(strlen($a));
		//dd(3 % 2);
		
		for ($i = 1; $i < strlen($a); $i++){
			
			if($a[$i] % 2 == $a[$i -1]){
				$s.= max($a[$i], $a[$i -1]);
			} 
		}
		
		
        return view('myTesting_2024.index')->with(compact('s'));//->with(compact('allImages', 'randomNine', 'checkCategory', 'checkCategoryLength'));
    }
	
	
	
	
	
	
	
}
