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



class WpBlogImages extends Controller
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
		$categories = Wpress_images_Category::all();//for dropdown select
		//$countArticles = Wpress_images_Posts::where('wpBlog_status', '1')->get();
		
		//if no GET find all articles with pagination
	    if (!isset($_GET['category'])){ 
		    //found articles with pagination
		    $articles = Wpress_images_Posts::where('wpBlog_status', '1')->with('getImages')->paginate(4); //object(Illuminate\Database\Eloquent\Collection
			//count found articles
			$countArticles = Wpress_images_Posts::where('wpBlog_status', '1')->get();
		}
		
		//if isset GET, found by category, no pagination
		if(isset($_GET['category'])){
			//found articles without pagination
			$articles = Wpress_images_Posts::where('wpBlog_status', '1')->where('wpBlog_category', $_GET['category'] )->get();
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
		    throw new \App\Exceptions\myException('Login first.'); 
		}
	    $categories = Wpress_images_Category::all(); //for dropdown
		return view('wpBlog_Images.create',  compact('categories'));
	}
	
	
	
	
	
	
	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//dd(Input::all()); return false;
		
		
		//variant prev
		/*
        $ticket = new Wpress_images_Posts();
		
        $data = $this->validate($request, [
            'description'=>'required',
            'title'=> 'required',
	        'category_sel' => 'required|integer'
        ]);
       
	   
		//dd($data);
	    //var_dump(Input::get('description'));
		//dd(Input::all());
		//return; 
		
        if ($ticket->saveTicket(Input::all() )) { //if ($ticket->saveTicket($data))
            return redirect('/createNewWpress')->with('success', 'New support ticket has been created! Wait sometime to get resolved');
		} else {
			return redirect('/createNewWpress')->with('success', 'Failed');

		}
    }
	*/
	
	
	    //validation rules
        $rules = [
			'description' => 'required|string|min:3|max:255',
			'title' => 'required|string|min:3|max:255',
			'category_sel' => 'required|integer'
		];
		
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('/createNewWpress')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{
				$ticket = new Wpress_images_Posts();
				$ticket->saveFields($data);
				return redirect('/createNewWpress')->with('success',"Insert successfully");
			}
			catch(Exception $e){
				return redirect('/createNewWpress')->with('success',"operation failed");
			}
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
