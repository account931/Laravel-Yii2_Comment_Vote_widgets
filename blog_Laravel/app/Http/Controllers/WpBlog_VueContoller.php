<?php
//https://medium.com/js-dojo/build-a-simple-blog-with-multiple-image-upload-using-laravel-vue-5517de920796

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


use Storage;
use Illuminate\Support\Facades\DB;
use App\models\wpBlogImages\Wpress_images_Posts; //model for all posts
use App\models\wpBlogImages\Wpress_images_Category; //model for all Wpress_images_Category

class WpBlog_VueContoller extends Controller
{
    public function __construct(){
		   //$this->middleware('auth');
		   
	}
	
	
	
	 /**
     * Show all Wpress on Vue framework entries
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
        return view('wpBlog_Vue.index'/*,  compact('articles', 'categories', 'countArticles')*/);
    }
	
	
	
	//All the rest is REST API ======================================
	
	 /**
     * REST API to /GET all posts
     *
     * @return json
     */
	public function getAllPosts() //http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/post/get_all
    {   
        $posts = Wpress_images_Posts::with('getImages', 'authorName', 'categoryNames')->orderBy('wpBlog_created_at', 'desc')->get(); //->with('getImages', 'authorName', 'categoryNames') => hasMany/belongTo Eager Loading
        return response()->json(['error' => false, 'data' => $posts]);
    }
	
	
	
	
	 /**
     * REST API to /POST (create) a new blog. NOT IMPLEMENTED. REWRITE WITHOUT TRANSACTION
     *
     * @return json
     */
	public function createPost(Request $request)
    {
		/*
		header('Access-Control-Allow-Origin:  *');
        header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');
	    */
		return response()->json("Too Good, but process image : " . $request->title .  " / " .  $request->body);
		//dd($request->all());
		
		/*
        DB::transaction(function () use ($request) {
            $user = Auth::user();
            $title = $request->title;
            $body = $request->body;
            $images = $request->images;

            $post = Wpress_images_Posts::create([
                'title' => $title,
                'body' => $body,
                'user_id' => $user->id,
            ]);
            // store each image
            foreach($images as $image) {
                $imagePath = Storage::disk('uploads')->put($user->email . '/posts/' . $post->id, $image);
                PostImage::create([
                    'post_image_caption' => $title,
                    'post_image_path' => '/uploads/' . $imagePath,
                    'post_id' => $post->id
                ]);
            }
        });
        return response()->json(200);
		*/
    }
	
	
	
	
	
	
	
}
