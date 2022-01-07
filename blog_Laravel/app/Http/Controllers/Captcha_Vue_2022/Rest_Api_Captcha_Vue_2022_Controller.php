<?php
//REST API Controller for Captcha_Vue_2022
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
use App\models\Captcha_Vue_2022\Img_Captcha_2022; //my model, not connected to DB


class Rest_Api_Captcha_Vue_2022_Controller extends Controller
{
    public function __construct(){
	    //$this->middleware('auth'); //logged users only	
        session_start();		
	}
	
	
	
	
	
	

	
	
	
	
	/**
     * REST API endpoint to /GET, that returns  randomly generated captcha set of 9 images.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getRandomCaptchaSet() 
    { 
	    	
		
        $model  = new Img_Captcha_2022(); //model


        //Read subfolders and get all images.Recursive Function to Read all captcha images by path 'images/Captcha_2022'
        $allImages = $model->readSubfoldersDirs('images/Captcha_2022'); //returns array("Cats"  => array("cat1.jpg", "cat2.jpeg", "cat3.jpg"), "Cars"  => array("car1.jpg", "car2.jpeg", "car3.jpg"));
       
		array_pop($allImages); //Mega Lame Fix, re-write it (deletes the last array element, that happens to be bizzare "")
		//dd($allImages); //final check


	
		
		$categoryLength = count($allImages) - 1; //quantity of categories
		
		
		$randomNine = $model->randomNineDigits(0, $categoryLength, $allImages); //gets 9 random images, i.e ("Cats/cat1.jpg", "Boats/boat2.jpg", "Cars/car3.jpg")
		
		//Choose/select the check category (images categories user has to select)
		//$checkCategory = $model->getCaptchaCheckCategory(0, $categoryLength, $allImages); //NOT used any more
		$checkCategory = explode("/", $randomNine[0])[0]; //e.g gets "Cars". $randomNine[0] is a 1st elem in $randomNine, e.g "Cars/car1.jpeg", so we split it and take 1st el
		//dd($checkCategory);
		
		//dd($randomNine);
		//getting random 9 images for captcha
		
		
	
		//Function to get correct captcha images, i.e user has to choose to pass the captcha
		$correctCaptchaImages = $model->getCorrectImagesSelection($allImages, $randomNine, $checkCategory); //var_dump($correctCaptchaImages);
		//dd($correctCaptchaImages);
		//NOT PASSING IT IN VIEW, SAVE TO SESSION .......................
		Session::put('correctCaptchaSet', json_encode($correctCaptchaImages));	
		
		//dd(session()->get('correctCaptchaSet'));
		
		//Gets the length of check category, i.e how many relevant pictures user has to select to pass the captcha..........
		$checkCategoryLength = count($correctCaptchaImages);
		
		
        return response()->json([
		    'error'               => false,
			'data'                => 'hello',
			'allImg'              => $allImages,           //all images in folder 'images/Captcha_2022'
			'randomNine'          => $randomNine,          //9 random images
			'checkCategory'       => $checkCategory,       //selected category for Captcha
			'checkCategoryLength' => $checkCategoryLength  //number of images user has to find
		]);	
    }
	
	
	
	
	/**
     * REST API endpoint /POST, that checks user's selected images against saved in session randomly generated captcha set of 9 images.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function checkIfCaptchaCorrect() 
    {
		
		//dd(session()->get('correctCaptchaSet'));
		//dd($_POST);
		$request = $_POST;
		$model  = new Img_Captcha_2022(); //model
		$captchaCheckResult = $model->checkIfCaptchaCorrect($request);
		($captchaCheckResult) ? $capthaCorrect = true  : $capthaCorrect= false; //$capthaCorrect = "Solved Captcha Correctly "  : $capthaCorrect= "Solved Captcha Wrong";
		
        return response()->json([
		    'error'          => false,
			//'data'         => 'hello',
			'CaptchaCheck'   => $capthaCorrect	  
    	]);	
	  
	}
	
	
	
	
	
	
	
}
