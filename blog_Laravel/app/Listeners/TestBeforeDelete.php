<?php
// Listener for built-in Event 'eloquent.deleting' 
//Does Not work. The only working way to emulate Yii2 beforeDelete() event is to hook the Delete event in model App/User
namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log; //use logging

class TestBeforeDelete
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event. On login writes to /storage/log
     *
     * @param  Login  $event
     * @return void
     */
    public function handle() //Login $event
    {
         // get logged in user's email and username
        //$email = $event->user->email;
        //$username = $event->user->name;
		dd("Before Deleted");
		//writing to /storage/log
		Log::info("Listener TestBeforeDelete says: Deleted at " . date('Y-m-d H:i:s') . " with ");
    
    }
}
