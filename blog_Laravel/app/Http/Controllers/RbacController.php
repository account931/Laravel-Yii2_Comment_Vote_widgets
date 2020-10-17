<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\Role; //model for all wpress_category
use App\User;

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
			 $text = "Login first <a href='" .  route('login')  . "'> Login </a>";
			 throw new \App\Exceptions\myException( $text  );
		 }
		
		
		/*//attach role to user
	   $user = User::where('id', '=', 2)->first();
       
       // role attach alias
       $user->attachRole($admin); // parameter can be an Role object, array, or id
	   */
	   
	   
	    //$user = auth()->user(); //gets current user
		//dd(auth()->user()->id);
		$user = User::find(auth()->user()->id);
		//$user = User::where('id', auth()->user()->id)->get()->first();
		$admin_role= Role::where('name', 'admin')->get()->first();
		
		
		//dd($user->hasRole('admin'));
		
		
		
		//if(!Auth::user()->hasRole('admin')){
		if (!$user->hasRole('admin')) {
			$rbacStatus = "You have NO RBAC Role Admin to view this page";
			$status = false;
            //throw new \App\Exceptions\myException('You have No rbac rights');
        } else {
			$rbacStatus = "You have RBAC Role Admin to view this page";
			$status = true;
		}
		

						 
        return view('rbac.rbacView', compact('rbacStatus', 'status')); 		
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
