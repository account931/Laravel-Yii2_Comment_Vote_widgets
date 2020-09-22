<?php
//Rest controller, works with DB name wpress_blog_post
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Rest\WpressRest; //Rest model for all posts

class Rest extends Controller
{
    //
	
	public function index()
    {
        return WpressRest::all();
    }
 
 
    public function show($id)
    {
        //return WpressRest::find($id);
		return WpressRest::with('authorName')->where('wpBlog_id', $id)->get();
		  
    }

	
	
    public function store(Request $request)
    {
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
