<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\wpress_blog_post; //model for all posts
use App\models\wpress_category; //model for all wpress_category
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB; //not used
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class WpBlog extends Controller
{
    //public function __construct(){$this->middleware('auth');}
	
	
	
	 /**
     * Show all Wpress entries
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//$articles = wpress_blog_post::all(); //Eloquent ORM
		//$articles = wpress_blog_post::where('wpBlog_status', '1')->all();
		$categories = wpress_category::all();//for dropdown
		
		
	    if (!isset($_GET['category'])){ $articles = wpress_blog_post::where('wpBlog_status', '1')->get();} //object(Illuminate\Database\Eloquent\Collection
		
		if(isset($_GET['category'])){
			$articles = wpress_blog_post::where('wpBlog_status', '1')->where('wpBlog_category', $_GET['category'] )->get();
		}
		
	
		
        return view('wpBlog.wpblog',  compact('articles', 'categories'));
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
	    $categories = wpress_category::all(); //for dropdown
		return view('wpBlog.create',  compact('categories'));
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
        $ticket = new wpress_blog_post();
		
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
				$ticket = new wpress_blog_post();
				$ticket->saveFields($data);
				return redirect('/createNewWpress')->with('success',"Insert successfully");
			}
			catch(Exception $e){
				return redirect('/createNewWpress')->with('success',"operation failed");
			}
		}
    }
	
	
	
	/**
     * Delete a selected record.
     *
     * @param  integer $id
     * @return 
     */
	public function destroy($id) {
       /*DB::delete('delete from wpress_blog_post where wpBlog_id = ?',[$id]);
       echo "Record deleted successfully.";
       echo 'Click Here to go back.';
	   */
	   
	   wpress_blog_post::where('wpBlog_id',$id)->delete();
	   return redirect('/wpBlogg')->with('flashMessage',"Record deleted successfully");

	   
    }
	
}
