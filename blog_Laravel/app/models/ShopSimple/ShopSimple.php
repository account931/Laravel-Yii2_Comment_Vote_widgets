<?php
//Model for ShopSimple
namespace App\models\ShopSimple;

use Illuminate\Database\Eloquent\Model;

class ShopSimple extends Model
{


  /**
   * Connected DB table name.
   *
   * @var string
   */
  protected $table = 'shopsimple';
  
  
  //protected $fillable = ['wpBlog_author', 'title', 'description', 'category_sel'];  //????? protected $fillable = ['wpBlog_author', 'wpBlog_text', 'wpBlog_author', 'wpBlog_category'];
  //public $timestamps = false; //to override Error "Unknown Column 'updated_at'" that fires when saving new entry
  
  
  
}
