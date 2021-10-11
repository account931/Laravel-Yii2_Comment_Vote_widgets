<?php
//Model for tabel {polymorphic_users}
namespace App\models\Polymorphic;

use Illuminate\Database\Eloquent\Model;
//use App\models\Polymorphic\Polymorphic_Images;   //model for DB table {polymorphic_images} //Mega Fix


class Polymorphic_Users extends Model
{

    /**
    * Connected DB table name.
    *
    * @var string
    */
    protected $table = 'polymorphic_users';

  
    //protected $fillable = ['wpBlog_author', 'wpBlog_title', 'wpBlog_text', 'wpBlog_category', 'wpBlog_created_at'];  //????? protected $fillable = ['wpBlog_author', 'wpBlog_text', 'wpBlog_author', 'wpBlog_category',  'updated_at', 'created_at'];
    //public $timestamps = false; //to override Error "Unknown Column 'updated_at'" that fires when saving new entry

  
   /**
     * Get the user's image. Polymorphic relation
	 *
     */
    public function imageZ()
    {
        return $this->morphOne(\App\models\Polymorphic\Polymorphic_Images::class, 'imageable');
    }
  
}
