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

//Route::get('/home', 'HomeController@index')->name('home'); 
Route::get('/home', 'ShowProfile@index')->name('home');

//All users list  
Route::get('/EloquentExample', 'AllUsersEloquent@eloquentt')->name('EloquentExample2');  //Active Record Eloquent example Route
Route::get('/showOneUser/{id}', 'AllUsersEloquent@showOne')->name('showOneUser');


Route::get('/showProfile', 'ShowProfile@index')->name('showprofile');  //my profile Route

//Route::get('/home2',['as'=>'loginC','uses'=>'HomeController2@index']);

Route::get('/formSubmit', 'FormSubmit@index')->name('formsubmit');  //form submit example Route
Route::post('/formSubmit', 'FormSubmit@index')->name('formsubmit');  //form submit example Route


//Wpress Bloq
Route::get('/wpBlogg', 'WpBlog@index')->name('wpblog');  //WpPress Blog route
Route::get('createNewWpress', 'WpBlog@create')->name('createNewWpress');  //WpPress route for displaying form to create new entry
Route::post('/storeNewWpress','WpBlog@store'); //Saving form fields via POST
Route::post('delete/{id}','WpBlog@destroy');
Route::get('edit/{id}','WpBlog@edit');
Route::post('update/{id}','WpBlog@update');





//Test Rest Api test
Route::get('/testRest','TestRest@index');


//multilanguage
Route::get('/multilanguage', 'MultiLanguage@index')->name('multilanguage'); 


//RBAC
Route::get('/rbac', 'RbacController@index')->name('rbac'); 