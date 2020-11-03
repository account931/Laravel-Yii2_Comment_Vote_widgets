<?php
//RBAC uses Entrust package
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View; //for return View::make
use App\models\EntrustRbac\Role; //model for Entrust Role model
use App\User;
use MyHelper; //my helper
use Illuminate\Validation\Rule; //for in: validation
use Illuminate\Support\Facades\Validator; //for form validation
//use Zizaco\Entrust\Traits\EntrustUserTrait; // not used???
//use Zizaco\Entrust\EntrustRole; // not used???
use App\models\EntrustRbac\My_rbac\Role_User; //model for DB table Role_User

class RbacController extends Controller
{
    /**
     * display Users Table with Control Panel wo change RBAC roles
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	
	     //check if logged
		 if (!Auth::check()){
			 $text = 'You are not logged, <a href="'. route('login') . '"> click here  </a>  to login';
			 throw new \App\Exceptions\myException( $text );
		 }
		
		
		/*//attach role to user
	   $user = User::where('id', '=', 2)->first();
       
       // role attach alias
       $user->attachRole($admin); // parameter can be an Role object, array, or id
	   */
	   
	    $userX = User::find( \Auth::user()->id ); //to pass to view, for checking with Blade
	  
	    //$user = auth()->user(); //gets current user
		//dd(auth()->user()->id);
		$user = \App\User::find( \Auth::user()->id );

		//$admin_role = Role::where('name', 'admin')->get()->first();
	
		//dd(Auth::user()->hasRole('admin'));
		
		if(Auth::user()->hasRole('admin')){ //arg $admin_role does not work
		//if ($user->hasRole('admin')) { //works either, but need to get {$user} first =>  $user = \App\User::find( \Auth::user()->id );
			$rbacStatus = "You have RBAC Role Admin to view this page";
			$status = true;
			
        } else {
			$rbacStatus = "You have NO RBAC Role Admin to view this page";
			$status = false;
            //throw new \App\Exceptions\myException('You have No rbac rights');
		}
		
        $allUsers = User::all(); //find all users for table
		$allRoles = Role::all(); //find all roles for dropdown
		//dd($allRoles);				 
        //return view('rbac.rbacView', compact('rbacStatus', 'status', 'userX', 'allUsers', 'allRoles')); 		
	    return View::make('rbac.rbacView')->with(compact('rbacStatus', 'status', 'userX', 'allUsers', 'allRoles'));
	}
	
	
	
    /**
     * method to create roles in RBAC (run it one time)
     *
     * @return \Illuminate\Http\Response
     */
    public function createRoles()
    {	
        //create role
		/*
        $adminX = new Role();
        $adminX->name         = 'adminX';
        $adminX->display_name = 'User AdministratorX'; // optional
        $adminX->description  = 'User is allowed to manage and edit other users'; // optional
        $adminX->save();
		*/
		
		
		$user = User::where('id', '=', 2)->first();
       //dd($user);
       // role attach alias
       //$user->attachRole('admin'); // parameter can be an Role object, array, or id
	   
	   /*
	   $admin= Role::where('name', 'admin')->get()->first();
	   $user->roles()->attach($admin);
	   */
	   
	   $model = new Role(); 
	   //$model ->setup();
       $model ->assign();	   
	   echo "Good";
	   
	   
    }
	
	
	
    /**
     * method to assign role (from RBAC Table Control Panel )
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assignRole(Request $request)
    {
		
		//getting all existing roles from DB, get from DB only column "id". Used for validation in range {Rule::in(['admin', 'owner']) ]}, ['13', '17']
		$existingRoles = Role::select('id')->get(); 
		$rolesList  = array(); // array to contain all roles id  from DB in format ['13', '17']
		foreach($existingRoles as $n){
			array_push($rolesList, $n->id);	
		}
		//dd($rolesList);
		
		
		

		//dd ($request->input('role_sel'));
		//dd($request);
		//dd($request->attributes);
		
		//validation rules
        $rules = [
			//'role_sel' => ['required', 'string', Rule::in(['admin', 'owner']) ] , //validation in range 
			  'role_sel' => [ 'required', 'string', Rule::in( $rolesList ) ] , //validation in range, i.e Rule::in(['admin', 'owner']) ] =['13', '17']
			
		];
		
		//creating custom error messages. Should pass it as 3rd param in Validator::make()
		$mess = [
			'role_sel.required' => 'Required.We need the role to be specified',
		];
		
		//validate the input
		$validator = Validator::make($request->all(),$rules, $mess);
		
		//if validation fails
		if ($validator->fails()) {
			return redirect('/rbac')
			->withInput()
			->with('flashMessageFailX',"Validation Failed")
			->withErrors($validator);
		} else {
			
		    //apart from {required} validation rule, check if {$request->input('role_sel')}, i.e $_POST['role_sel'] in not null (if user clicked "assigned" while did not select a role in dropdown). Actually, it should never fire, as validation "required" works first
		    if($request->input('role_sel') == null){
		      return redirect('/rbac')->with('flashMessageFailX', "Stopped. No role was selected" );
		    }
		
		    //if a selected user has already the role u want to assign to him. intval() is a must as $_POST is string
			if( Role_User::where('user_id', intval($request->input('user_id')))->where('role_id', intval($request->input('role_sel')) )->exists()) { 
		       //gets the role name by id from DB table Roles
				$roleAssigned = Role::where('id', intval($request->input('role_sel')))->get()[0]->name;
				
			   return redirect('/rbac')->with('flashMessageFailX', "Stopped. User <b> " . User::where('id', intval($request->input('user_id')))->get()[0]->name . " </b>has already role <b>" . $roleAssigned .  "</b> u want to assign" );
		    }
			
			//assign a selected user with a selected role
			$model = new Role(); 
	        if($model->assignSelectedRoleToSelectedUser(intval($request->input('user_id')), intval($request->input('role_sel')) )){
		        
				//gets the role name by id from DB table Roles
				$roleAssigned = Role::where('id', intval($request->input('role_sel')))->get()[0]->name;
				
				//gets the user name by id from DB table Users
				$userAssigned = User::where('id', intval($request->input('user_id')))->get()[0]->name;
				
				return redirect('/rbac')->with('flashMessageX', "Assigned user <b>" . $userAssigned . " </b> successfully with role <b> " . $roleAssigned. "</b>" );
	        
			} else {
				//something failed
				return redirect('/rbac')->with('flashMessageFailX', "Something went wrong" );
			}				
		}
	}
	
	
	
	
	/**
     * method to detach a certain role from certain user (from RBAC Table Control Panel), send via POST form
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detachRole(Request $request)
    {
		//gets the role name by id from DB table Roles
		$roleDetached = Role::where('id', intval($request->input('role_id')))->get()[0]->name;
		
		//gets the user name by id from DB table Users
		$userDetached = User::where('id', intval($request->input('user_id')))->get()[0]->name;
		
		//Works ONLY if u have 'admin' Rbac role in your web application!!!!!!
		//check if current user tries to detach/remove "admin" right from himself, i.e he will loose access to this RBAC panel
		$RoleAdmin = Role::where('name', 'admin')->get()->first(); //gets Object role 'admin' from Db
		if($RoleAdmin){
		    if(intval($request->input('user_id')) == auth()->user()->id && intval($request->input('role_id')) == $RoleAdmin->id ){
			    //throw new \App\Exceptions\myException("You attempeted to detach your own Admin roles that would result in loosing access to this RBAC Panel");
		        return redirect('/rbac')->with('flashMessageFailX', "<b>Danger!!! <i class='fa fa-thumbs-o-down'></i></b></br><i>You attempeted to detach your own Admin roles that would result in loosing access to this RBAC Panel</i>" );
		    }
		}
		
		//assign a selected user with a selected role
		$model = new Role();
		if($model->detachSelectedRoleFromSelectedUser(intval($request->input('user_id')), intval($request->input('role_id')) )){
		    return redirect('/rbac')->with('flashMessageX', "Detached successfully role <b> " . $roleDetached  . "</b> from user <b> " . $userDetached . "</b>" );
        } else {
			return redirect('/rbac')->with('flashMessageFailX', "Failed Detaching role <b> " . $roleDetached  . "</b> from user <b> " . $userDetached . "</b>" );

		}
	
	}
	
	
	
	/**
     * method to add/create a new role to Db table Role, send via POST
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeNewRole(Request $request)
    {
		
		//validation rules
        $rules = [
			'rname' => ['required', 'string', 'min:4' ] , 
			'rDescr' => [ 'required', 'string', 'min:8' ] , 
			
		];
		
		//creating custom error messages. Should pass it as 3rd param in Validator::make()
		$messages = [
			'rname.required' => 'Required.We need the name to be specified',
			'rDescr.min' => 'Description must be at least 8 letters'
		];
		
		//validate the input
		$validator = Validator::make($request->all(),$rules, $messages);
		
		//if validation fails
		if ($validator->fails()) {
			return redirect('/rbac')
			->withInput()
			->with('flashMessageFailX',"Validation Failed")
			->withErrors($validator);
		
		//if validation is OK
		} else {  
		    //create/insert a new role
			
			if (Role::where('name', $request->input('rname'))->exists()){ 	
			    return redirect('/rbac')->with('flashMessageFailX', "Stopped. Role role <b> " . $request->input('rname')  . "</b> already exists" );
			}
			
 		    $model = new Role();
			
		    if($model->createNewRole($request->input('rname'), $request->input('rDescr'))){
		        return redirect('/rbac')->with('flashMessageX', "Successfully created a new role <b> " . $request->input('rname')  . "</b>" );
            } else {
			   return redirect('/rbac')->with('flashMessageFailX', "Failed to create a new role <b> " . $request->input('rname')  . "</b>" );
		    }
		   
		}
	}
	

	
	
	
}