<?php
//Model for wpress_blog_post
namespace App\models\wpBlogImages;

use Illuminate\Database\Eloquent\Model;
use App\models\wpBlogImages\Wpress_ImagesStock; //table for images

class Wpress_images_Posts extends Model
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
  protected $table = 'wpressimages_blog_post';

  
  protected $fillable = ['wpBlog_author', 'wpBlog_title', 'wpBlog_text', 'wpBlog_category', 'wpBlog_created_at'];  //????? protected $fillable = ['wpBlog_author', 'wpBlog_text', 'wpBlog_author', 'wpBlog_category',  'updated_at', 'created_at'];
  public $timestamps = false; //to override Error "Unknown Column 'updated_at'" that fires when saving new entry

  
  //CHANGE TO BELONGTO!!!!!
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
  
   //CHANGE TO BELONGTO!!!!!
  /**
   * hasMany => get category name from table {Wpress_images_Category} based on column {wpBlog_category} in table {wpress_blog_post} .
   * hasMany
   */
  public function categoryNames()
  {
    return $this->belongsTo('App\models\wpBlogImages\Wpress_images_Category', 'wpBlog_category','wpCategory_id');  //return $this->belongsTo('App\modelName', 'parent_id_this_table', 'foreign_key_that_table');
  }
  
  
  
  
   /**
   * hasOne and hasMany - you're telling Laravel that this table does not have the foreign key.
   * hasMany => get category name from table {Wpress_images_Category} based on column {wpBlog_category} in table {wpress_blog_post} .
   * hasMany
   */
  public function getImages(){
	    
        return $this->hasMany('App\models\wpBlogImages\Wpress_ImagesStock', 'wpImStock_postID', 'wpBlog_id'); //->withDefault(['wpImStock_name' => 'Unknown']);  //'foreign_key', 'owner_key' i.e 'this TableColumn', 'that TableColumn'
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
    * saves form inputs to DB (FINAL)
    *
    * @param  
    * @return 
    */
	public function saveFields($data, $imagesData){
		
		$this->wpBlog_author = auth()->user()->id;
        $this->wpBlog_text     = $data['description'];
        $this->wpBlog_title    = $data['title'];
		$this->wpBlog_category = $data['category_sel'];
		$this->save();
		$idX = $this->id;
		
		if($this->save()){
		    //saving images
		    $model = new Wpress_ImagesStock();
		    foreach ($imagesData as $fileImageX){
			
			    //getting Image info for Flash Message
		        $imageName = time(). '_' . $fileImageX->getClientOriginalName();
		        $sizeInByte =     $fileImageX->getSize() . ' byte';
		        $sizeInKiloByte = round( ($fileImageX->getSize() / 1024), 2 ). ' kilobyte'; //round 10.55364364 to 10.5
		        $fileExtens =     $fileImageX->getClientOriginalExtension();
		        //getting Image info for Flash Message
		
		
		        //Move uploaded image to the specified folder 
		        $fileImageX->move(public_path('images/wpressImages'), $imageName);
			    $model->wpImStock_name    = $imageName; //image
			    $model->wpImStock_postID  = $idX; // just saved article ID
				$model->save();
			
		    }
		}
	}

  
}
