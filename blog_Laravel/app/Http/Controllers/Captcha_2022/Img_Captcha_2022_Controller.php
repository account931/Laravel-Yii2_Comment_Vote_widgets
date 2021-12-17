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
	   
		$allImages = array(); //array to contain all images by subfolders in format $allImages = array("Cats"  => array("cat1.jpg", "cat2.jpeg", "cat3.jpg"), "Cars"  => array("car1.jpg", "car2.jpeg", "car3.jpg")); i.e in format => $allImages = array( "folderName1"  => array("img1.jpg", "img2.jpg"), "folderName2"  => array("img1.jpg", "img2.jpg"))
       

	    //Recursive Function to Read all captcha images by path 'images/Captcha_2022'. Read path and all subfolders's images and save to array $allImages in format => $allImages = array( "folderName1"  => array("img1.jpg", "img2.jpg"), "folderName2"  => array("img1.jpg", "img2.jpg")), i.e in format => $allImages = array("Cats"  => array("cat1.jpg", "cat2.jpeg", "cat3.jpg"), "Cars"  => array("car1.jpg", "car2.jpeg", "car3.jpg"));
		function readSubfoldersDirs($path, $subfolderName = null){
            //static $allImages = array(); //array to contain all images by subfolders in format $allImages = array("cats"  => array("cat1.jpg", "cat2.jpeg", "cat3.jpg", "cat4.jpg"),"cars"  => array("car1.jpg", "car2.jpeg", "car3.jpg", "car4.jpg"),);
            global $allImages; //Must have
			
			$tempArr   = array(); //temp array to hold e.g "cats"  => array("cat1.jpg", "cat2.jpeg", "cat3.jpg", "cat4.jpg")
			$tempArr1   = array();
			$b;
			
			
			$dirHandle = opendir($path);
			
            while($item = readdir($dirHandle)) {  
                $newPath = $path."/".$item;
				
				    //if $item is folder
                    if(is_dir($newPath) && $item != '.' && $item != '..') {   // && $item != $path
                        //echo "Found Folder $newPath<br>";  
						//dd($item); //Folder name, eg "boat"
						
						//Fire recursive
                        /*return*/ $b = readSubfoldersDirs($newPath, $item); //return inside a recursive functions. If you use return here it is stopped after the 1st iteration
						//dd($b);
						//array_push($allImages, $b);
					
					//if $item is Not a folder
                    } else{ 
						
						//if $item is an image in subfolder
						if($item != '.' && $item != '..' ) { 
						    //dd("Subfolder name is =>  " . $subfolderName); //$subfolderName is Subfolder name
                            //echo 'Found File ' . $item . '<br>'; //$item is an image name, e.g "cat.jpeg"
							
							//$tempArr[$subfolderName] = $item;
                            array_push($tempArr, $item); //array("boat1.jpg", "boat2.jpg) //works but returns array without name, eg array => ("cat1.jpg", "cat2.jpg), not "cats"  => array("cat1.jpg", "cat2.jpeg")
							
							
							
							
						
                        //if $item is NOT an image in subfolder						
						} else {
							 //echo 'Found Non-File Entity Assert  '.$item.'<br>';
						}
                    }
					
					
            }
			$allImages[$subfolderName] = $tempArr; //$allImages['Boats'] = array("boat1.jpg", "boat2.jpg)
			
			
			//dd($allImages);
			//dd($allImages['Boats'][0]);
			
			return $allImages;
        }








        //Read subfolders
        $readImg = readSubfoldersDirs('images/Captcha_2022');
        //dd($readImg);
        //dd("screw");

        $allImages = $readImg; 
		array_pop($allImages); //Mega Lame Fix, re-write it (deletes the last array element, that happens to be bizzare "")
		//dd($allImages);


	    //Prev manually created array with captcha images. Now created automatically - Reassigned to  function readSubfoldersDirs('images/Captcha_2022')
		/*
        $allImages = array(
		    "cats"  => array("cat1.jpg", "cat2.jpeg", "cat3.jpg", "cat4.jpg"),
			"cars"  => array("car1.jpg", "car2.jpeg", "car3.jpg", "car4.jpg"),
			"boats" => array("boat1.jpg", "boat2.jpg", "boat3.jpg"),
		); */
		//dd($allImages['cats'] );
		
		$categoryLength = count($allImages) - 1; //quantity of categories
		
		$model  = new Img_Captcha_2022(); //model
		$randomNine = $model->randomNineDigits(0, $categoryLength, $allImages); //gets 9 random images
		
		//Chooes/select the check category (images categories user has to select)
		//$checkCategory = $model->getCaptchaCheckCategory(0, $categoryLength, $allImages); //NOT used any more
		$checkCategory = explode("/", $randomNine[0])[0]; //e.g gets "Cars". $randomNine[0] is a 1st elem in $randomNine, e.g "Cars/car1.jpeg", so we split it and take 1st el
		//dd($checkCategory);
		
		//dd($randomNine);
		//getting random 9 images for captcha
		
		
        return view('captcha_2022.index')->with(compact('allImages', 'randomNine', 'checkCategory'));
    }
	
	
	
	
	
	
	
}
