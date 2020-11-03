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
     * methods to display list of user's Rbac roles + Delete option, If 2nd param is TRUE. (Deletion uses <form>. Form submitted via Swal (my-rbac.js))
     * @param User $userModel to pass in loop or standalong
	 * @param boolean $buildDeleteButton (if true, additionally creates a POST form with button to detaching/deleting the role from user), if u pass no 2nd arg it is false by default 
     * @return string
     */
    public static function displayUserRoles($userModel, $buildDeleteButton = false)
    {
        //getting all current loop user's roles 
		if (isset($userModel->roles[0]['name'])) { //if $user->roles (it is hasMany relation) found any role by user
		    $r = "";
		    //use for() loop in case user has 2 and more roles. If user could have only 1 role, we would just use {$userModel->roles[0]['name']}
			for($j =0; $j < count($userModel->roles); $j++){
				$r.= "<div class='row'></div>";
			    $r.= "<div class='col-sm-9 col-xs-9 text-danger'><i class='fa fa-check-circle-o'></i> " . $userModel->roles[$j]['name'] . "</div> "; 
				
				//build/create a POST form with button to detaching/deleting a certain role from certain user (if 2nd arg is true)
				if($buildDeleteButton == true){
					 $r.= "<div class='col-sm-1 col-xs-1 text-delete'>"; 
					 $r.= '<form class="detach" method="post" action="' . url("/detachRole") . '" >' .
                          '<input type="hidden" value="' . csrf_token() . '" name="_token" />' .
						  '<input type="hidden" value="' . $userModel->id . '" name="user_id" />' .
						  '<input type="hidden" value="' . $userModel->roles[$j]['id'] . '" name="role_id" />' .
					      '<button type="submit" class="detach-role" data-uName="' . $userModel->name . '" data-uRole="' . $userModel->roles[$j]['name'] . '"><i class="fa fa-remove"></i> </button> ' .
                    '</form>' .
					'</div>';
											
											
				    	
				}
			}  
		} else { 
		    $r = 'no role';
		} 
		return $r;
										
    }
}