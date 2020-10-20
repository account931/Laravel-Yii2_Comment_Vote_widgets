<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\Role; //model for all wpress_category
use App\User;
//use Zizaco\Entrust\Traits\EntrustUserTrait; // not used???
//use Zizaco\Entrust\EntrustRole; // not used???

class RbacController extends Controller
{
    /**
     * Show .....
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	
	     //check if logged
		 if (!Auth::check()){
			 //$link = <a href="{{ route('login') }}">Login </a>;
			 //$text = "Login first" . "<a href='#'> Login </a>";
			 $text = url("/some");
			 throw new \App\Exceptions\myException( htmlspecialchars_decode($text) );
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
		

						 
        return view('rbac.rbacView', compact('rbacStatus', 'status', 'userX')); 		
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
}
