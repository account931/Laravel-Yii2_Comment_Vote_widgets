<?php
//uses $_SESSION['cart_dimmm931_1604938863'] to store and retrieve user's cart. Format is { [8]=> int(3) [1]=> int(2) [4]=> int(1) }
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\ShopSimple\ShopSimple;     //model for DB table 
use App\models\ShopSimple\ShopCategories; //model for DB table 
use Illuminate\Support\Facades\Validator;
use App\models\ShopSimple\ShopOrdersMain; //model for DB table {shop_orders_main} that stores general info about the order (general amount, price, email, etc )
use App\models\ShopSimple\ShopOrdersItems; //model for DB table {shop_order_item} to store a one user's order split by items, ie if Order contains 2 items (dvdx2, iphonex3). 
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ShopShippingRequest; //my custom Form validation via Request
use App\ThirdParty_SDK\LiqPaySDK\LiqPay; //LiqPay SDK

class ShopPayPalSimpleController extends Controller
{
    public function __construct(){
		//session_start();
	}
	
	
	/**
     * display shop start page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		session_start(); //dd($_SESSION['cart_dimmm931_1604938863']);
		//$sess = $_SESSION['cart_dimmm931_1604938863'];
		
		$model = new ShopSimple(); //to call model method, e.g truncateTextProcessor($text, $maxLength)
		$allCategories = ShopCategories::all();  //for <select> dropdown
		$allProductsSearchBar = ShopSimple::all();  // for Search Bar
		
		//detect if url contains $_GET['order'] for sorting by lowest price, highest price, newst date
		/*if(isset($_GET['order'])){
		    $order = $_GET['order'];
			if($_GET['order'] == 'lowest'){
				$s = "orderBy('shop_price', 'desc')";
			}
			if($_GET['order'] == 'highest'){
			}
			if($_GET['order'] == 'newest'){
			}
		} */
		
		//---------------------------------------------------
		//if no $_GET['shop-category'] - find all products with pagination. OR if $_GET but == empty
	    if ( !isset($_GET['shop-category']) /*|| (isset($_GET['shop-category']) && $_GET['shop-category']==null  ) */){ 
		    
			//found all products with pagination
			//$allDBProducts = ShopSimple::paginate(6); //Working!!! Was the First variant
			//$allDBProducts = ShopSimple::orderBy('shop_price', 'desc')->paginate(6); //with pagination. Working!!!!
		
		    //Eloqent query with diffrent orderBy clauses based on $_GET['order']
			$allDBProducts = ShopSimple::when(isset($_GET['order']) && $_GET['order'] == 'lowest', function ($q) /* use($s) */  {
               return $q->orderBy('shop_price', 'asc');
            })
			//case to order by highest price
			->when(isset($_GET['order']) && $_GET['order'] == 'highest', function ($q) /* use($s) */  {
               return $q->orderBy('shop_price', 'desc');
            })
			//case to order by newest inserted product
			->when(isset($_GET['order']) && $_GET['order'] == 'newest', function ($q) /* use($s) */  {
               return $q->orderBy('shop_created_at', 'desc');
            })
			
			//condition to use anyway
			->paginate(6); //with pagination
			
			

			
		    //count found products
			$countProducts = ShopSimple::all();       //for counting all products 
		}
		
		
		
		
		//---------------------------------------------------
		//if isset GET['shop-category'], find products by category with pagination
		if(isset($_GET['shop-category'])){
			//found products by category with pagination
			//$allDBProducts = ShopSimple::where('shop_categ', $_GET['shop-category'])->paginate(4); //with pagination Working!!! Was the First variant
		    
			
			//Eloqent query with diffrent orderBy clauses based on $_GET['order']
			$allDBProducts = ShopSimple::when(isset($_GET['order']) && $_GET['order'] == 'lowest', function ($q) /* use($s) */  {
               return $q->orderBy('shop_price', 'asc');
            })
			//case to order by highest price
			->when(isset($_GET['order']) && $_GET['order'] == 'highest', function ($q) /* use($s) */  {
               return $q->orderBy('shop_price', 'desc');
            })
			//case to order by newest inserted product
			->when(isset($_GET['order']) && $_GET['order'] == 'newest', function ($q) /* use($s) */  {
               return $q->orderBy('shop_created_at', 'desc');
            })
			//condition to use anyway
			->where('shop_categ', $_GET['shop-category'])->paginate(4); //with pagination
			
			
			//count found articles
			$countProducts = ShopSimple::where('shop_categ', $_GET['shop-category'])->get();

		}
		
		
		
		
		
		
		
		
		//$_SESSION['productCatalogue'] = $allProductsSearchBar; //all products to session
		
		//adds this to SQL Result Object in order Laravel Pagination links would including other GET parameters when u naviagate to page=2, etc; i.e the URL would contain previous $_GET[] params, like it was "shopSimple?order=lowest", when goes to page=2 it will be "shopSimple?order=lowest&page=2". Without this fix URL will be just "shopSimple?page=2"
		$allDBProducts = $allDBProducts->appends(\Illuminate\Support\Facades\Input::except('page'));
	    
		return view('ShopPaypalSimple.shopIndex')->with(compact(
		                                          'allDBProducts', //with pagination
												  'countProducts',
			                                      'model',
			                                      'allCategories',
                                                  'allProductsSearchBar'
                                                  												  
		));  
	}
	
	
	/**
     * display Cart page
     *
     * @return \Illuminate\Http\Response
     */
    public function cart()
    {
		session_start(); 
		
		//if session with Cart set previously (user ha salready selected some products to cart)
		if(isset($_SESSION['cart_dimmm931_1604938863'])){
			
		   $arrayWithIDsInCart = array(); //array to store products IDs that are currentlyin cart, i.e [5,7,9]
		   
		   foreach($_SESSION['cart_dimmm931_1604938863'] as $key => $value){
			  array_push($arrayWithIDsInCart, $key);
		   }
		   //find DB products, but only those ids are present in the cart, i.e $_SESSION['cart_dimmm931_1604938863']
		   $allProductsAll = ShopSimple::whereIn('shop_id', $arrayWithIDsInCart)->get();
           $inCartItems = $allProductsAll->toArray(); //object to array to perform search_array in view
	       //$_SESSION['productCatalogue'] = $allProductsAll->toArray(); //all products to session //DEPRECATED!!!!
		   
		   return view('ShopPaypalSimple.cart')->with(compact('inCartItems')); 
		
        //if session with Cart WAS NOT set previously, returns view only	
		} else {
			return view('ShopPaypalSimple.cart'); 
		}
		
		
	}
	
	
	
	
	/**
     * display One Product as a result from search bar
     *
     * @return \Illuminate\Http\Response
     */
    public function showOneProductt($id)
    {
		session_start();
		
		//find the product by id
		$productOne = ShopSimple::where('shop_id', $id)->get();
		
		$model = new ShopSimple(); //to call model method, e.g truncateTextProcessor($text, $maxLength)
	    
		
		return view('ShopPaypalSimple.showOneProduct')->with(compact('productOne', 'model')); 
	}
	
	
	
	
	
    /**
     * method to add to cart. Request comes from form in ShopPaypalSimple.shopIndex
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	 
    public function storeToCart(Request $request)
    {
		//if $_POST['productID'] is not passed. In case the user navigates to this page by enetering URL directly, without submitting from with $_POST
		if(!$request->input('productID')){
			throw new \App\Exceptions\myException('Bad request, You are not expected to enter this page.');
		}
		
		
		$rules = [
			'yourInputValue' => ['required', 'integer',  ] , 
			'productID'      => [ 'required', 'integer' ] , 
			
		];
		
	    //creating custom error messages. Should pass it as 3rd param in Validator::make()
	    $mess = [ 'yourInputValue.required' => 'We need this field',];
		
	    $validator = Validator::make($request->all(),$rules, $mess);
	    if ($validator->fails()) {
			return redirect('/shopSimple')->withInput()->with('flashMessageFailX', 'Validation Failed' )->withErrors($validator);
	    }
		
		
		
		session_start();
		
		//if session with all products from DB was not set previously
		/*
		if(!isset($_SESSION['productCatalogue'])){
		  $allProductsAll = ShopSimple::all();  // 
	      $_SESSION['productCatalogue'] = $allProductsAll->toArray(); //all products to session
		}
		*/
		
		$itemsQuantity = $request->input('yourInputValue'); //gets quantity from form $_POST[]
		$productID = (int)$request->input('productID'); //gets productID (hidden field) from form $_POST[]
		
		$productOne = ShopSimple::where('shop_id', $request->input('productID'))->get(); //get one selected product from SQL DB by id

		//find in $_SESSION['productCatalogue'] index the product by id, used in Flash
		 //$keyN = array_search($productID , array_keys($_SESSION['productCatalogue'])); //find in $_SESSION['productCatalogue'] index the product by id
		 //dd($keyN .  " == " . $productID );
		
		//echo "Product: " . $productID . " quantity: " . $itemsQuantity;
		
		 if((int)$itemsQuantity == 0){
			if (isset($_SESSION['cart_dimmm931_1604938863']) && isset($_SESSION['cart_dimmm931_1604938863'][$productID]) ){//if Session is set and that productID is in it
				$temp = $_SESSION['cart_dimmm931_1604938863'];//save Session to temp var
				unset($temp[$productID]);
				$_SESSION['cart_dimmm931_1604938863'] = $temp;//write temp var to Cart
				return redirect('/shopSimple')->with('flashMessageFailX', 'Product <b> ' . $productOne[0]->shop_title . ' </b> was deleted from cart' );

				//Yii::$app->session->setFlash('successX', 'Product <b> ' . $_SESSION['productCatalogue'][$keyN]['name'] . ' </b> was deleted from cart');
			} else {}
		} else {
		
            
            if (!isset($_SESSION['cart_dimmm931_1604938863'])) {//if Session['cart_dimmm931_1604938863'] does not exist yet
			    $temp = array();
                $temp[$productID] = (int)$itemsQuantity;//в масив заносим количество of products 
            } else {//if if Session['cart_dimmm931_1604938863'] already contains some products, ie. was prev added to cart
                $temp = $_SESSION['cart_dimmm931_1604938863'];//save Session to temp var
                if (!array_key_exists($productID, $temp)) {//проверяем есть ли в корзине уже такой товар
                    $temp[$productID] = (int)$itemsQuantity; //в масив заносим количество тавара 1
                } else { //if product was not prev selected (added to cart)
				    $temp[$productID] = (int)$itemsQuantity;
			    }				
            }
			//Yii::$app->session->setFlash('successX', 'Product<b> ' . $_SESSION['productCatalogue'][$keyN]['name'] . ' </b>was added to cart');
		}
		
        //$count = count($temp);//count products in cart
        $_SESSION['cart_dimmm931_1604938863'] = $temp;//write temp var to Cart
       
	   
        //return Yii::$app->getResponse()->redirect(['shop-liqpay-simple/index']);
	   
	   
		
		
		
		return redirect('/shopSimple')->with('flashMessageX', "Item was successfully added to cart. Product: " . $productOne[0]->shop_title  . ". Quantity : " . $request->input('yourInputValue') . " items" );
	}
	
	
	
	
	
	
	//simple rule to make your life easier... NEVER return a view in response to a POST request. Always redirect somewhere else which shows the result of the post or displays the next form.

	/**
     * method to go to check-out page. Gets form data with Final Cart send via POST form and redirects to GET /checkOut2. Request comes from form in ShopPaypalSimple.cart
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	 
    public function checkOut(Request $request)
    {
		//Doesnot work as router would not come here a GET request
		$method = $request->method();
        if (!$request->isMethod('post')) {
            throw new \App\Exceptions\myException('Bad request!!!.Not POST, You are not expected to enter this page.');
        }
		//Doesnot work

		//if $_POST['productID'] is not passed. In case the user navigates to this page by enetering URL directly, without submitting from with $_POST
		if(!$request->input('productID')){
			throw new \App\Exceptions\myException('Bad request, You are not expected to enter this page.');
		}
		
		session_start();
		$productIDs = $request->input('productID'); //comes as array [6,9,9]
		$productQuant = $request->input('yourInputValueX'); //comes as array [6,9,9]
		
		//check if inputs are not even
		if(count($productIDs) != count($productQuant)){
			throw new \App\Exceptions\myException('Cart inputs arrays ids and quant are not even.');
		}
		
		//update the $_SESSION['cart_dimmm931_1604938863'] in case at cart the user --minus product till zero
		$temp = array();
		for ($i = 0; $i < count($productIDs); $i++){
		  if((int)$productQuant[$i] != 0){
			$temp[$productIDs[$i]] = (int)$productQuant[$i];//в масив заносим количество of products 
		  }
		}
		$_SESSION['cart_dimmm931_1604938863'] = $temp;//write temp var to Cart
		//end update
		
	    return redirect('/checkOut2');

	}
	
	
	
	
	
	
	/**
     * $_GET Method is accessed via redirect from this controller function checkOut(Request $request)
	 * Displays page with Shipping details form
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	 
	//CheckOut == Order 
    public function checkOut2()
    {
		session_start();
		
		//Generate UUID (unique ID for order)
		$model = new ShopSimple();
		$uuid = $model->generateUUID(6);
		//dd($uuid);
		
		//Gets Products that are already in cart to display them in view
		//if session with Cart set previously (user has already selected some products to cart)
		if(isset($_SESSION['cart_dimmm931_1604938863'])){
			
		   $arrayWithIDsInCart = array(); //array to store products IDs that are currentlyin cart, i.e [5,7,9]
		   
		   foreach($_SESSION['cart_dimmm931_1604938863'] as $key => $value){
			  array_push($arrayWithIDsInCart, $key);
		   }
		   //find DB products, but only those ids are present in the cart, i.e $_SESSION['cart_dimmm931_1604938863']
		   $allProductsAll = ShopSimple::whereIn('shop_id', $arrayWithIDsInCart)->get();
           $inCartItems = $allProductsAll->toArray(); //object to array to perform search_array in view
		} 
		//End Gets Products that are already in cart to display them in view  
		  
		
		
		


		//dd($request->input('productID'), $request->input('yourInputValueX'));
	    //return redirect('/shopSimple')->with('flashMessageX', "Was successfully added to cart. Product: " . $productOne[0]->shop_title  . ". Quantity : " . $request->input('yourInputValue') . " items" );
        return view('ShopPaypalSimple.checkOut')->with(compact('inCartItems', 'uuid')); 

	}
	
	
	
	
	
	//simple rule to make your life easier... NEVER return a view in response to a POST request. Always redirect somewhere else which shows the result of the post or displays the next form.

	/**
     * $_POST Method gets <form> data via $_POST from Checkout/Order page {i.e this controller function checkOut2()}(Shipping details (address, phone. etc)) and redirects to $_GET page route {payPage2}. 
	 * Form Request comes from form in ShopPaypalSimple.check-out
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	 
    public function pay1(ShopShippingRequest $request)  //Request $request //REASSIGNED to \Http\FormRequest\hopShippingRequest
    {
		//if $_POST['u_name'] is not passed. In case the user navigates to this page by enetering URL directly, without submitting from with $_POST
		if(!$request->input('u_name')){
			throw new \App\Exceptions\myException('Bad request, You are not expected to enter this page. <p>Param is missing.</p>');
		}
		
		session_start();
		
		//This validation is reassigned for \App\Http\Requests\ShopShippingRequest;
		/*
		$RegExp_Phone = '/^[+]380[\d]{1,4}[0-9]+$/';
		
		$rules = [
			'u_name' => ['required', 'string', 'min:3'], 
			'u_address'  => [ 'required',  'string', 'min:8'],
            'u_email'  => [ 'required', 'email' ] ,
            'u_phone'  => [ 'required', "regex: $RegExp_Phone" ] ,			
			
		];
		
	    //creating custom error messages. Should pass it as 3rd param in Validator::make()
	    $mess = [ 
		    'u_name.required' => 'We need u to specify your name',
			'u_email.email' => 'Give us real email',
			'u_phone.regex' => 'Phone must be in format +380....',
		];
		
	    $validator = Validator::make($request->all(),$rules, $mess);
	    if ($validator->fails()) {
			return redirect('/checkOut2')->withInput()->with('flashMessageFailX', 'Validation Failed' )->withErrors($validator);
	    }
		*/
		
		//gets all inputs
		$input = $request->all();
		
		
		//Gets Products that are already in cart to display them in view
		//if session with Cart set previously (user has already selected some products to cart)
		if(isset($_SESSION['cart_dimmm931_1604938863'])){
			
		   $arrayWithIDsInCart = array(); //array to store products IDs that are currentlyin cart, i.e [5,7,9]
		   
		   foreach($_SESSION['cart_dimmm931_1604938863'] as $key => $value){
			  array_push($arrayWithIDsInCart, $key);
		   }
		   //find DB products, but only those ids are present in the cart, i.e $_SESSION['cart_dimmm931_1604938863']
		   $allProductsAll = ShopSimple::whereIn('shop_id', $arrayWithIDsInCart)->get();
           $inCartItems = $allProductsAll->toArray(); //object to array to perform search_array in view
		} 
		//End Gets Products that are already in cart to display them in view  
		
		
		
		
		//save an Order to DB tables {shop_orders_main} and {shop_order_item}
		$shopOrdersMain = new ShopOrdersMain();
		$ShopOrdersItems = new ShopOrdersItems();
		
		//additionally check if SESSION still exists
		if (!isset($_SESSION['cart_dimmm931_1604938863'])) {
		    return redirect('/checkOut2')->with('flashMessageFailX', "Error, SESSION is coruupted " );
		}
			
	
		
		if($savedID = $shopOrdersMain->saveFields_to_shopOrdersMain($request->all())){  //saving to table {shop_orders_main} DB that stores general info about the order (general amount, price, email, etc ) //$savedID is an id of saved/Inserted row
		    //an attempt to delete $savedID
			try { 
			    $ShopOrdersItems->saveFields_to_shop_order_item( $savedID, $_SESSION['cart_dimmm931_1604938863'], $inCartItems );  // saving to table {shop_order_item} to store a one user's order split by items, ie if Order contains 2 items (dvdx2, iphonex3). 
				
			    return redirect('payPage2')->with(compact('input', 'savedID'))->with('flashMessageX', "Your Order data is saved to DB with id " . $savedID . ". Now you have 24 hours to proceed with payment or the Order will be discarted (i.e DELETE where not-paid && now() - order time =< 24 hours)." ); //$input in longer neccessary, reassigned to  $savedID , i.e ID of saved order (and use it to get values from DB)
		    
			} catch( Throwable $e ) {
				$delete = ShopOrdersMain::where('order_id', $savedID)->delete(); //If error Delete by ID from table {shop_orders_main} as well
				return redirect('/checkOut2')->with('flashMessageFailX', "Error saving to DB {shop_order_item}. Try Later" );
			}
			
		} else {
		    return redirect('/checkOut2')->with('flashMessageFailX', "Error saving to DB {shop_orders_main}. Try Later" );

		}
		//save Order to DB tables {shop_orders_main} and {shop_order_item}
		
		
		 

	}
	
	
	
	
	/**
     * $_GET Method is accessed via redirect from function pay1(Request $request) with data $input
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	 
    public function pay2()
    {
		if(!session()->get('input')){ //$input in longer neccessary, as it'll be reassigned to  $savedID , i.e ID of saved order (and use it to get values from DB)
			return redirect('/shopSimple')->with('flashMessageFailX', ' <i class="fa fa-angle-double-left" style="font-size:3em;color:red"></i> &nbsp; You are returned here, as were not supposed to visit that previous page {payPage2} directly (without the input and OrderID) ' );
		}
		session_start();
		
		//gets all inputs. Get it from redirect in function pay1(Request $request)
		$input = session()->get('input');
		
		
		
		//Gets Products that are already in cart to display them in view
		//if session with Cart set previously (user has already selected some products to cart)
		if(isset($_SESSION['cart_dimmm931_1604938863'])){
			
		   $arrayWithIDsInCart = array(); //array to store products IDs that are currentlyin cart, i.e [5,7,9]
		   
		   foreach($_SESSION['cart_dimmm931_1604938863'] as $key => $value){
			  array_push($arrayWithIDsInCart, $key);
		   }
		   //find DB products, but only those ids are present in the cart, i.e $_SESSION['cart_dimmm931_1604938863']
		   $allProductsAll = ShopSimple::whereIn('shop_id', $arrayWithIDsInCart)->get();
           $inCartItems = $allProductsAll->toArray(); //object to array to perform search_array in view
		} 
		//End Gets Products that are already in cart to display them in view
		
		$thisOrderID = session()->get('savedID');
		
		//finding this One order in DB by ID {$savedID} passed from {function pay1}
		$thisOrder = ShopOrdersMain::where('order_id', session()->get('savedID') )->get();
		
		
		
		
		//LiqPay SDK Button (to pass to view). LiqPay Object is created here with credentials. method is called in view.    
		//$liqpay = new LiqPay(env('LIQPAY_PUBLIC_KEY'), env('LIQPAY_PRIVATE_KEY'));
		$liqpay = new LiqPay(env('LIQPAY_PUBLIC_KEY', 'screw'), env('LIQPAY_PRIVATE_KEY', 'screw')); //using env Constants
        

		
		return view('ShopPaypalSimple.pay-page')->with(compact('input', 'inCartItems', 'thisOrder', 'thisOrderID', 'liqpay'));  

	}
	
	
	
	
	/**
     * final payment page, returned by PayPal INP Listener, displays if payment was successfull or not
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	 
    public function payOrFail()
    {
		$postData = file_get_contents('php://input');
		
		$input_data = $_POST;
		
		return view('ShopPaypalSimple.payOrFail_final')->with(compact('postData', 'input_data'));  
	}
	
}