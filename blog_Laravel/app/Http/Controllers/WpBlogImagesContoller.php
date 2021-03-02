<?php
//WpBlog but version 2.0 with Images
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\wpBlogImages\Wpress_images_Posts; //model for all posts
use App\models\wpBlogImages\Wpress_images_Category; //model for all Wpress_images_Category
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB; //not used
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Wpress_Images\SaveNewWpressImagesRequest; //my custom Form validation via Request Class (to create new blog & images in tables {wpressimages_blog_post} & {wpressimage_imagesstock})



class WpBlogImagesContoller extends Controller
{
    //public function __construct(){$this->middleware('auth');}
	
	
	
	 /**
     * Show all Wpress entries
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//$articles = Wpress_images_Posts::all(); //Eloquent ORM
		//$articles = Wpress_images_Posts::where('wpBlog_status', '1')->all(); //NOT ORM ELOQUENT, QueryBuilder, wont work with $articles->count()
		$categories = Wpress_images_Category::all();//gets categories for dropdown select
		//$countArticles = Wpress_images_Posts::where('wpBlog_status', '1')->get();
		
		//if no GET find all articles with pagination
	    if (!isset($_GET['category'])){ 
		    //found articles with pagination
		    $articles = Wpress_images_Posts::where('wpBlog_status', '1')->with('getImages')->orderBy('wpBlog_id', 'desc')->paginate(4); //object(Illuminate\Database\Eloquent\Collection //->with('getImages') => hasMany Eager Loading
			//count found articles
			$countArticles = Wpress_images_Posts::where('wpBlog_status', '1')->get();
		}
		
		//if isset GET, found by category, no pagination
		if(isset($_GET['category'])){
			//found articles without pagination
			$articles = Wpress_images_Posts::where('wpBlog_status', '1')->with('getImages')->where('wpBlog_category', $_GET['category'] )->orderBy('wpBlog_id', 'desc')->get(); //->with('getImages') => hasMany Eager Loading
		    //count found articles
			$countArticles = Wpress_images_Posts::where('wpBlog_status', '1')->where('wpBlog_category', $_GET['category'] )->get();

		}
		
	
		
        return view('wpBlog_Images.wpblog',  compact('articles', 'categories', 'countArticles'));
    }
	
	
	
	
	 /**
     * Show the form to create new entry.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
	    if(!Auth::check()){
			$text = 'You are not logged, <a href="'. route('login') . '"> click here  </a>  to Login first';
		    throw new \App\Exceptions\myException($text); 
		}
	    $categories = Wpress_images_Category::all(); //for dropdown
		return view('wpBlog_Images.create',  compact('categories'));
	}
	
	
	
	
	
	
	/**
     * Store a newly created resource in storage. Validation via request Class
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveNewWpressImagesRequest $request)
    {
		//dd(Input::all()); return false;
	    
		/*
	    if(!Auth::user()->hasRole('admin')){ //arg $admin_role does not work
           throw new \App\Exceptions\myException('You have No rbac rights to Admin Panel');
		}
		
		//if $_POST['productID'] is not passed. In case the user navigates to this page by enetering URL directly, without submitting from with $_POST
		if(!$request->input('product-desr')){
			throw new \App\Exceptions\myException('Bad request, You are not expected to enter this page.');
		}
		*/
		
		/*
		if (empty($request->filename)) {
            return redirect()->back()->withErrors(['msg', 'The Message']);
        } */
		
		
		//dd($request->filename); //(DONT USE $request->input('filename') as IT WON"T WORK)
	
	    
	    
        $data       = $request->input();
		$imagesData = $request->filename; //uploaded images
		
	    try{
			$ticket = new Wpress_images_Posts();
			$ticket->saveFields($data, $imagesData);
			return redirect('/wpBlogImages')->with('flashMessage',"Created successfully");
			
		} catch(Exception $e){
			return redirect('/createNewWpressImg')->with('success',"Operation failed");
		}
		
    }
	
	
	
	/**
     * Delete a selected record. Used to work via $_GET,  but changed to S_POST due security reason-
     *
     * @param  integer $id
     * @return 
     */
	public function destroy(/*$id*/) {
       /*DB::delete('delete from Wpress_images_Posts where wpBlog_id = ?',[$id]);
       echo "Record deleted successfully.";
       echo 'Click Here to go back.';
	   */
	   
	   $id = $_POST['id'];
	  
	   
	   //additional check in case user directly intentionally navigates to  ../blog_Laravel/public/delete/12 to not his record
	   try{
	       $articleOne = Wpress_images_Posts::where('wpBlog_id',$id)->firstOrFail(); //find the article by id  ->firstOrFail();
	   } catch (\Exception $e) {
	   //if(!$articleOne){
	      throw new \App\Exceptions\myException('Article does not exist');
	   }
	   
	  
	   
	   if( !Auth::check() || $articleOne->wpBlog_author!= auth()->user()->id){
		   throw new \App\Exceptions\myException('It is not your article');
	   }
	   
	   Wpress_images_Posts::where('wpBlog_id',$id)->delete();
	   return redirect('/wpBlogg')->with('flashMessage',"Record deleted successfully");

	   
    }
	
	
	/**
     * Edit a selected record, displays edit form
     *
     * @param  integer $id
     * @return 
     */
	public function edit($id) {
      
	    //additional check in case user directly intentionally navigates to  ../blog_Laravel/public/delete/12 to not his record
	   try{
	       $articleOne = Wpress_images_Posts::where('wpBlog_id',$id)->firstOrFail(); //find the article by id  ->firstOrFail();
	   } catch (\Exception $e) {
	   //if(!$articleOne){
	      throw new \App\Exceptions\myException('Article does not exist');
	   }
	   
	   if( !Auth::check() || $articleOne->wpBlog_author!= auth()->user()->id){
		   throw new \App\Exceptions\myException('It is not your article to edit');
	   }
	   	//additional check in case user directly intentionally navigates to  ../blog_Laravel/public/delete/12 to not his record

			
			
	   $articleOne = Wpress_images_Posts::where('wpBlog_id',$id)->get();
	   $categories = Wpress_images_Category::all(); //for dropdown
	   
	   return view('wpBlog_Images.edit',  compact('articleOne', 'categories'));

	   
    }
	
	
	
	
	/**
     * update a selected record and return to previous edit form
     *
     * @param  integer $id
     * @return 
     */
	public function update(Request $request, $id) {
      
	   //additional check in case user directly intentionally navigates to  ../blog_Laravel/public/delete/12 to not his record
	   try{
	       $articleOne = Wpress_images_Posts::where('wpBlog_id',$id)->firstOrFail(); //find the article by id  ->firstOrFail();
	   } catch (\Exception $e) {
	   //if(!$articleOne){
	      throw new \App\Exceptions\myException('Article does not exist');
	   }
	   
	   if( !Auth::check() || $articleOne->wpBlog_author!= auth()->user()->id){
		   throw new \App\Exceptions\myException('It is not your article to edit');
	   }
	   	//additional check in case user directly intentionally navigates to  ../blog_Laravel/public/delete/12 to not his record
		
		
	   
	   //validation rules
        $rules = [
			'description' => 'required|string|min:3|max:255',
			'title' => 'required|string|min:3|max:255',
			'category_sel' => 'required|integer'
		];
		
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect()->back()
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{
			
				
				Wpress_images_Posts::where('wpBlog_id', $id)->update([  'wpBlog_text' => $data['description'], 'wpBlog_title' => $data['title'], 'wpBlog_category' => $data['category_sel'] ]);
                return redirect()->back()->with('success',"Update successfully");
				
			}
			catch(Exception $e){
				return redirect()->back()->with('success',"Update failed");
			}
		}

	   
    }
	
	
	
	/**
     * View One Article
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
	public function viewOne($id) {
	   //additional check in case user directly intentionally navigates to  ../blog_Laravel/public/delete/12 to not his record
	   try{
	       $articleOne = Wpress_images_Posts::where('wpBlog_id',$id)->firstOrFail(); //find the article by id  ->firstOrFail();
	   } catch (\Exception $e) {
	   //if(!$articleOne){
	      throw new \App\Exceptions\myException('Article does not exist');
	   }

			
			
	   $articleOne = Wpress_images_Posts::where('wpBlog_id',$id)->get();
	   
	   return view('wpBlog_Images.viewOne',  compact('articleOne'));
	}
	
	
}
