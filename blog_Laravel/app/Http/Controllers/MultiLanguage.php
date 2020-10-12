<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Cookie;

class MultiLanguage extends Controller
{
     /**
     * Show .....
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	
		
		//check if $_GET['l'] is NOT set
		if (!isset( $_GET['l'] )){ //gets $_GET['l'] param), we check if $_GET['l'] is NOT set
		    
		     if (!Cookie::get('language')){ //If Cookie 'language' is not set
		        //if no language is set,set it to "en-US" by default/ Otherwise, it display no lanaguage status during the 1st visit
                //if(!\Yii::$app->language) {
					App::setLocale('en-US');
	               //\Yii::$app->language = 'en-US';
	            //}
		    } else { //if language is set in Cookies use it
			     App::setLocale( Cookie::get('language'));
		    }
			
			$lang = Cookie::get('language'); //pass var to view
		
        //if $_GET['l'] is set in URL, then use it
		} else {
		
		    $lang = $_GET['l']; //gets $_GET['l'] param
			App::setLocale($lang); //set the language
			
			//sets lang to cookie
			Cookie::queue('language', $lang, 9999); //working!!!!
			
		}
		
		
		
		 
		 return view('multiLanguage.multi',  compact('lang'));
		//return view('wpBlog.wpblog',  compact('articles', 'categories', 'countArticles'));

	}
}
