<?php
//
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\SomeEventX; //event
//use Illuminate\Support\Facades\Validator; //validate
//use App\models\Appointment\RoomListRest; //Rest model for all posts
use App\User; 

class EventsListenersController extends Controller
{
    
  /**
   * returns all 
   * @return 
   */
	public function index()
    {
        //to test beforeDelete event
        if (User::where('id', 999)->exists()) { 
            User::where('id',999)->first()->delete(); //Delete
            $message = "<b> User 999 </b> was deleted in Controller to trigger beforeDelete Event in model App/User!!!!";
        } else {
            $message = "User 999 does not exist to trigger beforeDelete Event. Create it manually in DB Users.";

        }
        
        return view('EventsListeners.index')->with(compact('message'));

    }
 
    
	/**
   * returns all 
   * @return 
   */
	public function triggerEvent()
    {
        // here we trigger an event 'App\Events\SomeEventX'
        event(new SomeEventX());

    }
       

}
