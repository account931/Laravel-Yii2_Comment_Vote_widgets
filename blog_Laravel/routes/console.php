<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

//My phone quizen test to console
Artisan::command('quiz:start', function () {
	$a = '1112031584';
	$s = '';
		
	for ($i = 1; $i < strlen($a); $i++){
			
		if($a[$i] % 2 == $a[$i -1]){
			$s.= max($a[$i], $a[$i -1]);
		} 
	}
	dd("phone is " . $s);
    //$this->info("Sending email to: !");
});