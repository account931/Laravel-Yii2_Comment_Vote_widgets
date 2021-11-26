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
//use App\models\ShopSimple\ShopSimple;     //model for DB table 
use App\Http\Requests\Elastic\ElasticUpdateRequest; //Validation via Request Class (both for create and update)


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
        $allTableResults = Elastic_Posts::paginate(2); //get all the DB table data for Gii CRUD PAnel
		
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
			
			return view('elastic.index')->with(compact('results', 'benchmarkTime', 'allTableResults')); 
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
			
			return view('elastic.index')->with(compact('elasticResults', 'benchmarkTime', 'allTableResults')); 
		}
		//End if user submitted Elastic Search Search (works on Elastic Cloud, not localhost)  -----------------------------------------
		
		
		//if no Serach is submitted, just render the view
        return view('elastic.index')->with(compact('allTableResults'));
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
	    //NEED ADDITIONALLY IMPLEMENT HERE INDEXING BY MORE MORE THAN 100 DOCUMENTS (DOUBLE LOOP)!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		
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
			
			
			$dataX = json_encode($dataX); //converts array [ ["id" => 1, "elast_title" => "text1"], ["id" => 2, "elast_title" => "text2"] ] to json '{"id": 1, "elast_title": "text1"}, {"id": 2, "elast_title": "text2"} '
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
	
	
	
	
	
	/**
     * Display form to edit an existing product(to trigger and test an Observer indexing an updated entry) 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function editProduct($id)
    { 
	    //additional check in case user directly intentionally navigates to this URL with not-existing ID
	    if (!Elastic_Posts::where('elast_id', $id)->exists()) { 
	        throw new \App\Exceptions\myException('Product ' . $id . ' does not exist');
	    }
		
		//find the product by id
		$productOne = Elastic_Posts::where('elast_id', $id)->get();
		
		return view('elastic.edit-product')->with(compact('productOne'));  
	}
	
	
	
	
	
	
	/**
     * $_PUT request to update/edit a one single post
     * @param  \Illuminate\Http\PostPolymUpdateReques  $request
     * @return \Illuminate\Http\Response
	 *
     */
	 
    public function updateProduct (ElasticUpdateRequest $request)
	{
		//dd($request->all()); //all form input (is shown always even if validation fails)
		
	
		//commented {function withValidator} and decommented {function failedValidation} in Requests\Polymorphic\PostPolymUpdateRequest in order if Validation fails, the Controller will still execute code
		//if validation fails
		if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->withInput()->with('flashMessageFailX', 'Validation Failedd!!!' )->withErrors($request->validator->messages()); //Error was here ->withErrors($validator);
		    
			/*
			return response()->json([
               'error' => true, 
               'data' => 'Was seem to be OK, but validation crashes', 
               'validateErrors'=>  $request->validator->messages()]);
			*/
		}
		
		
		//$request->input('role_sel'); vs $request->all()
		return "Validation is OK";
		
		
		/*
		//additional check in case user directly intentionally navigates to  ../blog_Laravel/public/delete/12 to not his record
	        try{
	            $articleOne = wpress_blog_post::where('wpBlog_id',$id)->firstOrFail(); //find the article by id  ->firstOrFail();
	        } catch (\Exception $e) {
	            //if(!$articleOne){
	            throw new \App\Exceptions\myException('Article does not exist');
	        }
		*/
		
		//dd($request->all());
		//dd($request->input('product-name'));
		//dd($request->image->getSize() . ' byte'); //image size
		
		$form_data = array(
            'post_name'      =>  $request->input('product-name'), //DB column => input name
            'post_text'      =>  $request->input('product-desr'),
			'author_id'      =>  $request->input('article-author'), //$request->article-author, //won't work
			
			/*
			'phone'       =>  $request->user_phone,
			'username'    =>  $request->user_n,
			'rank_id'     =>  $request->user_rank,
			'superior_id' =>  $request->user_superior,
			'salary'      =>  $request->user_salary,
			'hired_at'    =>  $request->user_hired_at,
			'image'       =>  $imageName, //$request->image,
			*/
        );    

        //Updating the Post (table {polymorphic_posts}) 
        if (Polymorphic_Posts::whereId($request->input('hidden-prod-id'))->update($form_data)) { //request->hidden-prod-id
            
			if(!$request->has('remember')) { //code below if only user did not ticked "Do not update image"
				
			    //remove the prev image from folder (100%).........
			    //delete a prev/old image from folder '/images/polymorphic/'
		        $product = Polymorphic_Images::where('imageable_id', $request->input('hidden-prod-id'))->first(); //found image 
		    
			    $pieces = explode("/images/polymorphic/", $product->url); //as db column saves image url as "/images/polymorphic/someName" we need to "someName" first
			    if(file_exists(public_path('images/polymorphic/' . $pieces[1]))){ //$pieces[1] is an image name without "/images/polymorphic/
		            \Illuminate\Support\Facades\File::delete('images/polymorphic/' . $pieces[1]);
		        }
			
			
			
			
			    //update the image in table Polymorphic_Images ------------------------------------------
			
			    //getting Image info for Flash Message
		        $imageName      = time(). '_' . $request->image->getClientOriginalName();
		        $sizeInByte     = $request->image->getSize() . ' byte';
		        $sizeInKiloByte = round( ($request->image->getSize() / 1024), 2 ). ' kilobyte'; //round 10.55364364 to 10.5
		        $fileExtens     =     $request->image->getClientOriginalExtension();
		        //getting Image info for Flash Message
			
			    //Move uploaded image to the specified folder 
		        request()->image->move(public_path('images/polymorphic'), $imageName);
		
		        //update image itself, table { polymorphic_images}
			    Polymorphic_Images::where('imageable_id', $request->input('hidden-prod-id') )->update([  'url' => '/images/polymorphic/' . $imageName, /* 'wpBlog_title' => $data['title'], */  ]);
            
			} else { // end if(!$request->has('remember')) 
			    $imageName  = " User opted not to update the imaged";
			    $sizeInByte = "";
			}
			
			//End update the image in table Polymorphic_Images -------------------------------------



			
			
			//return response()->json(['success' => 'Data is successfully updated.]); //Version for JSON
			return redirect()->back()->withInput()->with('flashMessageX', 'Data is successfully updated! Connected image is: <b> ' . $imageName . ' ' . $sizeInByte  . ' </b>');

		} else {
			//return response()->json(['success' => 'Failed to update']);             //Version for JSON
			return redirect()->back()->withInput()->with('flashMessageFailX', 'Failed to update!!!' );


		}
	}
	
	
	
	
}
