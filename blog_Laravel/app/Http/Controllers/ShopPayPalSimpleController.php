<?php

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
		$model = new ShopSimple(); //to call model method, e.g truncateTextProcessor($text, $maxLength)
		$allCategories = ShopCategories::all();  //for <select> dropdown
		$allProductsSearchBar = ShopSimple::all();  // for Serach Bar
		
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
		$item = "Good";
	    
		return view('ShopPaypalSimple.cart')->with(compact('item')); 
	}
	
	
	
	
	/**
     * display One Product as a result from search bar
     *
     * @return \Illuminate\Http\Response
     */
    public function showOneProductt($id)
    {
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
		
		
		
		
		/*
		$itemsQuantity = $request['yourInputValue']; //gets quantity from form $_POST[]
		$productID = $request['productID']; //gets productID (hidden field) from form $_POST[]
		
		
		//find in $_SESSION['productCatalogue'] index the product by id, used in Flash
		 $keyN = array_search($productID , array_keys($_SESSION['productCatalogue'])); //find in $_SESSION['productCatalogue'] index the product by id
		
		
		//echo "Product: " . $productID . " quantity: " . $itemsQuantity;
		
		 if((int)$itemsQuantity == 0){
			if (isset($_SESSION['cart-simple-931t']) && isset($_SESSION['cart-simple-931t'][$productID]) ){//if Session is set and that productID is in it
				$temp = $_SESSION['cart-simple-931t'];//save Session to temp var
				unset($temp[$productID]);
				Yii::$app->session->setFlash('successX', 'Product <b> ' . $_SESSION['productCatalogue'][$keyN]['name'] . ' </b> was deleted from cart');
			} else {}
		} else {
            //session_start();
            if (!isset($_SESSION['cart-simple-931t'])) {//if Session['cart-simple-931t'] does not exist yet
			    $temp = array();
                $temp[$productID] = (int)$itemsQuantity;//в масив заносим количество of products 
            } else {//if if Session['cart-simple-931t'] already contains some products, ie. was prev added to cart
                $temp = $_SESSION['cart-simple-931t'];//save Session to temp var
                if (!array_key_exists($productID, $temp)) {//проверяем есть ли в корзине уже такой товар
                    $temp[$productID] = (int)$itemsQuantity; //в масив заносим количество тавара 1
                } else { //if product was not prev selected (added to cart)
				    $temp[$productID] = (int)$itemsQuantity;
			    }				
            }
			Yii::$app->session->setFlash('successX', 'Product<b> ' . $_SESSION['productCatalogue'][$keyN]['name'] . ' </b>was added to cart');
		}
		
        //$count = count($temp);//count products in cart
        $_SESSION['cart-simple-931t'] = $temp;//write temp var to Cart
       
	   
       return Yii::$app->getResponse()->redirect(['shop-liqpay-simple/index']);
	   
	   */
		
		
		
		$productOne = ShopSimple::where('shop_id', $request->input('productID'))->get();
		return redirect('/shopSimple')->with('flashMessageFailX', "Added to cart. Product: " . $productOne[0]->shop_title  . " Quantity:" . $request->input('yourInputValue') );
	}
	
	
}