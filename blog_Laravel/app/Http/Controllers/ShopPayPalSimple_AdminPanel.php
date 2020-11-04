<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopPayPalSimple_AdminPanel extends Controller
{
    
	
	/**
     * display Admin Panel start page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$item = "Good";
	    
		return view('ShopPaypalSimple_AdminPanel.adminPanelMain')->with(compact('item')); 
	}
	
	
	
}
