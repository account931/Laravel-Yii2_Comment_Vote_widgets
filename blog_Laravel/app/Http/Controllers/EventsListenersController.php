<?php
//
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\SomeEventX; //event
//use Illuminate\Support\Facades\Validator; //validate
//use App\models\Appointment\RoomListRest; //Rest model for all posts

class EventsListenersController extends Controller
{
    
  /**
   * returns all 
   * @return 
   */
	public function index()
    {
        return view('EventsListeners.index');

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
