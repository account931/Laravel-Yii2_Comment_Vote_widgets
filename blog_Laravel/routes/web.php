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
Route::get('/EloquentExample', 'HomeController2@eloquentt')->name('EloquentExample2');  //Active Record Eloquent example Route

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



//Rest Api
Route::get('/articles', 'Rest@index');       http://localhost/laravel+Yii2_widgets/blog_Laravel/public/articles
Route::get('articles/{id}', 'Rest@show');  //http://localhost/laravel+Yii2_widgets/blog_Laravel/public/articles/8
Route::post('articles', 'Rest@store');
Route::put('articles/{id}', 'Rest@update');
Route::delete('articles/{id}', 'Rest@delete');


//Test Rest Apitest
Route::get('/testRest','TestRest@index');


