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
	    $this->middleware('auth'); //logged users only	   
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

            //dd(env('ElasticPublic_Search_Key')); //check if .env var is available, if returns null =>  php artisan config:cache   php artisan config:clear (or key expired)
            $startMicroSec = microtime(true); //microseconds for Benchmark  
			
		    //dd("Elastic search value =>  " . $request->input('elastic-search'));
		    
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
     * Do Elastic Indexing here. Index all the table colims. Suitable when index a table for the first time. When index already exists and u run this it just updates everything as ID are the same
     * @return \Illuminate\Http\Response
	 * https://www.elastic.co/guide/en/app-search/current/documents.html
     */
    public function doElasIndexing()
    { 
	    //NEED ADDITIONALLY IMPLEMENT HERE INDEXING BY MORE MORE THAN 100 DOCUMENTS (DOUBLE LOOP)!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
				
		$tableResults = Elastic_Posts::all(); //get all the DB table data. Type: Object
		//dd($tableResults);
		//dd(gettype($tableResults));
		
		//construct the url to use in cURL
        $url = "https://myelasticz.ent.us-central1.gcp.cloud.es.io/api/as/v1/engines/my-elastic-enginez/documents"; //URL //my-elastic-enginez is my engine
        $authorization = "Authorization: Bearer " . env('ElasticPrivate_Api_Key'); //Inject the token (Private Api Key) into the header
  
            //According to Elastic Documnentation you can index no more than 100 documents (i.e 100 DB rows) at one request. So split index table columns by 100 batch and sens each batch separately via cURL
			$maxBatch = 100;//max amount of documents (i.e DB rows) allowed by one request (restricted by Elastic Documnentation)
			for($i = 0; $i < count($tableResults); $i+=100){ //iteration by 100 increment, 1st $i==0, 2nd  $i==100, 3rd $i==200, etc
				
				for($j = $i; $j < count($tableResults); $j++){ //iteration starts by $i (e.g, 0, 100, 200, etc), $j is just ++1 , (e.g if $i==100. $j will be 100, 101, 102, etc)
					
					//get dataX and cURL
			
			
  
                    //$dataX = '{"id":"' . $this->UUID . '" ,"type": "Feature","geometry": {"coordinates": [' . $myLng . ',' . $myLat . '],"type": "Point"}, "properties": {"title":"' . $myName . '", "description":"' . $myDescript.'"} }'; //MEGA FIX->mega Error was here, {$myName, $myDescript} must be in {""}
                    //$dataX = '{"query": "kingston"}';
			        //$dataX = '{"query":"' . $request->input('elastic-search') . '" }';  
			        //$dataX = '[ {"id": 1, "shop_id":"19","shop_title":"NameXZZZ", "shop_price":"2","shop_currency":"$","shop_descr":"CANO AF","shop_categ":"1","shop_created_at":"2020-12-03 15:57:15","sh_device_type":"Camera"} ]';

                   

                    //construct the data (array of arrays) to be used in cURL POST (to be indexed)
			        $dataX = array(); //final array of arrays to contain all data, e.g [ ["id" => 1, "elast_title" => "text1"], ["id" => 2, "elast_title" => "text2"] ] 
			        
				    //$tableResults1 = (array)$tableResults; //typecast Object to array, as slice aceepts array only
					//$tempo_One_Hundred_array = array_slice($tableResults1, $i, $i+=100); //create a temp array with length no more than 100
					//dd($tempo_One_Hundred_array);
					//$tempo_One_Hundred_array1 = (object)$tempo_One_Hundred_array; //typecast  array back to Object
					
					//Calculate the loop start and end values, as we can't take/put more than 100 records to array $dataX (and send via cURL). E.g we have 102 records, for first $i loop($i==0), we will have start==0, end==100. For second $i loop($i==100), we will have start==100, end==102
			        //foreach($tableResults as $t ){
					if(count($tableResults) - ($maxBatch * $i) >= $maxBatch){ // if current loop still have 100 records to take
						$iteratorX = $maxBatch + ($maxBatch * $i);
						
					} else { // if current loop has LESS THAN 100 records, e.g if has only 40 records, e.g if count($tableResults) == 240 and it is the 2nd $i loop, i.e Si == 200 and we have to cover only 40 records not 100 
						$it = count($tableResults) - ($maxBatch * $i);
						$iteratorX = ($maxBatch * $i) + $it;
					}
					//Fill in array $dataX with data (with calculated start, end loop values)
					for($k = $i; $k < $iteratorX ; $k++){  //count($tableResults)
				        //mandatory specify the id key (same as SQL table row id), otherwise the ElasticCloud will generate it by itself (e.g "doc-4545") and we won't be able to update and when making the whole table indexing if prev index exists, it will not update it but create dublicates
			            //$temp = [ "id" => $t->elast_id, "elast_title" => $t->elast_title, "elast_text" => $t->elast_text, "elast_created_at" => $t->elast_created_at ] ;
                        $temp = [ "id" => $tableResults[$k]->elast_id, "elast_title" => $tableResults[$k]->elast_title, "elast_text" => $tableResults[$k]->elast_text, "elast_created_at" => $tableResults[$k]->elast_created_at ] ;
						array_push($dataX, $temp);
			        }
			
			
			        $dataX = json_encode($dataX); //converts array [ ["id" => 1, "elast_title" => "text1"], ["id" => 2, "elast_title" => "text2"] ] to json '{"id": 1, "elast_title": "text1"}, {"id": 2, "elast_title": "text2"} '
			        //dd($dataX);



                } //end for loop 2 ($j)
                    
					//Send cURL to Elastic Cloud to upload 100 documents indexes. E.g => We have 102 records, for first $i loop($i==0), we send first 100 documnets. For second $i loop($i==100), we send only 2 left documents
                    //cURL Start-> Version for localhost and 000webhost.com, cURL is not supported on zzz.com.ua hosting
                    $curl = curl_init();
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
                        echo "Index was for all table was created successfully. Elastic Cloud response is => " . $response;
				        $elasticResults = $response;
                    }
				
			} //for loop 1 ($i)
			
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
	 
    public function updateProduct (ElasticUpdateRequest $request, $id)
	{
		//just to test Observer on delete event
		//Elastic_Posts::where('elast_id',999)->first()->delete();
		//return "false";
		
		
		//dd($id);
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
		//return "Validation is OK";
		
		
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
            'elast_title'      =>  $request->input('product-name'), //DB column => input name
            'elast_text'       =>  $request->input('product-desr'),
			'elast_created_at' =>  Carbon::now()->format('Y-m-d H:i:s'),
			      
			//'author_id'      =>  $request->input('article-author'), //$request->article-author, //won't work
			
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

        //dd($request->input('hidden-prod-id'));
        //Updating the Post (table {Elastic_Posts})  
        if (Elastic_Posts::where('elast_id', $id /*$request->input('hidden-prod-id')*/ )->update($form_data)) { //can use both $id or $request->input('hidden-prod-id') (/id vs hidden input)
            
		    //Update the one document index on Elastic Cloud (on one Post update)
			//Was intendent to implement this indexing via Observer ElasticSearchObserver and trait Searchable injected in Model, but for some bizzare reason Updating event is not triggered in Obserever. While testin worked only Deleted Event and only if use this construction Elastic_Posts::where('id',999)->first()->delete();
		    $model = new Elastic_Posts();
		    if ($r = $model->updateOneElasticCloudIndex($id, $request)){ 
                $r = json_decode($r); //decode json to Object			
			    //dd($r);
				if(!empty($r->error)){ //if Elastic Rest API response returns any error
					//dd("api error");
					return redirect()->back()->withInput()->with('flashMessageFailX', '<i class="fa fa-exclamation-triangle" style="font-size:28px;color:red"></i> Data was successfully updated but Elastic cloud indexing a post faild. Elastic Api error is => <b> ' .  $r->error . ' </b>');

				} else { //if Elastic Rest API response returns NO error, meaning all os OK
				    //check if 14-days trial ends and Elastic Cloud returns {"ok": false, message: "Unknown resource"} 
				    if($r->ok == false){
						return redirect()->back()->withInput()->with('flashMessageFailX', 'Data is successfully updated, But Elastic cloud index failed due to Elastic error => <b>' . $r->message . '</b>. Probably 14-days trial ends.');
					
					} else { 
					    //Everything is OK
					    //dd("NO api error");
					    return redirect()->back()->withInput()->with('flashMessageX', 'Data is successfully updated! Elastic cloud index was successfully updated as well');
                        //return response()->json(['success' => 'Data in table Elastic_Posts is successfully updated.]); //Version for JSON
				    }
				}
			
            } else {
				
				//method updateOneElasticCloudIndex() failed (may be due to cURL failure)
				return redirect()->back()->withInput()->with('flashMessageFailX', 'Data is successfully updated! Elastic cloud indexing FAILED (may be cURL failed) ');
			}
		} else {
			//return response()->json(['success' => 'Failed to update']);             //Version for JSON
			return redirect()->back()->withInput()->with('flashMessageFailX', 'Failed to update the post + Elastic indexing failed!!!' );


		}
	}
	
	
	
	
	/**
     * Display existing my Elastic Cloud Engines. Has No view file
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function showEngines()
    {
		$enginesURL = "https://myelasticz.ent.us-central1.gcp.cloud.es.io/api/as/v1/engines/";
		$authorization = "Authorization: Bearer " . env('ElasticPrivate_Api_Key'); //Inject the token (Private Api Key) into the header
  
        $curl = curl_init();
		curl_setopt_array($curl, array(
                CURLOPT_URL            => $enginesURL,
	            CURLOPT_HTTPHEADER     => array('Content-Type: application/json' , $authorization ), //Inject the token into the header
                CURLOPT_RETURNTRANSFER => true,
				//CURLOPT_USERPWD => 'user:pass', //authorization variant 2
                CURLOPT_ENCODING       => "",
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST   => "GET",
                //CURLOPT_POSTFIELDS      => $dataX,//"{\n  \"customer\" : \"con\",\n  \"customerID\" : \"5108\",\n  \"customerEmail\" : \"jordi@correo.es\",\n  \"Phone\" : \"34600000000\",\n  \"Active\" : false,\n  \"AudioWelcome\" : \"https://audio.com/welcome-defecto-es.mp3\"\n\n}",
           
            ));
            //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //must option to Kill SSL, otherwise sets an error

            $response = curl_exec($curl);
            $err = curl_error($curl); //return string with last error or if no errof empty string
            curl_close($curl);

            if ($err) {
				throw new \App\Exceptions\myException("cURL Exception happened while getting Elastic Cloud Engines  " . $err);

            } else {
                echo "See the list=> " . $response;
            }
		
	}
	
	
	/**
     * Run Query Job. Do the same as {method doElasIndexing()} but via Async Job Queque. Has. Works. No view file
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function runQueryJob()
	{
	    $text = " JOB done ";
		$res = \App\Jobs\ElasticSearch\ProcessElasticIndexing::dispatch($text); //Put the task in Queque (and execute??)
		//$res = app('App\Http\Controllers\Elastic\ElasticController')->doElasIndexing(); //call Controller method from other code  place
		return $text; //it returns what returns method doElasIndexing() + $text
	}
	
	
}
