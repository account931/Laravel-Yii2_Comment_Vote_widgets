<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopPayPalSimpleController extends Controller
{
    
	
	/**
     * display 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$item = "Good";
	    
		return view('ShopPaypalSimple.shopIndex')->with(compact('item')); 
	}
	
}
