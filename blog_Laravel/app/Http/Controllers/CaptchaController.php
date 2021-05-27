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
        
        //test of Laravel Notify package
        //$when = now()->addSeconds(3);//addMinutes(1);
		notify()->success('Laravel Notify is awesome!');
        //notify()->success('Laravel Notify is awesome222!')->delay($when);
        //connectify('success', 'Connection Found', 'Success Message Here');
        //drakify('success');
        //smilify('success', 'You are successfully reconnected');
        
        //generates hand-made captcha
        $length = 4;
        $UUID = "sh-" . time() ."-". substr( md5(uniqid()), 0, $length); 
        $_SESSION['captcha_1604938863'] = $UUID;
        
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
