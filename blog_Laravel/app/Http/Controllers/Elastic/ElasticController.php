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




class ElasticController extends Controller
{
    public function __construct(){
	    $this->middleware('auth');	   
	}
	
	
	
	/**
     * Show start page  
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
	    //if user submitted Simple Search 
	    if ($request->has('simpleSearch')) { // equivalent if (isset($search_data) && !empty($search_data) )
			//dd($request->input('simpleSearch'));
		    //dd($request->simpleSearch);
		
		    $product = new Elastic_Posts();
			
			//Elastic search simple alternative
			//table type must be myISAM, if InnoDB otherwise you will get SQLSTATE[HY000]: General error: 1191 Can't find FULLTEXT index matching the column list
            //$results = $product->whereRaw("MATCH(elast_title, elast_text) AGAINST(? IN BOOLEAN MODE)", [$request->simpleSearch])->get();
			
			$results = Elastic_Posts::where('elast_title', 'LIKE', "%{$request->simpleSearch}%")->orWhere('elast_text', 'LIKE', "%{$request->simpleSearch}%")->get();
			//dd($results);
			
			return view('elastic.index')->with(compact('results')); 
		}
		//End if user submitted Simple Search 
		
		
		
		//if user submitted Elastic Search Search 
		//https://github.com/ErickTamayo/laravel-scout-elastic
	    if ($request->has('elastic-search')) { // equivalent if (isset($search_data) && !empty($search_data) )

		    dd("Elastic " . $request->input('elastic-search'));
		    $product = new Elastic_Posts();
			$results = Elastic_Posts::where('elast_title', 'LIKE', "%{$request->search}%")->orWhere('elast_text', 'LIKE', "%{$request->search}%")->get();
			//dd($results);
			
			return view('elastic.index')->with(compact('results')); 
		}
		//End if user submitted Elastic Search Search 
		
		
		//if no Serach is submitted, just render the view
        return view('elastic.index');
    }
	
	
	
	
}
