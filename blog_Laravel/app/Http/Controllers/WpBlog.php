<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\wpress_blog_post; //model for all posts
use App\models\wpress_category; //model for all wpress_category

use Illuminate\Support\Facades\DB;


class WpBlog extends Controller
{
    public function __construct(){$this->middleware('auth');}
	
	 /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//$articles = wpress_blog_post::all(); //Eloquent ORM
		$articles = wpress_blog_post::where('wpBlog_status', '1')->get();
		$categories = wpress_category::all();//for dropdown
		
	    if (!isset($_GET['category'])){ $articles = wpress_blog_post::where('wpBlog_status', '1')->get();}
		
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
    {   $categories = wpress_category::all(); //for dropdown
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
		//dd(Input::all()); 
		//return false;
        $ticket = new wpress_blog_post();
        $data = $this->validate($request, [
            'description'=>'required',
            'title'=> 'required',
	        'category_sel' => 'required|integer'
        ]);
       
        if ($ticket->saveTicket($data)) {
            return redirect('/createNewWpress')->with('success', 'New support ticket has been created! Wait sometime to get resolved');
		} else {
			return redirect('/createNewWpress')->with('success', 'Failed');

		}
    }
	
	
	
	
	
}
