<?php

namespace App\Http\Controllers\Polymorphic_Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator; //from ABZ + Controllers/WpBlog_Admin_Part/WpBlog_Admin_Rest_API_Contoller.php

use Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Http\Requests\Polymorphic\PostPolymUpdateRequest; //Validation via Request Class (both for create and update)
; 
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
	    //additional check if any posts are at all 
	    if (Polymorphic_Posts::all()->count() == 0) { 
	        throw new \App\Exceptions\myException('Sorry, so far no posts in DB');
	    }
	    
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
     * @param int $id
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
     * $_PUT request to update/edit a one single post
     * @param  \Illuminate\Http\PostPolymUpdateReques  $request
     * @return \Illuminate\Http\Response
	 *
     */
	 
    public function updateProduct (PostPolymUpdateRequest $request)
	{
		//dd($request->all()); //all form input (is shown always even if validation fails)
		
		//check if checkbox was ticked
		/*  if($request->has('remember')) {
			dd("NO NEED FOR IMAGE");
		} else {
			dd("IMAGE is a must");
		} */ 
		
		//commented {function withValidator} and decommented {function failedValidation} in Requests\Polymorphic\PostPolymUpdateRequest in order if Validation fails, the Controller will still execute code
		//if validation fails
		if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->withInput()->with('flashMessageFailX', 'Validation Failedd!!!' )->withErrors($request->validator->messages()); //Error was here ->withErrors($validator);
		    
			/*
			return response()->json([
               'error' => true, 
               'data' => 'Was seem to be OK, but validation crashes', 
               'validateErrors'=>  $request->validator->messages()]);
			*/
		}
		
		
		//$request->input('role_sel'); vs $request->all()
		//return "Validation is OK";
		
		
		/*
		//additional check in case user directly intentionally navigates to  ../blog_Laravel/public/delete/12 to not his record
	        try{
	            $articleOne = wpress_blog_post::where('wpBlog_id',$id)->firstOrFail(); //find the article by id  ->firstOrFail();
	        } catch (\Exception $e) {
	            //if(!$articleOne){
	            throw new \App\Exceptions\myException('Article does not exist');
	        }
		*/
		
		//dd($request->all());
		//dd($request->input('product-name'));
		//dd($request->image->getSize() . ' byte'); //image size
		
		$form_data = array(
            'post_name'      =>  $request->input('product-name'), //DB column => input name
            'post_text'      =>  $request->input('product-desr'),
			'author_id'      =>  $request->input('article-author'), //$request->article-author, //won't work
			
			/*
			'phone'       =>  $request->user_phone,
			'username'    =>  $request->user_n,
			'rank_id'     =>  $request->user_rank,
			'superior_id' =>  $request->user_superior,
			'salary'      =>  $request->user_salary,
			'hired_at'    =>  $request->user_hired_at,
			'image'       =>  $imageName, //$request->image,
			*/
        );    

        //Updating the Post (table {polymorphic_posts}) 
        if (Polymorphic_Posts::whereId($request->input('hidden-prod-id'))->update($form_data)) { //request->hidden-prod-id
            
			if(!$request->has('remember')) { //code below if only user did not ticked "Do not update image"
				
			    //remove the prev image from folder (100%).........
			    //delete a prev/old image from folder '/images/polymorphic/'
		        $product = Polymorphic_Images::where('imageable_id', $request->input('hidden-prod-id'))->first(); //found image 
		    
			    $pieces = explode("/images/polymorphic/", $product->url); //as db column saves image url as "/images/polymorphic/someName" we need to "someName" first
			    if(file_exists(public_path('images/polymorphic/' . $pieces[1]))){ //$pieces[1] is an image name without "/images/polymorphic/
		            \Illuminate\Support\Facades\File::delete('images/polymorphic/' . $pieces[1]);
		        }
			
			
			
			
			    // So far, Intervention is not used here. Copy from working example
		        //------------------------------------------------------------------
		        //Intervention Lib, resizing image + save ----- //https://stackoverflow.com/questions/59300544/how-to-reduce-size-of-image-in-laravel-when-upload
	            /*
			    if($request->file('image') != null){ //if a user uploaded an image which is NOT OBLIGATORY REQUIRED for UPDATE
		            $image = $request->file('image'); //uploded image 
		            $imageName = time(). '_' . $request->image->getClientOriginalName(); //new name (time + originalName). //Prev variant (before implement Intervention resize). Working!!!
                    //$input['imagename'] = time().  '_' . $request->image->getClientOriginalName(); // . '.'.$image->getClientOriginalExtension(); //create name: time+name+extension

                    $destinationPath = public_path('images/employees');
                    $img = Image::make($image->getRealPath());
		
		            //watermark
		            $watermark = Image::make('images/water-mark.png'); //watermark
		            $watermark->resize(20, 20); //watermark resize
		
		            //resize avatar image to (300, 300) + adding watermark + save. Uses method chaining. Alternatively can do separately $img->resize(); $img->insert(); $img-save();
                    $img->resize(300, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })
		            ->insert($watermark, 'bottom-right', 10, 10) // insert watermark at bottom-right corner with 10px offset
		            ->save($destinationPath.'/' . $imageName); //save
                }
                */
               //$destinationPath = public_path('images/employees');
               //$image->move($destinationPath, $imageName);
	       
	           //END Intervention Lib, resizing image + save  -----
	           //------------------------------------------------------------------
			   //
			
			
			    //update the image in table Polymorphic_Images ------------------------------------------
			
			    //getting Image info for Flash Message
		        $imageName      = time(). '_' . $request->image->getClientOriginalName();
		        $sizeInByte     = $request->image->getSize() . ' byte';
		        $sizeInKiloByte = round( ($request->image->getSize() / 1024), 2 ). ' kilobyte'; //round 10.55364364 to 10.5
		        $fileExtens     =     $request->image->getClientOriginalExtension();
		        //getting Image info for Flash Message
			
			    //Move uploaded image to the specified folder 
		        request()->image->move(public_path('images/polymorphic'), $imageName);
		
		        //update image itself, table { polymorphic_images}
			    Polymorphic_Images::where('imageable_id', $request->input('hidden-prod-id') )->update([  'url' => '/images/polymorphic/' . $imageName, /* 'wpBlog_title' => $data['title'], */  ]);
            
			} else { // end if(!$request->has('remember')) 
			    $imageName  = " User opted not to update the imaged";
			    $sizeInByte = "";
			}
			
			//End update the image in table Polymorphic_Images -------------------------------------



			
			
			//return response()->json(['success' => 'Data is successfully updated.]); //Version for JSON
			return redirect()->back()->withInput()->with('flashMessageX', 'Data is successfully updated! Connected image is: <b> ' . $imageName . ' ' . $sizeInByte  . ' </b>');

		} else {
			//return response()->json(['success' => 'Failed to update']);             //Version for JSON
			return redirect()->back()->withInput()->with('flashMessageFailX', 'Failed to update!!!' );


		}
	}
	
	
	
	
	
	/**
     * Display form to create a new product 
     *
     * @return \Illuminate\Http\Response
     */
    public function createProduct()
    { 
		
		//find all authors for form dropdown
		$authorsAll = Polymorphic_Users::all();
		
		return view('polymorphic.create-new-product')->with(compact( 'authorsAll'));  
	}
      
   
   
   
    
	/**
     * $_POST request to create a new post
     * @param  \Illuminate\Http\PostPolymUpdateReques  $request
     * @return \Illuminate\Http\Response
	 *
     */
	 
    public function createStoreProduct (PostPolymUpdateRequest $request)
	{
		//dd($request->all()); //all form input (is shown always even if validation fails)
		
		//commented {function withValidator} and decommented {function failedValidation} in Requests\Polymorphic\PostPolymUpdateRequest in order if Validation fails, the Controller will still execute code
		//if validation fails
		if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->withInput()->with('flashMessageFailX', 'Validation Failedd!!!' )->withErrors($request->validator->messages()); //Error was here ->withErrors($validator);
		    
			/*
			return response()->json([
               'error' => true, 
               'data' => 'Was seem to be OK, but validation crashes', 
               'validateErrors'=>  $request->validator->messages()]);
			*/
		}
		
		//dd($request->all());
		
		
		
		
		
		
		
		//
		$form_data = array(
            'post_name'      =>  $request->input('product-name'), //DB column => input name
            'post_text'      =>  $request->input('product-desr'),
			'author_id'      =>  $request->input('article-author'), //auth()->user()->id  //$request->article-author, //won't work
			
			/*
			'phone'       =>  $request->user_phone,
			'username'    =>  $request->user_n,
			'rank_id'     =>  $request->user_rank,
			'superior_id' =>  $request->user_superior,
			'salary'      =>  $request->user_salary,
			'hired_at'    =>  $request->user_hired_at,
			'image'       =>  $imageName, //$request->image,
			*/
        );    

        //saving the Post to table {polymorphic_posts}
        if ($savedPost = Polymorphic_Posts::create($form_data)) {
			
			//clear the form fields here.........................
			
			//dd($savedPost->id);
			if(!$request->has('remember')) { //code below if only user did not ticked "Do not update image"
			
			
			
			    // So far, Intervention is not used here. Copy from working example
		        //------------------------------------------------------------------
		        //Intervention Lib, resizing image + save ----- //https://stackoverflow.com/questions/59300544/how-to-reduce-size-of-image-in-laravel-when-upload
	            /*
			    if($request->file('image') != null){ //if a user uploaded an image which is NOT OBLIGATORY REQUIRED for UPDATE
		            $image = $request->file('image'); //uploded image 
		            $imageName = time(). '_' . $request->image->getClientOriginalName(); //new name (time + originalName). //Prev variant (before implement Intervention resize). Working!!!
                    //$input['imagename'] = time().  '_' . $request->image->getClientOriginalName(); // . '.'.$image->getClientOriginalExtension(); //create name: time+name+extension

                    $destinationPath = public_path('images/employees');
                    $img = Image::make($image->getRealPath());
		
		            //watermark
		            $watermark = Image::make('images/water-mark.png'); //watermark
		            $watermark->resize(20, 20); //watermark resize
		
		            //resize avatar image to (300, 300) + adding watermark + save. Uses method chaining. Alternatively can do separately $img->resize(); $img->insert(); $img-save();
                    $img->resize(300, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })
		            ->insert($watermark, 'bottom-right', 10, 10) // insert watermark at bottom-right corner with 10px offset
		            ->save($destinationPath.'/' . $imageName); //save
                }
                */
               //$destinationPath = public_path('images/employees');
               //$image->move($destinationPath, $imageName);
	       
	           //END Intervention Lib, resizing image + save  -----
	           //------------------------------------------------------------------
			   //
			
			
			    //saving the image in table Polymorphic_Images ------------------------------------------
			
			    //getting Image info for Flash Message
		        $imageName      = time(). '_' . $request->image->getClientOriginalName();
		        $sizeInByte     = $request->image->getSize() . ' byte';
		        $sizeInKiloByte = round( ($request->image->getSize() / 1024), 2 ). ' kilobyte'; //round 10.55364364 to 10.5
		        $fileExtens     =     $request->image->getClientOriginalExtension();
		        //getting Image info for Flash Message
			
			    //Move uploaded image to the specified folder 
		        request()->image->move(public_path('images/polymorphic'), $imageName);
		
		        //Insert image itself, create new record to table {polymorphic_images}
			    //Polymorphic_Images::where('imageable_id', $request->input('hidden-prod-id') )->update([  'url' => '/images/polymorphic/' . $imageName, /* 'wpBlog_title' => $data['title'], */  ]);
                $img = new Polymorphic_Images();
				$img->url            = '/images/polymorphic/' . $imageName;
				$img->imageable_id   = $savedPost->id;
				$img->imageable_type = 'App\Models\Polymorphic\Polymorphic_Posts';
				if(!$img->save()){
					$imageName  = " Failed saving the image";
			        $sizeInByte = "";
				}
			
			} else { // end if(!$request->has('remember')) 
			    $imageName  = " User opted not to update the imaged";
			    $sizeInByte = "";
			}
			
			//End saving the image in table Polymorphic_Images -------------------------------------



			
			
			//return response()->json(['success' => 'Data is successfully updated.]); //Version for JSON
			return redirect()->back()->withInput()->with('flashMessageX', 'Data is successfully updated! Connected image is: <b> ' . $imageName . ' ' . $sizeInByte  . ' </b>');
			
		} else {
			//return response()->json(['success' => 'Failed to update']);             //Version for JSON
			return redirect()->back()->withInput()->with('flashMessageFailX', 'Failed to create a new post!!!' );


		}
			
			
		//DELETE BELOW	
        //Updating the Post (table {polymorphic_posts}) 
        if (Polymorphic_Posts::whereId($request->input('hidden-prod-id'))->update($form_data)) { //request->hidden-prod-id
            
			if(!$request->has('remember')) { //code below if only user did not ticked "Do not update image"
				
			    //remove the prev image from folder (100%).........
			    //delete a prev/old image from folder '/images/polymorphic/'
		        $product = Polymorphic_Images::where('imageable_id', $request->input('hidden-prod-id'))->first(); //found image 
		    
			    $pieces = explode("/images/polymorphic/", $product->url); //as db column saves image url as "/images/polymorphic/someName" we need to "someName" first
			    if(file_exists(public_path('images/polymorphic/' . $pieces[1]))){ //$pieces[1] is an image name without "/images/polymorphic/
		            \Illuminate\Support\Facades\File::delete('images/polymorphic/' . $pieces[1]);
		        }
			
			
			
			
			    // So far, Intervention is not used here. Copy from working example
		        //------------------------------------------------------------------
		        //Intervention Lib, resizing image + save ----- //https://stackoverflow.com/questions/59300544/how-to-reduce-size-of-image-in-laravel-when-upload
	            /*
			    if($request->file('image') != null){ //if a user uploaded an image which is NOT OBLIGATORY REQUIRED for UPDATE
		            $image = $request->file('image'); //uploded image 
		            $imageName = time(). '_' . $request->image->getClientOriginalName(); //new name (time + originalName). //Prev variant (before implement Intervention resize). Working!!!
                    //$input['imagename'] = time().  '_' . $request->image->getClientOriginalName(); // . '.'.$image->getClientOriginalExtension(); //create name: time+name+extension

                    $destinationPath = public_path('images/employees');
                    $img = Image::make($image->getRealPath());
		
		            //watermark
		            $watermark = Image::make('images/water-mark.png'); //watermark
		            $watermark->resize(20, 20); //watermark resize
		
		            //resize avatar image to (300, 300) + adding watermark + save. Uses method chaining. Alternatively can do separately $img->resize(); $img->insert(); $img-save();
                    $img->resize(300, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })
		            ->insert($watermark, 'bottom-right', 10, 10) // insert watermark at bottom-right corner with 10px offset
		            ->save($destinationPath.'/' . $imageName); //save
                }
                */
               //$destinationPath = public_path('images/employees');
               //$image->move($destinationPath, $imageName);
	       
	           //END Intervention Lib, resizing image + save  -----
	           //------------------------------------------------------------------
			   //
			
			
			    //update the image in table Polymorphic_Images ------------------------------------------
			
			    //getting Image info for Flash Message
		        $imageName      = time(). '_' . $request->image->getClientOriginalName();
		        $sizeInByte     = $request->image->getSize() . ' byte';
		        $sizeInKiloByte = round( ($request->image->getSize() / 1024), 2 ). ' kilobyte'; //round 10.55364364 to 10.5
		        $fileExtens     =     $request->image->getClientOriginalExtension();
		        //getting Image info for Flash Message
			
			    //Move uploaded image to the specified folder 
		        request()->image->move(public_path('images/polymorphic'), $imageName);
		
		        //update image itself, table { polymorphic_images}
			    Polymorphic_Images::where('imageable_id', $request->input('hidden-prod-id') )->update([  'url' => '/images/polymorphic/' . $imageName, /* 'wpBlog_title' => $data['title'], */  ]);
            
			} else { // end if(!$request->has('remember')) 
			    $imageName  = " User opted not to update the imaged";
			    $sizeInByte = "";
			}
			
			//End update the image in table Polymorphic_Images -------------------------------------



			
			
			//return response()->json(['success' => 'Data is successfully updated.]); //Version for JSON
			return redirect()->back()->withInput()->with('flashMessageX', 'Data is successfully updated! Connected image is: <b> ' . $imageName . ' ' . $sizeInByte  . ' </b>');

		} else {
			//return response()->json(['success' => 'Failed to update']);             //Version for JSON
			return redirect()->back()->withInput()->with('flashMessageFailX', 'Failed to update!!!' );


		}
		//
	}
	
	
	
}
