<?php

namespace App\Http\Controllers\Elastic;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator; //from ABZ + Controllers/WpBlog_Admin_Part/WpBlog_Admin_Rest_API_Contoller.php

use Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
//use App\Http\Requests\Polymorphic\PostPolymUpdateRequest; //Validation via Request Class (both for create and update)

use App\Http\Controllers\Controller; //to place controller in subfolder
//use App\models\Polymorphic\Polymorphic_Posts;    //model for DB table {polymorphic_posts}
//use App\models\Polymorphic\Polymorphic_Images;   //model for DB table {polymorphic_images}
//use App\models\Polymorphic\Polymorphic_Users;   //model for DB table {polymorphic_images}
use App\models\Elastic_search\Elastic_Posts;        //model for all elastic posts (test posts to perform search
use App\models\ShopSimple\ShopSimple;     //model for DB table 



class ElasticController extends Controller
{
    public function __construct(){
	    $this->middleware('auth');	   
	}
	
	
	
	/**
     * Show start page, both show forms and handles requests
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) 
    { 

		
	    //if user submitted Simple Search 
	    if ($request->has('simpleSearch')) { // equivalent if (isset($search_data) && !empty($search_data) )
			//dd($request->input('simpleSearch'));
		    //dd($request->simpleSearch);
			
			$startMicroSec = microtime(true); //microseconds for Benchmark  
		
		    $product = new Elastic_Posts();
			
			//Elastic search simple alternative
			//THIS IS TRUE only if u decomment the next line => table type must be myISAM, if InnoDB otherwise you will get SQLSTATE[HY000]: General error: 1191 Can't find FULLTEXT index matching the column list
            //$results = $product->whereRaw("MATCH(elast_title, elast_text) AGAINST(? IN BOOLEAN MODE)", [$request->simpleSearch])->get();
			
			$results = Elastic_Posts::where('elast_title', 'LIKE', "%{$request->simpleSearch}%")->orWhere('elast_text', 'LIKE', "%{$request->simpleSearch}%")->get();
			//dd($results);
			
			$endMicroSec = microtime(true); //microseconds for Benchmark
			$benchmarkTime = $endMicroSec - $startMicroSec;
			
			return view('elastic.index')->with(compact('results', 'benchmarkTime')); 
		}
		//End if user submitted Simple Search 
		
		
		
		//if user submitted Elastic Search Search (works on Elastic Cloud, not localhost) -----------------------------------------------------
		//https://github.com/ErickTamayo/laravel-scout-elastic
	    if ($request->has('elastic-search')) { // equivalent if (isset($search_data) && !empty($search_data) )

            $startMicroSec = microtime(true); //microseconds for Benchmark  
			
		    //dd("Elastic search value =>  " . $request->input('elastic-search'));
		    
			
			//dd(env('ElasticPublic_Search_Key')); /check if .env var is available
	
	        //Test Elastic cloud
		
		    //https://www.elastic.co/guide/en/app-search/7.15/authentication.html //Search Api Docs
			
		    //https://myelasticz.ent.us-central1.gcp.cloud.es.io //my endpoint
		    //https://myelasticz.ent.us-central1.gcp.cloud.es.io/as#/engines //my account cabinet
		
		    //WORKING Elastic Cloud ENDPOINTS (works after login(username:elastic, pass: see in txt)) =>
		    // https://myelasticz.ent.us-central1.gcp.cloud.es.io/api/as/v1/engines/  => returns list of documents /GET (via browser)
			//https://myelasticz.ent.us-central1.gcp.cloud.es.io/api/as/v1/engines/my-elastic-enginez /GET 
			//https://myelasticz.ent.us-central1.gcp.cloud.es.io/api/as/v1/engines/my-elastic-enginez/search?query=kingston  => search by word /GET 
		    //End Test Elastic cloud
		
		
		
		    //Elastic Cloud Search via POST (works via /Get as well)
		    //Elastic Cloud Api Keys. SENSITIVE DATA. Gets real values from .env!!!!!!!!
		    $Private_Api_Key   = env('ElasticPrivate_Api_Key');   //.env variable
		    $Public_Search_Key = env('ElasticPublic_Search_Key'); //.env variable
		
		    //construct the url to use in cURL
            $url = "https://myelasticz.ent.us-central1.gcp.cloud.es.io/api/as/v1/engines/my-elastic-enginez/search"; //URL //my-elastic-enginez is my engine
            $authorization = "Authorization: Bearer " . $Public_Search_Key; //Inject the token (Private Api Key) into the header
  
            //cURL Start-> Version for localhost and 000webhost.com, cURL is not supported on zzz.com.ua hosting

            $curl = curl_init();
  
            //curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));//new Inject the token into the header
            //$dataX = '{"id":"' . $this->UUID . '" ,"type": "Feature","geometry": {"coordinates": [' . $myLng . ',' . $myLat . '],"type": "Point"}, "properties": {"title":"' . $myName . '", "description":"' . $myDescript.'"} }'; //MEGA FIX->mega Error was here, {$myName, $myDescript} must be in {""}
            //$dataX = '{"query": "kingston"}';
			$dataX = '{"query":"' . $request->input('elastic-search') . '" }';  

            curl_setopt_array($curl, array(
                CURLOPT_URL            => $url,
	            CURLOPT_HTTPHEADER     => array('Content-Type: application/json' , $authorization ), //Inject the token into the header
                CURLOPT_RETURNTRANSFER => true,
				//CURLOPT_USERPWD => 'user:pass', //authorization variant 2
                CURLOPT_ENCODING       => "",
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST   => "POST",
                CURLOPT_POSTFIELDS      => $dataX,//"{\n  \"customer\" : \"con\",\n  \"customerID\" : \"5108\",\n  \"customerEmail\" : \"jordi@correo.es\",\n  \"Phone\" : \"34600000000\",\n  \"Active\" : false,\n  \"AudioWelcome\" : \"https://audio.com/welcome-defecto-es.mp3\"\n\n}",
                /*CURLOPT_HTTPHEADER => array(
                  "cache-control: no-cache",
                  "content-type: application/json",
                  "x-api-key: whateveriyouneedinyourheader"
                ),*/
            ));
            //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //must option to Kill SSL, otherwise sets an error


            $response = curl_exec($curl);
            $err = curl_error($curl); //return string with last error or if no errof empty string

            curl_close($curl);

            if ($err) {
                //echo "cURL Error #:" . $err;
				//$elasticResults = "cURL Error #:" . $err;
				throw new \App\Exceptions\myException("cURL Exception happened while Elastic Cloud Search " . $err);

            } else {
                //echo "<p> FEATURE STATUS=></p><p>Below is response from API-></p>";
                //echo "Elastic Cloud response is => " . $response;
				$elasticResults = $response;
            }
			
			$elasticResults = json_decode($elasticResults, false);//Decode the result from JSON to array or object,  true used for ARRAY [], not  used  for OBJECT '->'
			//dd($elasticResults); //to see response structure
		    //dd($elasticResults['results'][0]['_meta']['engine']); //if 2nd json_decode() arg is true, i.e returns array
			//dd($elasticResults->results[0]->_meta->engine);         //if 2nd json_decode() is false, i.e returns object
			
			$endMicroSec = microtime(true); //microseconds for Benchmark
			$benchmarkTime = $endMicroSec - $startMicroSec;
			
			return view('elastic.index')->with(compact('elasticResults', 'benchmarkTime')); 
		}
		//End if user submitted Elastic Search Search (works on Elastic Cloud, not localhost)  -----------------------------------------
		
		
		//if no Serach is submitted, just render the view
        return view('elastic.index');
    }
	
	
	
	
	
	 /**
     * Page to show one product (table{elast_search}), when user clicked on link in Elastic Cloud Search Result List 
	 * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function showOneProduct($id)
    { 
	    //additional check in case user directly intentionally navigates to this URL with not-existing ID
	    if (!Elastic_Posts::where('elast_id', $id)->exists()) { 
	        throw new \App\Exceptions\myException('Product ' . $id . ' does not exist in table {elast_search}');
	    }
		
		//find the product by id
		$productOne = Elastic_Posts::where('elast_id', $id)->get();
		
		//$model = new ShopSimple(); //to call model method, e.g truncateTextProcessor($text, $maxLength)
	    
		
		return view('elastic.showOneProduct')->with(compact('productOne', 'model')); 
	}
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 /**
     * Do Elastic Undexing here. Index all the table. Suitable when index a table for the first time. When index already exists and u run this it just updates everything as ID are the same
     * @return \Illuminate\Http\Response
	 * https://www.elastic.co/guide/en/app-search/current/documents.html
     */
    public function doElasIndexing()
    { 
	    //dd("Index");
		
		$tableResults = Elastic_Posts::all(); //get all the DB table data
		//dd($tableResults);
		
		//construct the url to use in cURL
        $url = "https://myelasticz.ent.us-central1.gcp.cloud.es.io/api/as/v1/engines/my-elastic-enginez/documents"; //URL //my-elastic-enginez is my engine
        $authorization = "Authorization: Bearer " . env('ElasticPrivate_Api_Key'); //Inject the token (Private Api Key) into the header
  
            //cURL Start-> Version for localhost and 000webhost.com, cURL is not supported on zzz.com.ua hosting

            $curl = curl_init();
  
            //$dataX = '{"id":"' . $this->UUID . '" ,"type": "Feature","geometry": {"coordinates": [' . $myLng . ',' . $myLat . '],"type": "Point"}, "properties": {"title":"' . $myName . '", "description":"' . $myDescript.'"} }'; //MEGA FIX->mega Error was here, {$myName, $myDescript} must be in {""}
            //$dataX = '{"query": "kingston"}';
			//$dataX = '{"query":"' . $request->input('elastic-search') . '" }';  
			//$dataX = '[ {"id": 1, "shop_id":"19","shop_title":"NameXZZZ", "shop_price":"2","shop_currency":"$","shop_descr":"CANO AF","shop_categ":"1","shop_created_at":"2020-12-03 15:57:15","sh_device_type":"Camera"} ]';


            //construct the data (array of arrays) to be used in cURL POST (to be indexed)
			$dataX = array(); //final array of arrays to contain all data, e.g [ ["id" => 1, "elast_title" => "text1"], ["id" => 2, "elast_title" => "text2"] ] 
			
			foreach($tableResults as $t ){
				//mandatory specify the id key (same as SQL table row id), otherwise the ElasticCloud will generate it by itself (e.g "doc-4545") and we won't be able to update and when making the whole table indexing if prev index exists, it will not update it but create dublicates
			   $temp = [ "id" => $t->elast_id, "elast_title" => $t->elast_title, "elast_text" => $t->elast_text, "elast_created_at" => $t->elast_created_at ] ;
               array_push($dataX, $temp );
			}
			
			
			$dataX = json_encode($dataX); //converts array [ ["id" => 1, "elast_title" => "text1"], ["id" => 2, "elast_title" => "text2"] ] to json
			//dd($dataX);

            curl_setopt_array($curl, array(
                CURLOPT_URL            => $url,
	            CURLOPT_HTTPHEADER     => array('Content-Type: application/json' , $authorization ), //Inject the token into the header
                CURLOPT_RETURNTRANSFER => true,
				//CURLOPT_USERPWD => 'user:pass', //authorization variant 2
                CURLOPT_ENCODING       => "",
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST   => "POST",
                CURLOPT_POSTFIELDS      => $dataX,//"{\n  \"customer\" : \"con\",\n  \"customerID\" : \"5108\",\n  \"customerEmail\" : \"jordi@correo.es\",\n  \"Phone\" : \"34600000000\",\n  \"Active\" : false,\n  \"AudioWelcome\" : \"https://audio.com/welcome-defecto-es.mp3\"\n\n}",
                /*CURLOPT_HTTPHEADER => array(
                  "cache-control: no-cache",
                  "content-type: application/json",
                  "x-api-key: whateveriyouneedinyourheader"
                ),*/
            ));
            //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //must option to Kill SSL, otherwise sets an error


            $response = curl_exec($curl);
            $err = curl_error($curl); //return string with last error or if no errof empty string

            curl_close($curl);

            if ($err) {
                //echo "cURL Error #:" . $err;
				//$elasticResults = "cURL Error #:" . $err;
				throw new \App\Exceptions\myException("cURL Exception happened while Elastic Cloud Search " . $err);

            } else {
                //echo "<p> FEATURE STATUS=></p><p>Below is response from API-></p>";
                echo "Index was created successfully. Elastic Cloud response is => " . $response;
				$elasticResults = $response;
            }
			
	}
	
}
