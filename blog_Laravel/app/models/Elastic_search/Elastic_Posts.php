<?php
//Model for tabel {elastic_search}
namespace App\models\Elastic_search;

use Illuminate\Database\Eloquent\Model;
//use App\models\Polymorphic\Polymorphic_Images;   //model for DB table {polymorphic_images} //Mega Fix
use App\ElasticRepository\traits\Searchable;

class Elastic_Posts extends Model
{
    use Searchable; //use my trait
	
    /**
    * Connected DB table name.
    *
    * @var string
    */
    protected $table = 'elastic_search';

    //allow mass assignment
    //protected $fillable = [ 'post_name', 'post_text', 'author_id', 'wpBlog_created_at'];  //????? protected $fillable = ['wpBlog_author', 'wpBlog_text', 'wpBlog_author', 'wpBlog_category',  'updated_at', 'created_at'];
    //public $timestamps = false; //to override Error "Unknown Column 'updated_at'" that fires when saving new entry

  
}
