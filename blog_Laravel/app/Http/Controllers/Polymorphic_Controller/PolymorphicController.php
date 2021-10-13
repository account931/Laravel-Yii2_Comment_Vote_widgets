<?php

namespace App\Http\Controllers\Polymorphic_Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Http\Requests\Polymorphic\PostPolymUpdateRequest; //Validation via Request Class
use App\Http\Controllers\Controller; //to place controller in subfolder
use App\models\Polymorphic\Polymorphic_Posts;    //model for DB table {polymorphic_posts}
use App\models\Polymorphic\Polymorphic_Images;   //model for DB table {polymorphic_images}
use App\models\Polymorphic\Polymorphic_Users;   //model for DB table {polymorphic_images}



class PolymorphicController extends Controller
{
    public function __construct(){
	    $this->middleware('auth');	   
	}
	
	
	
	/**
     * Show start page  
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $testMessage = "test mess from Controller";
		
		//getting one post
		$postOne = Polymorphic_Posts::findOrFail(1); //find(1); //has hasOne relation
		//$postOne = Polymorphic_Users::findOrFail(1); //find(1); //DIES NOT have hasOne relation
		
		//dd($postOne);
		$imageX = $postOne->imageZ;
		//dd($imageX); //so far, returns null
		
		$image     = Polymorphic_Images::find(2);
        $imageable = $image->imageable;
		//dd($imageable);
		
		//getting all posts
		$allPosts = Polymorphic_Posts::with('authorName')->orderBy('id', 'asc')->get(); //->with('getImages', 'authorName') => hasMany/belongTo Eager Loading //where('wpBlog_id', $idN)->


		
        return view('polymorphic.index',  compact('testMessage', 'postOne', 'imageX', 'allPosts'));
    }
	
	
	
	
	/**
     * Display form to edit an existing product 
     *
     * @return \Illuminate\Http\Response
     */
    public function editProduct($id)
    { 
	    //additional check in case user directly intentionally navigates to this URL with not-existing ID
	    if (!Polymorphic_Posts::where('id', $id)->exists()) { 
	        throw new \App\Exceptions\myException('Product ' . $id . ' does not exist');
	    }
		
		//find the product by id
		$productOne = Polymorphic_Posts::where('id', $id)->get();
		
		//find all authors for form dropdown
		$authorsAll = Polymorphic_Users::all();
		
		return view('polymorphic.edit-product')->with(compact('productOne', 'authorsAll'));  
	}
	
	
	
	/**
     * $_PUT to update a post
     * @param  \Illuminate\Http\PostPolymUpdateReques  $request
     * @return \Illuminate\Http\Response
	 *
     */
	 
    public function updateProduct (PostPolymUpdateRequest $request)
	{
		dd($request->all());
		
		//commented {function withValidator} and decommented {function failedValidation} in Requests\Polymorphic\PostPolymUpdateRequest in order if Validation fails, the Controller still execute code
		//if validation fails
		if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->withInput()->with('flashMessageFailX', 'Validation Failedd!!!' )->withErrors($validator);
		} 
		
		//$request->input('role_sel'); vs $request->all()
		
	}
      
   
}
