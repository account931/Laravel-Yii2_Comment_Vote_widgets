<?php

namespace App\Http\Controllers\Captcha_2022;

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
use App\Http\Requests\Captcha_2020\FormValidateRequest; //Form Validation via Request Class 

use App\Http\Controllers\Controller; //to place controller in subfolder
//use App\models\Elastic_search\Elastic_Posts;        //model for all elastic posts (test posts to perform search
//use App\Http\Requests\Elastic\ElasticUpdateRequest; //Validation via Request Class (both for create and update)
use App\models\Captcha_2022\Img_Captcha_2022; //my model, not connected to DB


class Img_Captcha_2022_Controller extends Controller
{
    public function __construct(){
	    $this->middleware('auth'); //logged users only	
        session_start();		
	}
	
	
	
	
	
	



   
   
 
	
	
	
	
	/**
     * Show start page with form and ajax self-made image captcha
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
		
		
		//Gets the length of check category, i.e how many relevant pictures user has to select to pass the captcha..........
		$checkCategoryLength = count($correctCaptchaImages);

        return view('captcha_2022.index')->with(compact('allImages', 'randomNine', 'checkCategory', 'checkCategoryLength'));
    }
	
	
	
	
	
	
	/**
     * Fucntion to handle form $_POST, checks validation + check if captcha is correct
     * @param FormValidateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function checkCaptcha(FormValidateRequest $request) //Validate via Request Class  //Request $request
    {   
	
	    //commented {function withValidator} and decommented {function failedValidation} in Requests\Polymorphic\PostPolymUpdateRequest in order if Validation fails, the Controller will still execute code
		//if validation fails
		if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->withInput()->with('flashMessageFailX', '<i class="fa fa-exclamation-circle" style="font-size:48px;color:red"></i> Validation Failed!!! ' )->withErrors($request->validator->messages()); //Error was here ->withErrors($validator);
		    
			/*
			return response()->json([
               'error' => true, 
               'data' => 'Was seem to be OK, but validation crashes', 
               'validateErrors'=>  $request->validator->messages()]);
			*/
		}
		
		
		
	    //Function to check user's captcha and Server-side correct answer
		$model  = new Img_Captcha_2022(); //
		if($model->checkIfCaptchaCorrect($request) == true){
			//All is good, do here what ever you want with form inputs.....
			//...................
			return "Captcha was successfully solved!!! Validation was also OK (was runned before captcha check. Do further what u want....)";
		} else {
		    return redirect()->back()->withInput()->with('flashMessageFailX', 'Captcha is incorrect. Try harder !!!' ); //->withErrors($request->validator->messages()); //Error was here ->withErrors($validator);
		}
	}
	
	
	
}
