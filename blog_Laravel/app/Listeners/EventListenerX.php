<?php
// Listener for manually created Event 'App\Events\SomeEventX'  
namespace App\Listeners;

use App\Events\SomeEventX;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventListenerX
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
     * Handle the event.
     *
     * @param  SomeEventX  $event
     * @return void
     */
    public function handle(SomeEventX $event)
    {
        echo '</br>
		      <p>Event {SomeEventX} was fired manually (by clicking the button, i.e redirecting to function triggerEvent()). </p>
			  <p>And caused execution of Listener EventListenerX. </p>
		      <p>The Code here executed is in /app/Listeners/EventListenerX. </p>
			  <p>Other Listener /app/Listeners/WriteCredentialsToLog fires automatically on every Login (makes writting credetials to Log). </p>';
    }
}
