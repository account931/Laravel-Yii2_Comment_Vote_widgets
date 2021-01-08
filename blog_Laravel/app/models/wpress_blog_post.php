<?php
//Model for wpress_blog_post
namespace App\models;

use Illuminate\Database\Eloquent\Model;

class wpress_blog_post extends Model
{
	//CAUSES hasmany Crashd
   /*
   public $wpBlog_id;
   public $wpBlog_title;
   public $wpBlog_text;
   public $wpBlog_author;
   public $wpBlog_category;
   */

  /**
   * Connected DB table name.
   *
   * @var string
   */
  protected $table = 'wpress_blog_post';

  
  protected $fillable = ['wpBlog_author', 'wpBlog_title', 'wpBlog_text', 'wpBlog_category', 'wpBlog_created_at'];  //????? protected $fillable = ['wpBlog_author', 'wpBlog_text', 'wpBlog_author', 'wpBlog_category',  'updated_at', 'created_at'];
  public $timestamps = false; //to override Error "Unknown Column 'updated_at'" that fires when saving new entry

  
  /**
   * hasOne => get user name from table {users} based on column {wpBlog_author} in table {wpress_blog_post} .
   * hasOne
   */
  public function authorName()
  {
    //return $this->belongsTo('App\users', 'id', 'wpBlog_author'); //return $this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');
	return $this->hasOne('App\users', 'id', 'wpBlog_author')->withDefault(['name' => 'Unknown']);     //$this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');
    //->withDefault(['name' => 'Unknown']) this prevents the crash if this author id does not exist in table User (for example after fresh install and u forget to add users to user table)
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
    * Manula emulation of Laravel getter, gets DB Enum values (0/1) and changed to text "Published/Not Published"
    *
    * @param  string  $value
    * @return string
    */
   public function getIfPublished($value){
       if($value == '1'){
		return 'Published';
	} else {
		return 'Not Published';
	}
   }
   
   /**
    * truncates/crops the text
    *
    * @param  string  $text, int $maxLength
    * @return string
    */
	public function truncateTextProcessor($text, $maxLength)
	{
        $length = $maxLength; 
		if(strlen($text) > $length){
		    $text = substr($text, 0, $length) . "......";
		} 
	return $text;		
	}
	
	
	
	
	/**
    * saves form inputs to DB (NOT USED)
    *
    * @param  
    * @return 
    */
	public function saveTicket($data)
    {   
        //dd($data['title']); return;
        $this->wpBlog_author = auth()->user()->id;
        $this->	wpBlog_title = $data['title'];
        $this->	wpBlog_text = $data['description'];
		$this->	wpBlog_category = $data['category_sel'];
        $this-> wpBlog_created_at = date('Y-m-d H:i:s');
        $this->save();
        return 1;
    }


    
    /**
    * saves form inputs to DB (FINAL)
    *
    * @param  
    * @return 
    */
	public function saveFields($data){
		$this->wpBlog_author = auth()->user()->id;
        $this->wpBlog_text = $data['description'];
        $this->wpBlog_title = $data['title'];
		$this->wpBlog_category = $data['category_sel'];
		$this->save();
	}

  
}
