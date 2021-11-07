<?php
//Rest controller, works with DB name wpress_blog_post. 
//Uses separated Rest Wpress model for table {wpress_blog_post} => /models/rest/WpressRest.php. (Model isstrictly for REST Api requests)  !!!!!!!!!
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //validate
use App\models\Rest\WpressRest; //Rest model for all posts

class Rest extends Controller
{
    
  /**
   * returns all blogs/articles
   * @return 
   */
	public function index()
    {
        return WpressRest::all();
		//return response()->json(['data' => WpressRest::all(), 'status'=>  200]);
    }
 
 
 
   /**
   * returns One blogs/articles using hasOne/hasMany relations
   * @return 
   */
    public function show($id)
    {
		//return WpressRest::with('authorName', 'categoryNames')->where('wpBlog_id', $id)->get(); //it was one original Rest line, built by default Laravel 

        //Token guard manual, working
        /*if (!isset($_GET['token'])) {
			$responseX = array('status' => 'Fail', 'messageX'=> 'No token is provided in request' );
			return $responseX;
		}*/

		//Check if Article ID exists at all
		if (!WpressRest::where('wpBlog_id', $id)->exists()) {
			$responseX = array('status' => 'Fail', 'messageX'=> 'Article ID does not exist' );
			return $responseX;
		}
        //return WpressRest::find($id);
		$wpress = WpressRest::with('authorName', 'categoryNames')->where('wpBlog_id', $id)->get(); //gets the article data
        $responseX = array('status' => 'OK', 'messageX'=> 'Article found', 'contentX'=> $wpress );	
        return $responseX;		
    }





	
  /**
   * stores/save new entry (Insert)
   * @return 
   */
    public function store(Request $request)
    {
		//return WpressRest::create($request->all()); //it was one original Rest line for INSERT, built by default Laravel 



	
		//validation rules, validate the input
        $rules = [
		    'wpBlog_title' => 'required|string|min:3|max:255',
			'wpBlog_text' => 'required|string|min:3|max:255',  //wpBlog_text is a my name in $.ajax({  data: }) in js/test-rest.js  in {$(document).on("click", '#createArticle', function(e) { }
			'wpBlog_category' => 'required|integer'
		];
		
		//creating custom error messages. Should pass it as 3rd param in Validator::make()
	    $mess = [ 
		    'wpBlog_title.required' => 'You did not provided article title',
		    'wpBlog_text.required' => 'You did not provided article description', //wpBlog_text is a my name in $.ajax({  data: }) in js/test-rest.js  in {$(document).on("click", '#createArticle', function(e) { }
			'wpBlog_text.min' => 'We need at least 3 letters for article description',
			'wpBlog_category.required' => 'You did not provided category field',
			'wpBlog_category.integer' => 'Category must be an integer',
			];
		
		$validator = Validator::make($request->all(), $rules, $mess);
		if ($validator->fails()) {
			
			/*return redirect('/createNewWpress')
			->withInput()
			->withErrors($validator); */
			
			$responseX = array('status' => 'Fail', 'messageX'=> $validator->errors()->first() );
			return $responseX;
			
		} else {
		
		     //return $request->all(); //mine
		     //return $request->input('wpBlog_title');
			 
			 //add 'wpBlog_created_at' data to form $request->all()
			 $dataX = $request->all();
             $dataX['wpBlog_created_at'] = date('Y-m-d H:i:s');
			 
			 $wpress = WpressRest::create($dataX); //creating an article, i.e INSERT
			 $responseX = array('status' => 'OK', 'messageX'=> 'Article created', 'contentX'=> $wpress );	
			 return $responseX;
		}
		
		//my  variant
		/*
		$model = new WpressRest();
		$model->wpBlog_author = $request->input('wpBlog_author');
		$model->wpBlog_title  = $request->input('wpBlog_title');
		$model->wpBlog_text   = $request->input('wpBlog_text');
		$model->wpBlog_category = $request->input('wpBlog_category');
		//$model->updated_at = '2020-10-04 10:54:50';
		$model->save(['timestamps'=>false]);
		return "Saved";
		*/
    }



  /**
   * Update an entry (/PUT)
   * @return 
   */
    public function update(Request $request, $id)
    {   //it was original Rest code for DELETE, built by default Laravel
        /* $article = WpressRest::findOrFail($id);
        $article->update($request->all());
        return $article; */
		
		
		
	
		//validation rules, validate the input
        $rules = [
		    'wpBlog_title' => 'required|string|min:3|max:255',
			'wpBlog_text' => 'required|string|min:3|max:255',  //wpBlog_text is a my name in $.ajax({  data: }) in js/test-rest.js  in {$(document).on("click", '#createArticle', function(e) { }
			'wpBlog_category' => 'required|integer'
		];
		
		//creating custom error messages. Should pass it as 3rd param in Validator::make()
	    $mess = [ 
		    'wpBlog_title.required' => 'You did not provided article title',
		    'wpBlog_text.required' => 'You did not provided article description', //wpBlog_text is a my name in $.ajax({  data: }) in js/test-rest.js  in {$(document).on("click", '#createArticle', function(e) { }
			'wpBlog_text.min' => 'We need at least 3 letters for article description',
			'wpBlog_category.required' => 'You did not provided category field',
			'wpBlog_category.integer' => 'Category must be an integer',
			];
		
		$validator = Validator::make($request->all(), $rules, $mess);
		
		//if validation fails
		if ($validator->fails()) {
			
			$responseX = array('status' => 'Fail', 'messageX'=> $validator->errors()->first() );
			return $responseX;
		//if validation is OK	
		} else {
			
			 //add 'wpBlog_created_at' data to form $request->all()
			 $dataX = $request->all();
             $dataX['wpBlog_created_at'] = date('Y-m-d H:i:s');
			 
			 
		     $article = WpressRest::findOrFail($id);
             if ($article->update($dataX)) {//if ($article->update($request->all())) {
			     //$wpress = WpressRest::update($request->all()); //creating an article, i.e INSERT
			     $responseX = array('status' => 'OK', 'messageX'=> 'Article updated', 'contentX'=> $article );	
			     return $responseX;
			 } else {
				 $responseX = array('status' => 'Fail', 'messageX'=> 'Article failed to be updated' );	
			     return $responseX;
			 }
		}
    }











 /**
  * Delete an entry (/DELETE)
  * @return 
 */
 /*
  | 
  |--------------------------------------------------------------------------
  | 
  |--------------------------------------------------------------------------
  |
  |
  */
    public function delete(Request $request, $id)
    {   //it was original Rest code for DELETE, built by default Laravel 
		/*$article = WpressRest::findOrFail($id);
        $article->delete();
        return 204; */
		
		//Check if Article ID exists at all
		if (!WpressRest::where('wpBlog_id', $id)->exists()) {
			$responseX = array('status' => 'Fail', 'messageX'=> 'Article ID does not exist or it was already deleted' );
			return $responseX;
		}
		
		
        $article = WpressRest::findOrFail($id); //u can use => WpressRest::firstOrFail($id); if add to model => protected $primaryKey = 'wpBlog_id'; 
        
		if ($article->delete()){
			$responseX = array('status' => 'OK', 'messageX'=> 'Article ' . $id . ' was deleted' );
			return $responseX;
			
		} else {
			$responseX = array('status' => 'Fail', 'messageX'=> 'Article ' . $id . ' failed to be deleted' );
			return $responseX;
		}

        //return 204;
    }

}
