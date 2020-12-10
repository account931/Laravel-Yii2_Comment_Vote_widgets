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
		//RBAC control
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
	   
	   
	   
	   
	   
	   //Start hasMany Via ass (though working). Currently commented in view and reassigned to hasMany
	   /*
	   $shop_orders_main = ShopOrdersMain::where('ord_status', 'not-proceeded')->paginate(3); //all();//where('ord_status', 'not-proceeded')->get(); //->paginate(3); 
	   
	   $itemsInOrder = array();
	   foreach($shop_orders_main as $p){
		   //if( ShopOrdersItems::where('fk_order_id', $p->order_id) ->exists()){
		       $i = ShopOrdersItems::where('fk_order_id', $p->order_id)->get();
		       array_push($itemsInOrder, $i);
	       //}
	   }
	   */
	   //End  hasMany Via ass (though working). Currently commented in view and reassigned to hasMany
	    
		
		
		
	
		
		//---------------------------------------------------
		//if no $_GET['admOrderStatus'] - find all orders with {'ord_status', 'not-proceeded'} with pagination
	    if ( !isset($_GET['admOrderStatus']) ){ 
		    
		    //Find all orders by where clause. Will engage hasMany in view
		    $shop_orders_main = ShopOrdersMain::where('ord_status', 'not-proceeded')->orderBy('order_id', 'desc')->paginate(3);
			
		    //count all orders with {'ord_status', 'not-proceeded'}
			$countOrders =  ShopOrdersMain::where('ord_status', 'not-proceeded')->get();    //for counting 
		}
		
		
		//---------------------------------------------------
		//if isset GET['admOrderStatus'], find products by GET['admOrderStatus'] with pagination
		if(isset($_GET['admOrderStatus'])){
			
            //Find all orders by where clause. Will engage hasMany in view
		    $shop_orders_main = ShopOrdersMain::where('ord_status', $_GET['admOrderStatus'])->orderBy('order_id', 'desc')->paginate(3);
			
		    //count all orders with {'ord_status', 'not-proceeded'}
			$countOrders =  ShopOrdersMain::where('ord_status', $_GET['admOrderStatus'])->get();    //for counting 
			
		}
		
		

		return view('ShopPaypalSimple_AdminPanel.orders')->with(compact('shop_orders_main', 'itemsInOrder')); 
	}
	
	
	
	
	
	
	
	/**
     * for ajax counting
     *
     * @return \Illuminate\Http\Response
     */
	public function countOrders(){
		$count = ShopOrdersMain::where('ord_status', 'not-proceeded')->count();
        if(!$count){
			$count = 0;
		}	
        	
		return $count;
	}
	
}
