<?php // Code within app\Helpers\Helper_Rbac.php

namespace App\Http\MyHelpers\Rbac;

class Helper_Rbac
{
	
	/**
     * test helper metod, makes any string UpperCase
     *
     * @return 
     */
    public static function stringMakeUpperCase(string $string)
    {
        return strtoupper($string);
    }
	
	
	
	
	/**
     * methods to display list of user's Rbac roles
     * @param User $userModel
     * @return string
     */
    public static function displayUserRoles($userModel)
    {
        //getting all current loop user's roles 
		if (isset($userModel->roles[0]['name'])) { //if $user->roles (it is hasMany relation) found any role by user
		    $r = "";
		    //use for() loop in case user has 2 and more roles. If user could have only 1 role, we would just use {$userModel->roles[0]['name']}
			for($j =0; $j < count($userModel->roles); $j++){
			    $r.= "<span class='text-danger'><i class='fa fa-check-circle-o'></i> " . $userModel->roles[$j]['name'] . "</span></br>"; 
			}  
		} else { 
		    $r = 'no role';
		} 
		return $r;
										
    }
}