<?php
//uses $_SESSION['cart_dimmm931_1604938863'] to store and retrieve user's cart;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\ShopSimple\ShopSimple;     //model for DB table 
use App\models\ShopSimple\ShopCategories; //model for DB table 

class ShopPayPalSimpleController extends Controller
{
    
	
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
		
		//if session with all products from DB was not set previously
		if(!isset($_SESSION['productCatalogue'])){
		   $allProductsAll = ShopSimple::all();  //all DB products
	       $_SESSION['productCatalogue'] = $allProductsAll->toArray(); //all products to session
		}
		
		return view('ShopPaypalSimple.cart')->with(compact('allProductsAll')); 
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
		if(!$request->input('productID')){
			throw new \App\Exceptions\myException('Bad request, You are not expected to enter this page.');
		}
		
		
		session_start();
		
		//if session with all products from DB was not set previously
		if(!isset($_SESSION['productCatalogue'])){
		  $allProductsAll = ShopSimple::all();  // 
	      $_SESSION['productCatalogue'] = $allProductsAll->toArray(); //all products to session
		}
		
		$itemsQuantity = $request->input('yourInputValue'); //gets quantity from form $_POST[]
		$productID = (int)$request->input('productID'); //gets productID (hidden field) from form $_POST[]
		
		
		//find in $_SESSION['productCatalogue'] index the product by id, used in Flash
		 $keyN = array_search($productID , array_keys($_SESSION['productCatalogue'])); //find in $_SESSION['productCatalogue'] index the product by id
		 //dd($keyN .  " == " . $productID );
		
		//echo "Product: " . $productID . " quantity: " . $itemsQuantity;
		
		 if((int)$itemsQuantity == 0){
			if (isset($_SESSION['cart_dimmm931_1604938863']) && isset($_SESSION['cart_dimmm931_1604938863'][$productID]) ){//if Session is set and that productID is in it
				$temp = $_SESSION['cart_dimmm931_1604938863'];//save Session to temp var
				unset($temp[$productID]);
				$_SESSION['cart_dimmm931_1604938863'] = $temp;//write temp var to Cart
				return redirect('/shopSimple')->with('flashMessageFailX', 'Product <b> ' . $_SESSION['productCatalogue'][$keyN-1]['shop_title'] . ' </b> was deleted from cart' );

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
	   
	   
		
		
		
		$productOne = ShopSimple::where('shop_id', $request->input('productID'))->get();
		return redirect('/shopSimple')->with('flashMessageFailX', "Added to cart. Product: " . $productOne[0]->shop_title  . " Quantity:" . $request->input('yourInputValue') );
	}
	
	
}