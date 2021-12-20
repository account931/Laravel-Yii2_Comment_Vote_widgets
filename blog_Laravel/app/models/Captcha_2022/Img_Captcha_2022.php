<?php
//Model 
namespace App\models\Captcha_2022;

use Illuminate\Database\Eloquent\Model;
//use App\models\Polymorphic\Polymorphic_Images;   //model for DB table {polymorphic_images} //Mega Fix
use App\Traits\ElasticSearchMy\Searchable;
 
class Img_Captcha_2022 extends Model
{

	
    /**
    * Connected DB table name.
    *
    * @var string
    */
    //protected $table = 'elastic_search';

    //allow mass assignment
    //protected $fillable = [ 'elast_title', 'elast_text', 'elast_created_at'];  //????? protected $fillable = ['wpBlog_author', 'wpBlog_text', 'wpBlog_author', 'wpBlog_category',  'updated_at', 'created_at'];
    //public $timestamps = false; //to override Error "Unknown Column 'updated_at'" that fires when saving new entry


    /**
    * Function to return 9 random images
	* @param int $min
    * @param int $max
	* @param array $allImages
    * @return array ("Cats/cat1.jpg", "Boats/boat2.jpg", "Cars/car3.jpg") //9 random images
    */
	public function randomNineDigits($min, $max, $allImages){
		$randArray = array();
		
		
	
		while(count($randArray ) < 9 ){
			
			
			$randomCategory = rand($min, $max); //get the rabdom category in array $allImages, i.e cats, cars, boats
		
		    $keys = array_keys($allImages); // as long as $allImages is associative array & we can reach only by index i.e $allImages['cats']. In order to reach by int index use array_keys
            
			//dd($allImages[$keys[$randomCategory]][0]); //e.g cats category 1st elem, e.g returns "cat1.jpg"
		    //return count($allImages[$keys[$randomCategory]]); //length, eg 3
		
		
		    //dd($allImages[$keys[$randomCategory]]); //returns the whole array, e.g array:4 [▼0 => "cat1.jpg", 1 => "cat2.jpeg", 2 => "cat3.jpg", 3 => "cat4.jpg"]
			//dd($keys[$randomCategory]); //returns name/key of the array (name of subfolder), eg "Cats"
			$subFolderName = $keys[$randomCategory]; //returns name/key of the array (name of subfolder), eg "Cats"
			
		    $random = rand($min, count($allImages[$keys[$randomCategory] ]) -1 ); //gets the random int for selected category subarray
			//dd($random);
			//dd($allImages[$keys[$randomCategory]]); // returns the whole array, e.g array("boat1.jpg", "boat2.jpg", "boat3.jpg")
			//dd($allImages[$keys[$randomCategory]][$random]); //e.g returns file name "car2.jpg"
		    if ( !in_array($subFolderName . "/" .$allImages[$keys[$randomCategory]][$random], $randArray)){ //$subFolderName . "/" .$allImages[$keys[$randomCategory]][$random] => folder/fileName => "Boats/boat3.jpg"
			    array_push($randArray,  $subFolderName . "/" .$allImages[$keys[$randomCategory]][$random]); //push folder/fileName => "Boats/boat3.jpg"
		    }
			
			
		}
				
		return $randArray;
	}
	
	
	
	/**
    * Function to get random array category to check captcha. NOT USED //NOT used any more!!!!!!
	* @param int $min
    * @param int $max
	* @param array $allImages
    * @return string
    */
	/*
	public function getCaptchaCheckCategory($min, $max, $allImages){
		$randomCategory = rand($min, $max); //get the rabdom category in array $allImages, i.e cats, cars, boats
		
		$keys = array_keys($allImages); // as long as $allImages is associative array & we can reach only by index i.e $allImages['cats']. In order to reach by int index use array_keys
        //dd($keys[$randomCategory]); //e.g returns "cars"
		return $keys[$randomCategory]; //e.g returns string $allImages category "cats "
	} */
	
	
	
	
	
	
	
	/**
    * Recursive Function to Read all captcha images by path 'images/Captcha_2022'.
	* @param string $path
    * @param string $subfolderName
	* @param 
    * @return array $allImages, i.e $allImages = array( "folderName1"  => array("img1.jpg", "img2.jpg"), "folderName2"  => array("img1.jpg", "img2.jpg")), i.e in format => $allImages = array("Cats"  => array("cat1.jpg", "cat2.jpeg", "cat3.jpg"), "Cars"  => array("car1.jpg", "car2.jpeg", "car3.jpg"));
    */
	 //Recursive Function to Read all captcha images by path 'images/Captcha_2022'. Read path and all subfolders's images and save to array $allImages in format => $allImages = array( "folderName1"  => array("img1.jpg", "img2.jpg"), "folderName2"  => array("img1.jpg", "img2.jpg")), i.e in format => $allImages = array("Cats"  => array("cat1.jpg", "cat2.jpeg", "cat3.jpg"), "Cars"  => array("car1.jpg", "car2.jpeg", "car3.jpg"));
	public function readSubfoldersDirs($path, $subfolderName = null){
		
        //static $allImages = array(); //array to contain all images by subfolders in format $allImages = array("cats"  => array("cat1.jpg", "cat2.jpeg", "cat3.jpg", "cat4.jpg"),"cars"  => array("car1.jpg", "car2.jpeg", "car3.jpg", "car4.jpg"),);
        static $allImages = array(); //"static" is a must-have, otherwise u have to use global $allImages //array to contain all images by subfolders in format $allImages = array("Cats"  => array("cat1.jpg", "cat2.jpeg"), "Cars"  => array("car1.jpg", "car2.jpeg")); i.e in format => $allImages = array( "folderName1"  => array("img1.jpg", "img2.jpg"), "folderName2"  => array("img1.jpg", "img2.jpg"))
			
	    $tempArr    = array(); //temp array to hold e.g "cats"  => array("cat1.jpg", "cat2.jpeg", "cat3.jpg", "cat4.jpg")
	  
		
		$dirHandle = opendir($path); //dd($dirHandle);
		
		

		
		//$files = preg_grep('/^([^.])/', scandir($path));
		
		
        while($item = readdir($dirHandle)) {  //scandir //readdir takes hidden files in consideration too
			
            $newPath = $path."/" . $item; //dd($item);
				
		    //if $item is folder //i.e 'images/Captcha_2022' + '/Cats'
            if(is_dir($newPath) && $item != '.' && $item != '..') {   // && $item != $path
			    //dd($newPath);
                //echo "Found Folder $newPath<br>";  
				//dd($item); //Folder name, eg "boat"
						
				//Fire recursive
                /*return*/ $b = $this->readSubfoldersDirs($newPath, $item); //return inside a recursive functions. If you use return here it is stopped after the 1st iteration
				//dd($b);
				//array_push($allImages, $b);
					
			//if $item is Not a folder
            } else{
                
				
				
			    //if $item is an image in subfolder
				if($item != '.' && $item != '..' ) {  
				    
					//dd($newPath);
					
					
					if($subfolderName == null){
					    throw new \App\Exceptions\myException('File Structure is wrong. There should not be images standalone without folder in root folder.  There must be one root folder containing sub-folders with images.'); 
                    }
					
				    //dd("Subfolder name is =>  " . $subfolderName); //$subfolderName is Subfolder name
                    //echo 'Found File ' . $item . '<br>'; //$item is an image name, e.g "cat.jpeg"
							
					//$tempArr[$subfolderName] = $item;
                    array_push($tempArr, $item); //array("boat1.jpg", "boat2.jpg) //works but returns array without name, eg array => ("cat1.jpg", "cat2.jpg), not "cats"  => array("cat1.jpg", "cat2.jpeg")
							
							
							
							
						
                    //if $item is NOT an image in subfolder						
				} else { 
					continue;
					//echo 'Found Non-File Entity Assert  '.$item.'<br>';
					
				}
            }
					
					
        }
	    $allImages[$subfolderName] = $tempArr; //$allImages['Boats'] = array("boat1.jpg", "boat2.jpg)
			
		//dd(count($allImages));	
		//dd($allImages); //here returns only one 1st array "Boats" => array:3 ["boats1.jpeg", "boats2.jpeg"] as dd() stopps it at 1st iteration
		//dd($allImages['Boats'][0]);
		//array_pop($allImages); //Mega Lame Fix, re-write it (deletes the last array element, that happens to be bizzare "")
		
		
		
	    return $allImages;
    }  




    
    /**
    * Function to get correct captcha images, i.e user has to choose to pass the captcha
	* @param associative array $allImages(all images by subfolders).e.g array("Cats"  => array("cat1.jpg", "cat2.jpeg", "cat3.jpg"), "Cars"  => array("car1.jpg", "car2.jpeg", "car3.jpg"));
    * @param array $randomNine (random 9 images), e.g. array ("Cats/cat1.jpg", "Boats/boat2.jpg", "Cars/car3.jpg")
	* @param string $checkCategor
    * @return array 
    */
	function getCorrectImagesSelection($allImages, $randomNine, $checkCategory ){
		$tempArray = array();
			
		foreach($allImages as $key=>$val){
				
			if($key == $checkCategory ){ //if current loop array name("Cats") == selected category
				
				foreach($val as $imageX){ //$imageX is "cat1.jpg"
						
				    foreach($randomNine as $oneRandomImg){ //$oneRandomImg is "Cats/cat1.jpg"
						$randomImg = explode("/", $oneRandomImg)[1]; //dd($randomImg); //"Cats/cat1.jpg" to "cat1.jpg" 
							
						if($randomImg ==  $imageX){  
							array_push($tempArray, $oneRandomImg);
						}
					}
					
					    
					
				}
			}
				
		}
		return $tempArray;
	}
		
		
		

	
}
