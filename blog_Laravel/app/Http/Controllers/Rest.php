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
    }
 
   /**
   * returns One blogs/articles using hasOne/hasMany relations
   * @return 
   */
    public function show($id)
    {
		//Check if Article ID exists at all
		if (!WpressRest::where('wpBlog_id', $id)->exists()) {
			$responseX = array('status' => 'Fail', 'messageX'=> 'Article ID does not exist' );
			return $responseX;
		}
        //return WpressRest::find($id);
		//return WpressRest::with('authorName', 'categoryNames')->where('wpBlog_id', $id)->get(); //one original Rest line, built by default Laravel 
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
		//validate the input
		 //validation rules
        $rules = [
			'wpBlog_text' => 'required|string|min:3|max:255',  //wpBlog_text is a my name in $.ajax({  data: }) in js/test-rest.js  in {$(document).on("click", '#createArticle', function(e) { }
			'wpBlog_title' => 'required|string|min:3|max:255',
			'wpBlog_category' => 'required|integer'
		];
		
		//creating custom error messages. Should pass it as 3rd param in Validator::make()
	    $mess = [ 
		    'wpBlog_title.required' => 'You did not provided Title field',
		    'wpBlog_text.required' => 'You did not provided Description field', //wpBlog_text is a my name in $.ajax({  data: }) in js/test-rest.js  in {$(document).on("click", '#createArticle', function(e) { }
			'wpBlog_text.min' => 'We need at least 3 letters for description',
			'wpBlog_category.required' => 'You did not provided Category field',
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
             //return WpressRest::create($request->all()); //original rest line
		     //return $request->input('wpBlog_title');
			 $wpress = WpressRest::create($request->all()); //creating an article, i.e INSERT
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




    public function update(Request $request, $id)
    {
        $article = WpressRest::findOrFail($id);
        $article->update($request->all());

        return $article;
    }

    public function delete(Request $request, $id)
    {
        $article = WpressRest::findOrFail($id);
        $article->delete();

        return 204;
    }

}
