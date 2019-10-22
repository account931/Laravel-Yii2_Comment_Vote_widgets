<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//default page
Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); 
Route::get('/home2', 'HomeController2@index')->name('home55'); 

Route::get('/showProfile', 'ShowProfile@index')->name('showprofile'); 

//Route::get('/home2',['as'=>'loginC','uses'=>'HomeController2@index']);