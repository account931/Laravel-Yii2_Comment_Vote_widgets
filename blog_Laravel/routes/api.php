<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



//Wpress Rest Api
Route::get('/articles', 'Rest@index');       //http://localhost/laravel+Yii2_widgets/blog_Laravel/public/articles
Route::get('articles/{id}', 'Rest@show');  //http://localhost/laravel+Yii2_widgets/blog_Laravel/public/articles/8
Route::post('articles', 'Rest@store');
Route::put('articles/{id}', 'Rest@update');
Route::delete('articles/{id}', 'Rest@delete');


//AppointmentRoom List Rest Api
Route::get('/rooms',       'AppointmentRest@index');      // http://localhost/laravel+Yii2_widgets/blog_Laravel/public/rooms
Route::get('/getCalendar', 'AppointmentRest@getCalendar');      // http://localhost/laravel+Yii2_widgets/blog_Laravel/public/rooms


//Captcha_Vue_2022 Rest Api Endpoint
Route::group(['middleware' => 'myCustomSessionsX', ], function () {
    Route::get('/getCaptchaSet',                    'Captcha_Vue_2022\Rest_Api_Captcha_Vue_2022_Controller@getRandomCaptchaSet');   //Endpoint that returns randomly generated captcha set of 9 images //http://localhost/laravel+Yii2_comment_widget/blog_Laravel/public/api/getCaptchaSet
    Route::post('/checkIfCaptchaCorrectlySelected', 'Captcha_Vue_2022\Rest_Api_Captcha_Vue_2022_Controller@checkIfCaptchaCorrect'); //Endpoint that checks user's selected images against saved in session randomly generated captcha set of 9 images & returns if user has passed the captcha or not  //http://localhost/laravel+Yii2_comment_widget/blog_Laravel/public/api/checkIfCaptchaCorrectlySelected
});

//middleware' => ['web']
//Route::group(['middleware' => 'auth', 'prefix' => 'post'], function () { //url must contain /post/, i.e /post/get_all