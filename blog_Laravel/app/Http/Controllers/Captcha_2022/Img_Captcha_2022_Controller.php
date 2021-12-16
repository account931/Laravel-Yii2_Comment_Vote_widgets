<?php

namespace App\Http\Controllers\Captcha_2022;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Contracts\Validation\Validator;
//use Illuminate\Support\Facades\Validator; //from ABZ + Controllers/WpBlog_Admin_Part/WpBlog_Admin_Rest_API_Contoller.php

//use Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
//use App\Http\Requests\Polymorphic\PostPolymUpdateRequest; //Validation via Request Class (both for create and update)

use App\Http\Controllers\Controller; //to place controller in subfolder
//use App\models\Elastic_search\Elastic_Posts;        //model for all elastic posts (test posts to perform search
//use App\Http\Requests\Elastic\ElasticUpdateRequest; //Validation via Request Class (both for create and update)
use App\models\Captcha_2022\Img_Captcha_2022; //my model, not connected to DB

class Img_Captcha_2022_Controller extends Controller
{
    public function __construct(){
	    $this->middleware('auth'); //logged users only	   
	}
	
	
	
	/**
     * Show start page with form and ajax self-made image captcha
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {   
	
	    //array with captcha images
        $allImages = array(
		    "cats"  => array("cat1.jpg", "cat2.jpeg", "cat3.jpg", "cat4.jpg"),
			"cars"  => array("car1.jpg", "car2.jpeg", "car3.jpg", "car4.jpg"),
			"boats" => array("boat1.jpg", "boat2.jpg", "boat3.jpg"),
		);
		//dd($allImages['cats'] );
		
		$categoryLength = count($allImages) - 1;
		
		$model  = new Img_Captcha_2022();
		$randomNine = $model->randomNineDigits(0, $categoryLength, $allImages); //gets 9 random images
		
		$checkCategory = $model->getCaptchaCheckCategory(0, $categoryLength, $allImages);
		
		//dd($randomNine);
		//getting random 9 images for captcha
		
		
        return view('captcha_2022.index')->with(compact('allImages', 'randomNine', 'checkCategory'));
    }
	
	
	
	
	
	
	
}
