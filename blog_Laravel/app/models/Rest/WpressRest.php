<?php
//REST API for table {wpress_blog_post}
namespace App\models\Rest;

use Illuminate\Database\Eloquent\Model;

class WpressRest extends Model
{
   
   
    /**
   * Connected DB table name.
   *
   * @var string
   */
   protected $table = 'wpress_blog_post';
  
  /**
   * The primary key associated with the table.
   *
   * @var string
   */
    protected $primaryKey = 'wpBlog_id'; //to show Laravel what id column is 'wpBlog_id' not 'id'. To be able to use in findOrfail($id)
  
  
  protected $fillable = [ 'wpBlog_title', 'wpBlog_author', 'wpBlog_text', 'wpBlog_author', 'wpBlog_category', 'wpBlog_created_at'];
  public $timestamps = false; //to override Error "Unknown Column 'updated_at'" that fires when saving new entry

  //protected $hidden = ['created_at', 'password'];
  
  
  
  /**
   * hasOne => get user name from table {users} based on column {wpBlog_author} in table {wpress_blog_post} .
   * hasOne
   */
  public function authorName()
  {
    //return $this->belongsTo('App\users', 'id', 'wpBlog_author'); //return $this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');
	//to exclude PASSWORD from returning JSON add to XXX->select(array('id', 'name')) otherwise it returns all fields from table {user}
	return $this->hasOne('App\users', 'id', 'wpBlog_author')->select(array('id', 'name'));      //$this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');
  }
  
  
 
  
  /**
   * hasMany => get category name from table {wpress_category} based on column {wpBlog_category} in table {wpress_blog_post} .
   * hasMany
   */
  public function categoryNames()
  {
    return $this->belongsTo('App\models\wpress_category', 'wpBlog_category','wpCategory_id');  //return $this->belongsTo('App\modelName', 'parent_id_this_table', 'foreign_key_that_table');
  }
  
  
}
