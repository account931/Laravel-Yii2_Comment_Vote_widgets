<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\ShopSimple\ShopOrdersMain; //model for DB table {shop_orders_main} that stores general info about the order (general amount, price, email, etc )
use App\models\ShopSimple\ShopOrdersItems; //model for DB table {shop_order_item} to store a one user's order split by items, ie if Order contains 2 items (dvdx2, iphonex3). 
use App\models\ShopSimple\ShopSimple;     //model for DB table 
use App\models\ShopSimple\ShopCategories; //model for DB table 

use Illuminate\Support\Facades\DB; //???
use App\Http\Requests\ShopPaypalSimple_AdminPanel\OrderStatusChangeRequest; //my custom Form validation via Request Class (to update status in table {shop_orders_main})
use App\Http\Requests\ShopPaypalSimple_AdminPanel\SaveNewProductRequest; //my custom Form validation via Request Class (to create a new product in table {shop_simple})



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
	






 //==================================  Orders view section =================================================	
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
		
		//count separatedly proceeded, not-proceeded, delivered 
		$countProceeded =    ShopOrdersMain::where('ord_status', 'proceeded')->count();    //for counting 
		$countNotProceeded = ShopOrdersMain::where('ord_status', 'not-proceeded')->count();    //for counting 
		$countDelivered =    ShopOrdersMain::where('ord_status', 'delivered')->count();    //for counting 
		

		return view('ShopPaypalSimple_AdminPanel.orders')
		    ->with(compact('shop_orders_main', 'countOrders', 'countProceeded', 'countNotProceeded', 'countDelivered' /*, 'itemsInOrder'*/)); 
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
	
	
	
	
	
	
	/**
     * method to update Order Status in AdminPanel, from {public function orders()}. (E.g  change from 'proceeded' to 'not-proceeded')
     * @param  \Illuminate\Http\OrderStatusChangeRequest  $request
     * @return \Illuminate\Http\Response
     */
	 
    public function updateStatusField(OrderStatusChangeRequest $request)
	{
		//if $_POST['productID'] is not passed. In case the user navigates to this page by enetering URL directly, without submitting from with $_POST
		if(!$request->input('u_orderID')){
			throw new \App\Exceptions\myException('Bad request, You are not expected to enter this page.');
		}
		
		
		//dd($request->input('u_status') . " = " .  $request->input('u_orderID') ); //gets quantity from form $_POST[]);
	    $orderID = $request->input('u_orderID');
		$orderStatus = $request->input('u_status');
		
		//check if user/admin wants to change the current Order status to the same value, e.g the status is 'proceeded' and admin wants change to the same 'proceeded;
	    $OneOrder = ShopOrdersMain::where('order_id', $request->input('u_orderID'))->first(); 
		
		if($OneOrder->ord_status == $request->input('u_status')){
		    return redirect()->back()->withInput()->with('flashMessageFailX', 'You tried to update Order <b>' . $orderID . ' </b> Status with the same value <b>' . ucfirst($orderStatus) . '</b>. It is unacceptable!!!' );

		} else { //it is OK to update
			ShopOrdersMain::where('order_id', $request->input('u_orderID'))->update([  'ord_status' => $orderStatus ]);
			return redirect()->back()->withInput()->with('flashMessageX', 'You successfully update Order <b>' . $orderID . ' </b> with new Status <b> ' . ucfirst($orderStatus) . '</b>' );
		}
	}
	
 //================================== End Orders view section =================================================

	
	
	
	
	
	
	
	
	
	
	
	
 //================================== Products view section =================================================
	
	
    /**
     * Display admin panel view with all shop products and option to edit, add new
     * @param  
     * @return \Illuminate\Http\Response
     */
	 
    public function products()
    {
		if(!Auth::user()->hasRole('admin')){ //arg $admin_role does not work
           throw new \App\Exceptions\myException('You have No rbac rights to Admin Panel');
		}
		
		$allProducts = ShopSimple::paginate(7); //all shop products with pagination
		$allCategories = ShopCategories::all();  //for <select> dropdown
		$allProductsSearchBar = ShopSimple::all();  // for Search Bar
		
		return view('ShopPaypalSimple_AdminPanel.shop-products.shop-products-list')->with(compact('allProducts', 'allCategories', 'allProductsSearchBar'));  
	}
	
	
	
	
	/**
     * Display admin page with a form to add a new product
     * @param  
     * @return \Illuminate\Http\Response
     */
	 
    public function addProduct()
    {
		if(!Auth::user()->hasRole('admin')){ //arg $admin_role does not work
           throw new \App\Exceptions\myException('You have No rbac rights to Admin Panel');
		}
		
		$allCategories = ShopCategories::all();  //for <select> dropdown in form
		
		return view('ShopPaypalSimple_AdminPanel.shop-products.add-product')->with(compact('allCategories'));  
	}
	
	
	
	
	/**
     * Saves new product to DB. Gets $_POST[''] seny by form in {public function addProduct()}
     * @param  
     * @return \Illuminate\Http\Response
     */
	 
    public function storeProduct(SaveNewProductRequest $request)
    {
		if(!Auth::user()->hasRole('admin')){ //arg $admin_role does not work
           throw new \App\Exceptions\myException('You have No rbac rights to Admin Panel');
		}
		
		//if $_POST['productID'] is not passed. In case the user navigates to this page by enetering URL directly, without submitting from with $_POST
		if(!$request->input('product-desr')){
			throw new \App\Exceptions\myException('Bad request, You are not expected to enter this page.');
		}
		
		
		/*
		$imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);
        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName);
		*/
		//dd($request->input('image')); // Not working
		//dd($request->image);
		
		//$filename = $this->getFileName($request->image);
		
		
		$imageName = time(). '_' . $request->image->getClientOriginalName();
		$sizeInByte =     $request->image->getSize() . ' byte';
		$sizeInKiloByte = round( ($request->image->getSize() / 1024), 2 ). ' kilobyte'; //round 10.55364364 to 10.5
		$fileExtens =     $request->image->getClientOriginalExtension();
		
	     return redirect('/admin-add-product')->withInput()
		       ->with('flashMessageX', 'Validation is OK. Implement saving to DB. Image is ' . $imageName  . '. Size is ' . $sizeInByte . ' or ' . $sizeInKiloByte . '. Format is <b>' . $fileExtens . '</b>')
		       ->with('image',$imageName);
 
	}         
	
	
	
    /**
     * Display one product view by ID
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
		//dd($productOne);
		
		return view('ShopPaypalSimple_AdminPanel.shop-products.adm-one-product')->with(compact('productOne'));  
	}
	
	
	
	
	
	/**
     * Display form to edit an existing product
     * @param  
     * @return \Illuminate\Http\Response
     */
	 
    public function editProduct($id)
    {
	    if(!Auth::user()->hasRole('admin')){ //arg $admin_role does not work
           throw new \App\Exceptions\myException('You have No rbac rights to Admin Panel');
		}
		
		//find the product by id
		$productOne = ShopSimple::where('shop_id', $id)->get();
		
		return view('ShopPaypalSimple_AdminPanel.shop-products.edit-product')->with(compact('productOne'));  
	}
	
	
	
	
	
	
	//================================== END Products view section =================================================
	
	

	
	
	
	
	
	
	
	
}
