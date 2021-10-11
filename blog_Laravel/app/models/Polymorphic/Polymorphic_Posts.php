<?php
//Model for tabel {polymorphic_posts}
namespace App\models\Polymorphic;

use Illuminate\Database\Eloquent\Model;
//use App\models\Polymorphic\Polymorphic_Images;   //model for DB table {polymorphic_images} //Mega Fix


class Polymorphic_Posts extends Model
{

    /**
    * Connected DB table name.
    *
    * @var string
    */
    protected $table = 'polymorphic_posts';

  
    //protected $fillable = ['wpBlog_author', 'wpBlog_title', 'wpBlog_text', 'wpBlog_category', 'wpBlog_created_at'];  //????? protected $fillable = ['wpBlog_author', 'wpBlog_text', 'wpBlog_author', 'wpBlog_category',  'updated_at', 'created_at'];
    //public $timestamps = false; //to override Error "Unknown Column 'updated_at'" that fires when saving new entry

  
    /**
     * Get the post's image. Polymorphic relation
	 *
     */
    public function imageZ()
    {
        return $this->morphOne(\App\models\Polymorphic\Polymorphic_Images::class, 'imageable');
    }

    
	 /**
     * Get the Author name. hasOne relation
	 *
     */
    public function authorName(){
		return $this->hasOne('App\models\Polymorphic\Polymorphic_Users', 'id', 'author_id')->withDefault(['name' => 'Unknown']);      //$this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');
    }

  
}
