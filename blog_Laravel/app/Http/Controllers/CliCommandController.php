<?php
//test controller to call controller via command-line Tinker. See how call in ReadMe
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; //Logging

class CliCommandController extends Controller
{
	public function __construct()
    {
        //$this->middleware('auth');
    }

	public function index()
    {
            //just logging current time, saves to \storage\logs\laravel.txt
			Log::info('CLI is executed at ' . date('Y-m-d H:i:s') );
				
		    
    }
}
