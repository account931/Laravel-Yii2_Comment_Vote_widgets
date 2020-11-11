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
	
}