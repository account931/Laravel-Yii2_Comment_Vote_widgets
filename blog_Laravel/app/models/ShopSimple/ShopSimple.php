<?php
//Model for ShopSimple DB that contains all products
namespace App\models\ShopSimple;

use Illuminate\Database\Eloquent\Model;

class ShopSimple extends Model
{
  
  private $UUID;

  /**
   * Connected DB table name.
   *
   * @var string
   */
  protected $table = 'shop_simple';
  
  
  
  //protected $fillable = ['wpBlog_author', 'title', 'description', 'category_sel'];  //????? protected $fillable = ['wpBlog_author', 'wpBlog_text', 'wpBlog_author', 'wpBlog_category'];
  public $timestamps = false; //to override Error "Unknown Column 'updated_at'" that fires when saving new entry
  protected $primaryKey = 'shop_id'; // override
  
  
  //hasOne relation (for Category table)
  public function categoryName(){
	  return $this->hasOne('App\models\ShopSimple\ShopCategories', 'categ_id', 'shop_categ')->withDefault(['name' => 'Unknown categoty']);      //$this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');}
      //->withDefault(['name' => 'Unknown']) this prevents the crash if this author id does not exist in table User (for example after fresh install and u forget to add users to user table)
  }


  //hasOne relation (For Quantity table)
  public function quantityGet(){
	  return $this->hasOne('App\models\ShopSimple\ShopQuantity', 'product_id', 'shop_id')->withDefault(['name' => 'Unknown quantity']);      //$this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');}
      //->withDefault(['name' => 'Unknown']) this prevents the crash if this author id does not exist in table User (for example after fresh install and u forget to add users to user table)
  }

  
  
  //truncate/crop the text
	public function truncateTextProcessor($text, $maxLength)
	{
        $length = $maxLength; 
		if(strlen($text) > $length){
		    $text = substr($text, 0, $length) . "...";
		} 
	return $text;		
	}
	
	

  /**
   * function to generate unique order number.
   *
   * @var string
   */
	function generateUUID($length=10) 
	{
       $this->UUID = "sh-" . time() ."-". substr( md5(uniqid()), 0, $length);  //md5 the unique number
	   return $this->UUID;
    }
  
}
