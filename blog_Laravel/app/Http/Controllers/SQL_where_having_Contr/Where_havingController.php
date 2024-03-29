<?php

namespace App\Http\Controllers\SQL_where_having_Contr;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator; //from ABZ + Controllers/WpBlog_Admin_Part/WpBlog_Admin_Rest_API_Contoller.php

use Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Http\Requests\Polymorphic\PostPolymUpdateRequest; //Validation via Request Class (both for create and update)

use App\Http\Controllers\Controller; //to place controller in subfolder
//use App\models\Polymorphic\Polymorphic_Posts;    //model for DB table {polymorphic_posts}
//use App\models\Polymorphic\Polymorphic_Images;   //model for DB table {polymorphic_images}
//use App\models\Polymorphic\Polymorphic_Users;   //model for DB table {polymorphic_images}
use App\models\ShopSimple\ShopSimple;             //model for DB table {}



class Where_havingController extends Controller
{
    public function __construct(){
	    //$this->middleware('auth');	   
	}
	
	
	
	/**
     * Page with HAVING/groupBy SQL examples (queries are done to table {shop_simple})  
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
	    //simple Eloquent
		$findModel = ShopSimple::where('shop_categ', '1')->where('shop_currency', "$")->get(); //multiple where

        //HAVING Clause examples
        \DB::statement("SET SQL_MODE=''");//this is the trick use it just before your query to ovveride Syntax error or access violation: 1055 Error
		
        //$findModel2 = DB::table('shop_simple')->having('shop_price', '<', 10)->get();                                //Works, find with price less than 10
		$findModel2 = DB::table('shop_simple')->groupBy('shop_id', 'shop_title')->having('shop_id', '>=', 9)->get(); //Works, gets records with id bigger/equal than 9
        //$findModel2 = ShopSimple::where('shop_categ', '1')->groupBy('shop_price')->get();                            //Works, gets soted by 'shop_price' but NOT HAVING     
		
		
		//Works OK, returns data containing list of all table categories with overall summed products price for each category, BUT HAS NO hasOne relation!!! //e.g returns => Category 1 => all Category 1's products price summed (category 1's prouduct1 ptice + category 1's prouduct1 ptice, etc)
		$findModel3 = ShopSimple::selectRaw("SUM(shop_price) as total_category_price") //return SUM as property $findModel3->total_category_price
		                        ->selectRaw("shop_categ as productCategoryX") //also selects shop_categ column, not necessary if use {::select('*')} as in example below
		                        //->selectRaw("SUM(credit) as total_credit") //another condition to sum other column, not used here
		                        ->groupBy('shop_categ')->get(); 
		
        
		
        //Same as prev but with hasOne relation
		//Finds all products, than calc overall summed products price, group them up by 'shop_categ' and selectes only categories where 'total_category_price', '>=', 1000
        $findModel4 = ShopSimple::select('*')
		                        ->with('categoryName') //hasOne relation
		                        ->selectRaw("SUM(shop_price) as total_category_price")
		                        ->selectRaw("shop_categ as productCategoryX") //not mandatory here as here we use {::select('*')}
 								->groupBy('shop_categ')
								->having('total_category_price', '>=', 800)//where 'total_category_price' bigger than 2000
								->get();
		
		//dd($findModel3);
		
		return view('sql_where_having.index',  compact('findModel', 'findModel2', 'findModel3', 'findModel4'));
    }
	
	
	
	
	
}
