<?php

namespace App\Http\Controllers\ShopPayPalSimple_AdminPanel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\ShopSimple\ShopOrdersMain; //model for DB table {shop_orders_main} that stores general info about the order (general amount, price, email, etc )
use App\models\ShopSimple\ShopOrdersItems; //model for DB table {shop_order_item} to store a one user's order split by items, ie if Order contains 2 items (dvdx2, iphonex3). 
use App\models\ShopSimple\ShopSimple;     //model for DB table 
use App\models\ShopSimple\ShopCategories; //model for DB table 

use Illuminate\Support\Facades\DB; //???
use App\Http\Requests\ShopPaypalSimple_AdminPanel\OrderStatusChangeRequest; //my custom Form validation via Request Class (to update status in table {shop_orders_main})
use App\Http\Requests\ShopPaypalSimple_AdminPanel\SaveNewProductRequest; //my custom Form validation via Request Class (to create a new product in table {shop_simple})



class Shop_AdminPanel_All_Products extends Controller
{
    
	public function __construct(){
		$this->middleware('auth');
		/*if (!Auth::check()){
			throw new \App\Exceptions\myException('You are not logged');
		} */
		
	}
	
	
	
 //================================== Products view section =================================================
	//NOT WORKING=> Class App\Http\Controllers\Shop_AdminPanel_All_Products does not exist
	
    /**
     * Display 
     * @param  
     * @return \Illuminate\Http\Response
     */
	 
    public function showOneProduct($id)
    {
		if(!Auth::user()->hasRole('admin')){ //arg $admin_role does not work
           throw new \App\Exceptions\myException('You have No rbac rights to Admin Panel');
		}
		
		//find the product by id
		$productOne = ShopSimple::where('shop_id', $id)->get();
		
		return view('ShopPaypalSimple_AdminPanel.shop-products.adm-one-product')->with(compact('productOne'));  
	}
	
	
	
	
	
	
	//================================== END Products view section =================================================
	
	

	
	
	
	
	
	
	
	
}
