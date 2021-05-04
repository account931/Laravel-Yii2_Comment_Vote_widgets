<?php
//Example of Socialite Package (Facebook, Google)
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
//Socialite
use App\User;
use Validator;
use Socialite; //use Laravel\Socialite\Facades\Socialite;
use Exception;


class SocialiteController extends Controller
{
    protected $user = null;
	
    public function __construct()
    {
    }

	
	/**
    * Display Facebook/Google login.
    * @return string
    *
    */
    
	public function index()
    {

        
		return view('socialite.index'/*, compact('users', 'oneUser')*/);

    }
    
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }


    public function loginWithFacebook()
    {
        try {
    
            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('fb_id', $user->id)->first();
     
            if($isUser){
                Auth::login($isUser);
                return redirect('/socialite');
            }else{
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'password' => encrypt('admin@123')
                ]);
    
                Auth::login($createUser);
                return redirect('/socialite');
            }
    
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
