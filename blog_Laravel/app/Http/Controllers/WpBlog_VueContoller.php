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
    //public function __construct(){$this->middleware('auth');}
	
	
	
	 /**
     * Show all Wpress on Vue framework entries
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
        return view('wpBlog_Vue.index'/*,  compact('articles', 'categories', 'countArticles')*/);
    }
	
	
	
	//All the rest is REST API
	
	public function getAllPosts() //http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/post/get_all
    {   
        $posts = Wpress_images_Posts::with('getImages', 'authorName', 'categoryNames')->orderBy('wpBlog_created_at', 'desc')->get(); //->with('getImages', 'authorName', 'categoryNames') => hasMany/belongTo Eager Loading
        return response()->json(['error' => false, 'data' => $posts]);
    }
}
