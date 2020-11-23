<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\ShopSimple\ShopOrdersMain; //model for DB table {shop_orders_main} that stores general info about the order (general amount, price, email, etc )
use App\models\ShopSimple\ShopOrdersItems; //model for DB table {shop_order_item} to store a one user's order split by items, ie if Order contains 2 items (dvdx2, iphonex3). 

use Illuminate\Support\Facades\DB; //???

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
		
		//INNER JOIN on 2 tables 
		//find all orders from table {shop_orders_main}
		/*
		$shop_orders_main = ShopOrdersMain::where('ord_status', 'not-proceeded')
		//->select('users.id','users.name','profiles.photo')
        ->join('shop_order_item','shop_order_item.order_id','=','shop_orders_main.order_id')
        //->where(['something' => 'something', 'otherThing' => 'otherThing'])
        ->get();
		//->paginate(3); 
		*/
		
		/*
		  DB::table('shop_orders_main')
//->select('shop_orders_main.id','shop_orders_main.name','shop_order_item.photo')
->join('shop_order_item','shop_order_item.order_id','=','shop_orders_main.order_id')
//->where(['something' => 'something', 'otherThing' => 'otherThing'])
->get();
*/
       //https://stackoverflow.com/questions/29165410/how-to-join-three-table-by-laravel-eloquent-model
       //$shop_orders_main = ShopOrdersMain::with('items')->get();
	   $shop_orders_main = ShopOrdersMain::where('ord_status', 'not-proceeded')->paginate(3); 
	   
	    
		/*
		$shop_orders_main = ShopOrdersMain::where('ord_status', 'not-proceeded')->paginate(3); 
		
		$shop_orders_main->map(function ($cat){
            $cat->items = ShopOrdersItems::where('order_id',$cat->order_id)->get();
        });
		*/
		
		return view('ShopPaypalSimple_AdminPanel.orders')->with(compact('shop_orders_main')); 
	}
	
}
