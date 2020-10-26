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
		//dd ($request->input('role_sel'));
		//dd($request);
		//dd($request->attributes);
		//validation rules
        $rules = [
			'role_sel' => ['required', 'string', Rule::in(['admin', 'owner']) ] , //integer
		];
		
		//creating custom error messages. Should pass it as 3rd param in Validator::make()
		$mess = [
			'role_sel.required' => 'We need the role to be specified',
		];
		
		$validator = Validator::make($request->all(),$rules, $mess);
		if ($validator->fails()) {
			return redirect('/rbac')
			->withInput()
			->with('flashMessageFailX',"Validation Failed")
			->withErrors($validator);
		} else {
		
		   return redirect('/rbac')->with('flashMessageX', "Assigned successfully with <b> " . $request->input('role_sel') . "</b>" );
	    }   
	}
	
}
