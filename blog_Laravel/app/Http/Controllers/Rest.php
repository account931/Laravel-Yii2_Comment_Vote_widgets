<?php
//Rest controller, works with DB name wpress_blog_post. 
//Uses separated Rest Wpress model for table {wpress_blog_post} => /models/rest/WpressRest.php. (Model isstrictly for REST Api requests)  !!!!!!!!!
namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        //return WpressRest::find($id);
		return WpressRest::with('authorName', 'categoryNames')->where('wpBlog_id', $id)->get();
		  
    }

	
  /**
   * stores/save new entry (Insert)
   * @return 
   */
    public function store(Request $request)
    {
		//return $request->all(); //mine
        return WpressRest::create($request->all()); //original rest line
		//return $request->input('wpBlog_title');
		
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
