<?php
//Example of Repository Pattern (Controller -> Service Layout -> Repository -> Model)
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
		//getting all users via Service Layer
		$users = $this->user->getAllUsers();
        //dd($users);
        
        //getting one via Service Layer
		$oneUser = $this->user->getUserById(1);
        
		return view('service-layout.index', compact('users', 'oneUser'));

    }
}
