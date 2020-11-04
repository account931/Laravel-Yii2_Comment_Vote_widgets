<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopPayPalSimpleController extends Controller
{
    
	
	/**
     * display shop start page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$item = "Good";
	    
		return view('ShopPaypalSimple.shopIndex')->with(compact('item')); 
	}
	
	
	/**
     * display Cart page
     *
     * @return \Illuminate\Http\Response
     */
    public function cart()
    {
		$item = "Good";
	    
		return view('ShopPaypalSimple.cart')->with(compact('item')); 
	}
	
	
}
