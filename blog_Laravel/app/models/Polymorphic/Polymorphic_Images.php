<?php
//Model for tabel {polymorphic_images}
namespace App\models\Polymorphic;

use Illuminate\Database\Eloquent\Model;
//use App\models\Polymorphic\Polymorphic_Posts;    //model for DB table {polymorphic_posts}


class Polymorphic_Images extends Model
{

    /**
    * Connected DB table name.
    *
    * @var string
    */
    protected $table = 'polymorphic_images';

  
    //protected $fillable = ['wpBlog_author', 'wpBlog_title', 'wpBlog_text', 'wpBlog_category', 'wpBlog_created_at'];  //????? protected $fillable = ['wpBlog_author', 'wpBlog_text', 'wpBlog_author', 'wpBlog_category',  'updated_at', 'created_at'];
    //public $timestamps = false; //to override Error "Unknown Column 'updated_at'" that fires when saving new entry

  
    /**
     * Get the parent imageable model (user or post).
     */
    public function imageable()
    {
        //return $this->morphTo();
		return $this->morphTo(__FUNCTION__, 'imageable_type', 'imageable_id');
    }

  
}
