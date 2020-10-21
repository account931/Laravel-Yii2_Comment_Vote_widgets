<?php 
//it is Entrust RBAC model

namespace App\models\EntrustRbac;

use Zizaco\Entrust\EntrustRole;
use App\User;


class Role extends EntrustRole
{
	//creates roles in DB (to create roles manually, must be run by admin one time only)
	public function setup() 
    {
		$roleOwner =  self::where('name', 'owner')->get();
		if (!$roleOwner){ //if doesnot exist
		    $owner = new Role();
            $owner->name         = 'owner';
            $owner->display_name = 'Project Owner'; // optional
            $owner->description  = 'User is the owner of a given project'; // optional
            $owner->save();
		}
		
    
        $roleAdmin =  self::where('name', 'admin')->get();
		if (!$roleAdmin){ //if doesnot exist
            $admin = new Role();
            $admin->name         = 'admin';
            $admin->display_name = 'User Administrator'; // optional
            $admin->description  = 'User is allowed to manage and edit other users'; // optional
            $admin->save();
		}

        $roleManager =  self::where('name', 'manager')->get();
		if (!$roleAdmin){ //if doesnot exist
           $manager = new Role();
           $manager->name         = 'manager';
           $manager->display_name = 'Company Manager'; // optional
           $manager->description  = 'User is a manager of a Department'; // optional
           $manager->save();
		} else {
			dd('Roles exist');}
    }

   /*
	function test(){
		
		$ownerX = new Role();
        $ownerX->name         = 'ownerX';
        $ownerX->display_name = 'Project Owner'; // optional
        $ownerX->description  = 'User is the ownerX of a given project'; // optional
        $ownerX->save();

        $adminX = new Role();
        $adminX->name         = 'adminX';
        $adminX->display_name = 'User AdministratorX'; // optional
        $adminX->description  = 'User is allowed to manage and edit other users'; // optional
        $adminX->save();
		
		
		//attach role to user
	   $user = User::where('id', '=', 2)->first();
       
       // role attach alias
       $user->attachRole($adminX); // parameter can be an Role object, array, or id
	} 
	*/
	
	
	public function assign() 
    {
	   //$user = User::where('id', '=', auth()->user()->id)->first();
	   $user = User::find(\Auth::user()->id );
       //dd($user);
       // role attach alias
       //$user->attachRole('admin'); // parameter can be an Role object, array, or id
	   $admin_role= self::where('name', 'admin')->get()->first();
	   $user->roles()->attach($admin_role);
	   dd("Great");
	}
}