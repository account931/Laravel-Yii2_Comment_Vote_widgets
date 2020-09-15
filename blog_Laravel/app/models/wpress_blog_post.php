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
   * hasOne => get category name from table {wpress_category} based on column {wpBlog_category} in table {wpress_blog_post} .
   * hasOne
   */
  public function categoryName()
  {
    //return $this->belongsTo('App\users', 'id', 'wpBlog_author'); //return $this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');
	return $this->hasOne('App\models\wpress_category', 'wpCategory_id', 'wpBlog_category');      //$this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');
  }
  
  
  
  
}
