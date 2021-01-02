<?php
//Rest controller, works with DB name wpress_blog_post
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
		//return $request->all();
        return WpressRest::create($request->all());
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
