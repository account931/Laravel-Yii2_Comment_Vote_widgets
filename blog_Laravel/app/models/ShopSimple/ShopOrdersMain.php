<?php
//Model for {shop_orders_main} DB that stores general info about the order (general amount, price, email, etc )
//While Db table {shop_order_item} is used to store a one user's order split by items, ie if Order contains 2 items (dvdx2, iphonex3). 
namespace App\models\ShopSimple;

use Illuminate\Database\Eloquent\Model;

class ShopOrdersMain extends Model
{

  /**
   * Connected DB table name.
   *
   * @var string
   */
  protected $table = 'shop_orders_main';
  
  public $timestamps = false; //put in model to override Error "Unknown Column 'updated_at'" that fires when saving new entry
  
  
  
   
    /**
    * saves form inputs to DB (FINAL)
    *
    * @param  
    * @return 
    */
	public function saveFields($data){
		$this->ord_uuid =        $data['u_uuid']; //auth()->user()->id;
		$this->ord_sum =         $data['u_sum'];
		$this->items_in_order =  $data['u_items_in_order'];
		$this->ord_name =        $data['u_name'];
		$this->ord_address =     $data['u_address'];
		$this->ord_email =       $data['u_email'];
		$this->ord_phone =       $data['u_phone'];
		//$this->ord_placed =      date('Y-m-d H:i:s');
		
		$this->save();
		return true;
	}
}
