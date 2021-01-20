<?php
//REST API for table {appoint-room-list}
namespace App\models\Appointment;

use Illuminate\Database\Eloquent\Model;

class RoomListRest extends Model
{
   
   
    /**
   * Connected DB table name.
   *
   * @var string
   */
   protected $table = 'appoint-room-list';
  
  /**
   * The primary key associated with the table.
   *
   * @var string
   */
    protected $primaryKey = 'r_id'; //to show Laravel what id column is 'wpBlog_id' not 'id'. To be able to use in findOrfail($id)
  
  
  //protected $fillable = [ 'wpBlog_title', 'wpBlog_author', 'wpBlog_text', 'wpBlog_author', 'wpBlog_category', 'wpBlog_created_at'];
  public $timestamps = false; //to override Error "Unknown Column 'updated_at'" that fires when saving new entry

  //protected $hidden = ['created_at', 'password'];
  
 
  
}
