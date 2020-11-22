<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\ShopSimple\ShopOrdersMain; //model for DB table {shop_orders_main} that stores general info about the order (general amount, price, email, etc )
use App\models\ShopSimple\ShopOrdersItems; //model for DB table {shop_order_item} to store a one user's order split by items, ie if Order contains 2 items (dvdx2, iphonex3). 

class ShopPayPalSimple_AdminPanel extends Controller
{
    
	public function __construct(){
		$this->middleware('auth');
		/*if (!Auth::check()){
			throw new \App\Exceptions\myException('You are not logged');
		} */
		
	}
	
	
	/**
     * display Admin Panel start page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(!Auth::user()->hasRole('admin')){ //arg $admin_role does not work
           throw new \App\Exceptions\myException('You have No rbac rights to Admin Panel');
		}
		
		$item = "Good";
	    
		return view('ShopPaypalSimple_AdminPanel.adminPanelMain')->with(compact('item')); 
	}
	
	
	/**
     * display Admin Panel Orders page
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
		if(!Auth::user()->hasRole('admin')){ //arg $admin_role does not work
           throw new \App\Exceptions\myException('You have No rbac rights to Admin Panel');
		}
		
		$orderedItem = ShopOrdersMain::where('ord_status', 'not-proceeded')->paginate(3); 
	    //dd($orderedItem);
		return view('ShopPaypalSimple_AdminPanel.orders')->with(compact('orderedItem')); 
	}
	
}
