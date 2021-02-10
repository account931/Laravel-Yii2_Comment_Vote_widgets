<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log; //use logging

class WriteCredentialsToLog
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
    public function handle(Login $event)
    {
         // get logged in user's email and username
        $email = $event->user->email;
        $username = $event->user->name;
		//dd("Event says " . $email . " " . $username );
		
		//writing to /storage/log
		Log::info("Listerner WriteCredentialsToLog says: Login at " . date('Y-m-d H:i:s') . " with ". $email . " and username " . $username);
    
        // send email notification about login or whatever u want
    }
}
