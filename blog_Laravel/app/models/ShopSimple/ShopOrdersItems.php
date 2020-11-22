<?php
//Model for {shop_order_item} DB to store a one user's order split by items, ie if Order contains 2 items (dvdx2, iphonex3). 
//While Db table {shop_orders_main} is used  stores general info about the order (general amount, price, email, etc )

namespace App\models\ShopSimple;

use Illuminate\Database\Eloquent\Model;

class ShopOrdersItems extends Model
{

  /**
   * Connected DB table name.
   *
   * @var string
   */
  protected $table = 'shop_order_item';
  
  
}
