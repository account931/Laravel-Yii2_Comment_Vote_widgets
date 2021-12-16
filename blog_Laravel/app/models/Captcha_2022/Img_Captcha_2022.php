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
    * Function to return 9 random digits
	* @param int $min
    * @param int $max
	* @param array $allImages
    * @return array
    */
	public function randomNineDigits($min, $max, $allImages){
		$randArray = array();
		
		
	
		while(count($randArray ) < 9 ){
			
			
			$randomCategory = rand($min, $max); //get the rabdom category in array $allImages, i.e cats, cars, boats
		
		    $keys = array_keys($allImages); // as long as $allImages is associative array & we can reach only by index i.e $allImages['cats']. In order to reach by int index use array_keys
            //return $allImages[$keys[$randomCategory]][0]; //e.g cats category 1st elem, e.g returns "cat1.jpg"
		    //return count($allImages[$keys[$randomCategory]]); //length, eg 3
		
		
		    //dd($allImages[$keys[$randomCategory]]); //returns the whole array, e.g array:4 [▼0 => "cat1.jpg", 1 => "cat2.jpeg", 2 => "cat3.jpg", 3 => "cat4.jpg"]
			//dd($keys[$randomCategory]); //returns name/key of the array, eg "cats"
				
		    $random = rand($min, count($allImages[$keys[$randomCategory] ]) -1 ); //gets the random int for selected category subarray
			//dd($random);
			//dd($allImages[$keys[$randomCategory]][$random]); //e.g returns "car2.jpg"
		    if ( !in_array($allImages[$keys[$randomCategory]][$random], $randArray)){
			    array_push($randArray, $allImages[$keys[$randomCategory]][$random]);
		    }
			
			
		}
		
		
		
		return $randArray;
	}
	
	
	
	/**
    * Function to get random array category to check captcha
	* @param int $min
    * @param int $max
	* @param array $allImages
    * @return string
    */
	public function getCaptchaCheckCategory($min, $max, $allImages){
		$randomCategory = rand($min, $max); //get the rabdom category in array $allImages, i.e cats, cars, boats
		
		$keys = array_keys($allImages); // as long as $allImages is associative array & we can reach only by index i.e $allImages['cats']. In order to reach by int index use array_keys
        //dd($keys[$randomCategory]); //e.g returns "cars"
		return $keys[$randomCategory]; //e.g returns string $allImages category "cats "
	}
	
}
