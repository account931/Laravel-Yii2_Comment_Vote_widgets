<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;//does not work
//use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;//Fix


class CheckRoutesTest extends TestCase
{
	//use RefreshDatabase;
	
	
	
    /**
     * A basic test example. Tests if route is OK
     *
     * @return void
     */
    public function test_checkRoute()
    {
		//$this->assertTrue(true); //mock/ forced return True
		
		//$this->withoutMiddleware();
		
		//adding csrf token, may be absence of it cause 500 Error
		/* Session::start();
        $params = [
                'key'    => 'value',
                '_token' => csrf_token()
        ]; */
	
        $response = $this->get('/');
        $response->assertStatus(200);
		
    }
	
	
	
	
	//DOES NOT WORK CORRECT
	//if Error "Call to undefined method" =>  
	//The visit and see method no longer works in Laravel 5.4 by default. You need to install Laravel Dusk package.
    //composer require --dev laravel/dusk v1.1    => only this is OK for Laravel 5.4 !!!!!!!!!!!!!!
	public function test_checkVisual()
    {
		/*
        $this->visit('/')
             ->see('Laravel CPH 2019')
             ->dontSee('Rails'); 
        */			 
    }
	
	
}
