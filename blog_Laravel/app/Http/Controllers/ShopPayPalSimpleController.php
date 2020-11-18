<?php
//uses $_SESSION['cart_dimmm931_1604938863'] to store and retrieve user's cart. Format is { [8]=> int(3) [1]=> int(2) [4]=> int(1) }
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\ShopSimple\ShopSimple;     //model for DB table 
use App\models\ShopSimple\ShopCategories; //model for DB table 
use Illuminate\Support\Facades\Validator;

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
		
		//if no GET - find all products with pagination
	    if (!isset($_GET['shop-category'])){ 
		    //found all products with pagination
			$allDBProducts = ShopSimple::paginate(6); //with pagination
		    //count found products
			$countProducts = ShopSimple::all();       //for counting all products 
		}
		
		//if isset GET, find products by category with pagination
		if(isset($_GET['shop-category'])){
			//found products by category with pagination
			$allDBProducts = ShopSimple::where('shop_categ', $_GET['shop-category'])->paginate(4); //with pagination
		    //count found articles
			$countProducts = ShopSimple::where('shop_categ', $_GET['shop-category'])->get();

		}
		
		
		//$_SESSION['productCatalogue'] = $allProductsSearchBar; //all products to session
		
		
	    
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
		   
		  
		
		//dd($request->input('productID'), $request->input('yourInputValueX'));
	    //return redirect('/shopSimple')->with('flashMessageX', "Was successfully added to cart. Product: " . $productOne[0]->shop_title  . ". Quantity : " . $request->input('yourInputValue') . " items" );
        return view('ShopPaypalSimple.checkOut')->with(compact('inCartItems')); 

	}
	
	
	
	
	
	//simple rule to make your life easier... NEVER return a view in response to a POST request. Always redirect somewhere else which shows the result of the post or displays the next form.

	/**
     * $_POST Method gets <form> data via $_POST from Checkout/Order page {i.e this controller function checkOut2()}(Shipping details (address, phone. etc)) and redirects to $_GET page route {payPage2}. 
	 * Form Request comes from form in ShopPaypalSimple.check-out
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	 
    public function pay1(Request $request)
    {
		//if $_POST['u_name'] is not passed. In case the user navigates to this page by enetering URL directly, without submitting from with $_POST
		if(!$request->input('u_name')){
			throw new \App\Exceptions\myException('Bad request, You are not expected to enter this page. <p>Param is missing.</p>');
		}
		
		session_start();
		
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
		
		//gets all inputs
		$input = $request->all();
		
		
		return redirect('payPage2')->with(compact('input'));
		 

	}
	
	
	
	
	/**
     * $_GET Method is accessed via redirect from function pay1(Request $request) with data $input
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	 
    public function pay2()
    {
		if(!session()->get('input')){
			return redirect('/shopSimple')->with('flashMessageX', "You are returned here, as were not supposed to visit that prev page" );
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
		
		
		
		return view('ShopPaypalSimple.pay-page')->with(compact('input', 'inCartItems'));  

	}
}