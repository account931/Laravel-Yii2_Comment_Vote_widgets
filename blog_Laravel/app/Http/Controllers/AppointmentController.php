<?php
namespace App\Http\Controllers;

/*
use Illuminate\Http\Request;
use App\models\ShopSimple\ShopSimple;     //model for DB table 
use App\models\ShopSimple\ShopCategories; //model for DB table 
use Illuminate\Support\Facades\Validator;
use App\models\ShopSimple\ShopOrdersMain; //model for DB table {shop_orders_main} that stores general info about the order (general amount, price, email, etc )
use App\models\ShopSimple\ShopOrdersItems; //model for DB table {shop_order_item} to store a one user's order split by items, ie if Order contains 2 items (dvdx2, iphonex3). 
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ShopShippingRequest; //my custom Form validation via Request
*/

class AppointmentController extends Controller
{
    public function __construct(){

	}
	
	
	/**
     * display appointment start page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		return view('Appointment.appointment-index')/*->with(compact('allDBProducts',))*/;  
	}
	
	
	
	

}