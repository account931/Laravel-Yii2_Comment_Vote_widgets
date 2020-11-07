<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\ShopSimple\ShopSimple; //model for DB table 

class ShopPayPalSimpleController extends Controller
{
    
	
	/**
     * display shop start page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$allDBProducts = ShopSimple::all();
		//dd($allDBProducts);
	    
		return view('ShopPaypalSimple.shopIndex')->with(compact('allDBProducts')); 
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
