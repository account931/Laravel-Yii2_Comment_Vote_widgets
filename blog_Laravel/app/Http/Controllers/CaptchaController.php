<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
//use App\models\ShopSimple\ShopSimple;      //model for DB table 


class CaptchaController extends Controller
{
    public function __construct(){
		   
	}
	
	
	
	/**
     * Show start page  
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        session_start();
        
        //test of Laravel Notify package, can config at /config/notify.php
		notify()->success('Laravel Notify. Can modify me at /config/notify.php. Can send Notify from other function like flash messages (just add in view @include("notify::messages"))');
        //connectify('success', 'Connection Found', 'Can modify me at /config/notify.php');
        //drakify('success');
        //smilify('success', 'You are successfully reconnected');
        
        //generates hand-made captcha
        $length = 4;
        $UUID = "sh-" . time() ."-". substr( md5(uniqid()), 0, $length); 
        $_SESSION['captcha_1604938863'] = $UUID;
        
        //convert text to image via GD Library
        $img = imagecreate(200, 60); //creates an empty canvas, an empty transparent rectangle //NEW EMPTY IMAGE OBJECT // imagecreate(WIDTH, HEIGHT)
        $white = imagecolorallocate($img, 255, 255, 255); //SET COLORS (background)//imagecolorallocate(IMAGE, RED, GREEN, BLUE)
        $black = imagecolorallocate($img, 0, 0, 0); //text color
        imagefilledrectangle($img, 0, 0, 200, 100, $white); // imagefilledrectangle(IMAGE, START X, START Y, END X, ENDY, COLOR) //fill a solid background to rectangle 
        imagestring($img, 5, 10, 20, $UUID, $black);   //to write the text to image //imagestring(IMAGE, FONT, X, Y(vertical), TEXT, COLOR) //// FONT is a number 1 to 5. 1 is smallest font size, 5 is biggest.
        imagepng($img, "captcha-image.png"); //saves image to /public/
        //imagedestroy($img); // OPTIONAL //not really required but good to have
        
        return view('captcha.index',  compact('UUID'));
    }
	
	
   
    /**
     * Handles $_POST of hand-made captcha
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function handCaptcha(Request $request)
    {   
        session_start();
        $sessCaptcha = $_SESSION['captcha_1604938863'];
        
        $rules = [
			'product-name'  => ['required', 'string', 'min:3'],
            'hand-captcha'  => ['required', 'string', Rule::in([$sessCaptcha])],            
		];
        
        $messages = [
            'product-name.min'       => 'First name at least 3 chars',
            'product-name.required'  => 'Please give us a name',
            'hand-captcha.in'        => 'Wrong captcha',
        ];

        $validator =  Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) { 
            //notify()->success('Validation failed'); //Works if there is no other Notification in target action
            return redirect()->back()
			    ->withInput()
			    ->with('flashMessageFailX', "Validation Failed")
			    ->withErrors($validator);
        }  
		
        if($_SESSION['captcha_1604938863'] != $request->input('hand-captcha')){
            return redirect()->back()->withInput()
			    ->with('flashMessageFailX', "Captcha is incorrect")
                ->withErrors($validator);//hand-captcha
		
        
        } else {
            //captcha is correct
            return redirect()->back()->withInput()
			    ->with('flashMessageX', "Captcha was correct. Input is: " . $request->input('product-name') .  ". Captcha is: " . $request->input('hand-captcha'));
        }
        
        //dd($request->all());  //$request->all()
        //return view('captcha.notify'/*,  compact('articles', 'categories', 'countArticles')*/);
    }
    
    
    
    /**
     * Handles $_POST of captcha Package "mews/captcha"
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function packageCaptcha(Request $request)
    { 
        if (request()->getMethod() == 'POST') {
            $rules = ['captcha' => 'required|captcha'];
            $validator = validator()->make(request()->all(), $rules);
            if ($validator->fails()) {
                echo '<p style="color: #ff0000;">Incorrect!</p>';
            } else {
                echo '<p style="color: #00ff30;">Matched :)</p>';
            }
        }
    }
	
}
