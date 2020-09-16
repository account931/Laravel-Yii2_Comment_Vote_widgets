<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class wpress_blog_post extends Model
{
  /**
   * Связанная с моделью таблица.
   *
   * @var string
   */
  protected $table = 'wpress_blog_post';
  
  
  /**
   * hasOne => get user name from table {users} based on column {wpBlog_author} in table {wpress_blog_post} .
   * hasOne
   */
  public function authorName()
  {
    //return $this->belongsTo('App\users', 'id', 'wpBlog_author'); //return $this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');
	return $this->hasOne('App\users', 'id', 'wpBlog_author');      //$this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');
  }
  
  
  /**
   * hasMany => get category name from table {wpress_category} based on column {wpBlog_category} in table {wpress_blog_post} .
   * hasMany
   */
  public function categoryNames()
  {
    return $this->belongsTo('App\models\wpress_category', 'wpBlog_category','wpCategory_id');  //return $this->belongsTo('App\modelName', 'parent_id_this_table', 'foreign_key_that_table');
  }
  
  
  
  /**
    * Laravel getter NOT WORKING
    *
    * @param  string  $value
    * @return string
    */
  public function getWpBlog_StatusAttribute($value) 
  {
    //return ucfirst($value);
	if($value == '1'){
		return 'Published';
	} else {
		return 'NOT Published';
	}
  }
  
   /**
    * Manula emulation of Laravel getter
    *
    * @param  string  $value
    * @return string
    */
   public function test($value){
       if($value == '1'){
		return 'Published';
	} else {
		return 'Not Published';
	}
   }
  
}
