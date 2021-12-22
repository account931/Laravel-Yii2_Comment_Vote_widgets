<?php

namespace App\Http\Controllers\Captcha_Vue_2022;

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


class Img_Captcha_Vue_2022_Controller extends Controller
{
    public function __construct(){
	    $this->middleware('auth'); //logged users only	
        session_start();		
	}
	
	
	
	
	
	

	
	
	
	
	/**
     * Show start page with form and ajax self-made image captcha. Captcha goes as Vue comeponent.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {   
	    //Prev manually created array with captcha images. Now created automatically - Reassigned to  function readSubfoldersDirs('images/Captcha_2022')
		/*
        $allImages = array(
		    "cats"  => array("cat1.jpg", "cat2.jpeg", "cat3.jpg", "cat4.jpg"),
			"cars"  => array("car1.jpg", "car2.jpeg", "car3.jpg", "car4.jpg"),
			"boats" => array("boat1.jpg", "boat2.jpg", "boat3.jpg"),
		); */
		//dd($allImages['cats'] );
		
		
		
        
        return view('captcha_vue_2022.index');//->with(compact('allImages', 'randomNine', 'checkCategory', 'checkCategoryLength'));
    }
	
	
	
	
	
	
	
}
