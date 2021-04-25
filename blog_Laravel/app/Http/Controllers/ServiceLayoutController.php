<?php
//shows my profile (a profile of currently logged user)
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\models\wpress_blog_post; //model for all posts
use App\users;
use Illuminate\Support\Facades\Log; //Logging

use App\Interfaces\IUserRepository; //My Interface

class ServiceLayoutController extends Controller
{
    protected $user = null;
	
	// IUserRepository is the interface
    public function __construct(IUserRepository $user)
    {
        $this->user = $user;
    }

	
	
	public function index()
    {
		
		$users = $this->user->getAllUsers();
        //dd($users);
        
		return view('service-layout.index', compact('users'));
		//return view('showprofile')->with(compact('id', 'name', 'email', 'yourArticles', 'user'));

    }
}
