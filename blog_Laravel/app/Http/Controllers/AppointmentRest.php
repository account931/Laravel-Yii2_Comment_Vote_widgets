<?php
//Rest controller, works with DB table {appoint-room-list}. Used in Appointment vue
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //validate
use App\models\Appointment\RoomListRest; //Rest model for all posts

class AppointmentRest extends Controller
{
    
  /**
   * returns all rooms hosts
   * @return 
   */
	public function index()
    {
        return RoomListRest::all();
    }
 
 
    
	
  /**
   * returns 6 month calendar
   * @return string
   */
	public function getCalendar()
    {
        return 'Calendar ajax response time is ' . date('Y-m-d H:i:s');
    }
 

}
