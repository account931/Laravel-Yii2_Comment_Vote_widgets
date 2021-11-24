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
Route::get('/home', 'ShowProfile@index')->name('home'); //shows currently logged user profile

//All users list  
Route::get('/EloquentExample', 'AllUsersEloquent@eloquentt')->name('EloquentExample2');  //Active Record Eloquent example Route
Route::get('/showOneUser/{id}', 'AllUsersEloquent@showOne')->name('showOneUser');


Route::get('/showProfile', 'ShowProfile@index')->name('showprofile');  //my profile Route

//Route::get('/home2',['as'=>'loginC','uses'=>'HomeController2@index']);

Route::get('/formSubmit', 'FormSubmit@index')->name('formsubmit');  //form submit example Route
Route::post('/formSubmit', 'FormSubmit@index')->name('formsubmit');  //form submit example Route


//Wpress Bloq
Route::get('/wpBlogg', 'WpBlog@index')->name('wpblog');  //WpPress Blog index route
Route::get('createNewWpress', 'WpBlog@create')->name('createNewWpress');  //WpPress route for displaying form to create new entry
Route::post('/storeNewWpress','WpBlog@store'); //Saving form fields via POST
Route::post('delete/{id}','WpBlog@destroy');
Route::get('edit/{id}','WpBlog@edit');
Route::post('update/{id}','WpBlog@update');
Route::get('/wpBlogOne/{id}', 'WpBlog@viewOne')->name('wpBlogOne');  //WpPress Blog one article view route



//Wpress with Images Bloq
Route::get('/wpBlogImages',         'WpBlogImagesContoller@index')  ->name('wpBlogImages');  //WpPress with Images Blog index route
Route::get('/wpBlogImagesOne/{id}', 'WpBlogImagesContoller@viewOne')->name('wpBlogImagesOne');     //WpPress with Images Blog one article view route
Route::get('createNewWpressImg',    'WpBlogImagesContoller@create') ->name('createNewWpressImg');  //WpPress with Images route for displaying form to create new entry
Route::post('/storeNewWpressImg',   'WpBlogImagesContoller@store'); //Saving form fields via POST



//Wpress Blog on Vue Framework
Route::get('/wpBlogVueFrameWork',   'WpBlog_VueContoller@index')  ->name('wpBlogVueFrameWork')->middleware('auth');  //WpPress on Vue Framework Blog index route
Route::group(['middleware' => 'auth', 'prefix' => 'post'], function () { //url must contain /post/, i.e /post/get_all
    Route::get('get_all',          'WpBlog_VueContoller@getAllPosts')->name('fetch_all');  //REST API to /GET all posts
    Route::post('create_post_vue', 'WpBlog_VueContoller@createPost')->name('create_post_vue'); //REST API to /POST (create) a new blog
});



//not proceeded
/*
Route::post('delete/{id}','WpBlog@destroy');
Route::get('edit/{id}','WpBlog@edit');
Route::post('update/{id}','WpBlog@update');
*/


//Test Rest Api test
Route::get('/testRest','TestRest@index');


//multilanguage
Route::get('/multilanguage', 'MultiLanguage@index')->name('multilanguage'); 


//RBAC
Route::get('/rbac', 'RbacController@index')->name('rbac'); //display RBAC table Control Panel
Route::get('/createtwoRoles', 'RbacController@createRoles')->name('createtwoRoles');  //route to method to create 2 roles
Route::post('/assignRole', 'RbacController@assignRole')->name('/assignRole');  //route to method to assignRole from RBAC Table Control Panel, send via POST form
Route::post('/detachRole', 'RbacController@detachRole')->name('/detachRole');  //route to method to detach a certain role from certain user from RBAC Table Control Panel, send via POST form
Route::post('/addNewRole', 'RbacController@storeNewRole')->name('/addNewRole');  //route to method to add a new role to Db table Role, send via POST form



//ShopSimple
Route::get('/shopSimple', 'ShopPayPalSimpleController@index')->name('shopSimple'); //display shopSimple start page
Route::get('/cart', 'ShopPayPalSimpleController@cart')->name('cart'); //display shopSimple start page
Route::get('/showOneProduct/{id}', 'ShopPayPalSimpleController@showOneProductt')->name('showOneProduct');
Route::post('/addToCart', 'ShopPayPalSimpleController@storeToCart')->name('/addToCart');  //route to method to add to cart, send via POST form
Route::post('/checkOut', 'ShopPayPalSimpleController@checkOut')->name('/checkOut');  //route to method to checkOut, gets form data with Final Cart send via POST form and redirects to GET /checkOut2
//just to prevent users entering get url for post method, i.e if user enter /checkOut manually in browser
Route::get('/checkOut', function () { throw new \App\Exceptions\myException('Bad request. Not POST request, You are not expected to enter this page.'); });

Route::get('/checkOut2',   'ShopPayPalSimpleController@checkOut2')->name('/checkOut2');  //route to method to checkOut (page with shipping details), send via GET
Route::post('/payPage1',   'ShopPayPalSimpleController@pay1')->name('/payPage1');        //route to get <form> data via $_POST from Checkout/Order page (Shipping details (address, phone. etc)) and redirects to $_GET page route {payPage2}. 
Route::get('/payPage2',    'ShopPayPalSimpleController@pay2')->name('/payPage2');        //route final pay page, send via POST form
Route::get('/pay-or-fail', 'ShopPayPalSimpleController@payOrFail')->name('pay-or-fail'); //final payment page, returned by PayPal INP Listener, displays if payment was successfull or not



//Tried but failed Entrust middleware
//Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {
	
//ShopSimple Admin Panel
Route::get('/shopAdminPanel', 'ShopPayPalSimple_AdminPanel@index')->name('shopAdminPanel'); //display Admin Panel start page
Route::get('/admin-orders',   'ShopPayPalSimple_AdminPanel@orders')->name('admin-orders'); //display Admin Panel ....
Route::get('/count-orders',   'ShopPayPalSimple_AdminPanel@countOrders'); // fot ajax counting Orders in Admin panel
Route::post('/updateStatus',  'ShopPayPalSimple_AdminPanel@updateStatusField')->name('/updateStatus');   //route to get <form> data via $_POST from {ShopPayPalSimple_AdminPanel@orders} page ()) and redirects back. 
Route::get('/admin-products', 'ShopPayPalSimple_AdminPanel@products')->name('admin-products'); //display Admin Panel with all products (and option to edit them)
Route::get('/admin-add-product', 'ShopPayPalSimple_AdminPanel@addProduct')->name('admin-add-product'); //display Admin Page to add a product
Route::post('/storeNewproduct',  'ShopPayPalSimple_AdminPanel@storeProduct')->name('storeNewproduct'); //display Admin Page to add a product

Route::get('/admin-one-product/{id}', 'ShopPayPalSimple_AdminPanel@showOneProduct')->name('admin-one-product'); //show one product by ID
Route::get('admin-edit-product/{id}', 'ShopPayPalSimple_AdminPanel@editProduct')->name('admin-edit-product/{id}'); //display Admin Page to edit an existing product
Route::post('/admin-delete-product',  'ShopPayPalSimple_AdminPanel@deleteProduct')->name('/admin-delete-product');  //route to method to delete certian product by ID. Sent by POST form

Route::post('/addQuantity',    'ShopPayPalSimple_AdminPanel@addStockQuantity')  ->name('addQuantity');   //route to get <form> data via $_POST from page {'/admin-edit-product/{id}'}) (function editProduct()),      add++ quantity to   table {shop_quantity} and redirects it to back  route {'/admin-edit-product/{id}'}. 
Route::post('/minusQuantity',  'ShopPayPalSimple_AdminPanel@minusStockQuantity')->name('minusQuantity'); //route to get <form> data via $_POST from page {'/admin-edit-product/{id}'}) (function editProduct()), minus-- quantity from table {shop_quantity} and redirects it to back  route {'/admin-edit-product/{id}'}. 

 
//});

//Test for middle (just like the one developed in Yii2)
Route::get('/testMiddle', 'TestMiddleController@index')->name('testMiddle'); //start page
Route::post('/checkEmail',  'TestMiddleController@checkMail')->name('/checkEmail');   //route to get <form> data via $_POST from {TestMiddleController@index} page ()) and redirects either to custom login or register. 

Route::get('/customLogin',    'TestMiddleController@customLogin')->name('customLogin');      //my custom login page
Route::get('/customRegister', 'TestMiddleController@customRegister')->name('customRegister'); //my custom register page




//Rest Api with TokenGuard, access to Rest by token (Bearer authentication  (also called token authentication))
Route::get('/tokenGuard', 'TokenGuardController@index')->name('tokenGuard'); 


//Appointment, client-side
Route::get('/appointment', 'AppointmentController@index')->name('appointment'); 


//Admin LTE, Inject from ABZ-Laravel_6 //JUST FACADE, as Admin LTE won't work on Laravel 5.2 (). Implemented in => (IMPLEMENTED IN abz_Laravel_6_LTS)
Route::get('/adminlte',      'AdminLTEController@index')->name('adminlte');
Route::get('/country-list',  'AdminLTEController@getList');


//Events/Listeners example
Route::get('/eventListenersX', 'EventsListenersController@index')->name('eventListenersX'); //show a button to trigger
Route::get('/runEventX',       'EventsListenersController@triggerEvent')->name('runEventX'); //run an event

//Service Layout
Route::get('/service-layout',  'ServiceLayoutController@index')->name('service-layout'); 

//Socialite Package (Facebook, Google)
Route::get('/socialite',             'SocialiteController@index')->name('socialite'); 
Route::get('auth/facebook',          'SocialiteController@facebookRedirect');
Route::get('auth/facebook/callback', 'SocialiteController@loginWithFacebook');


//Create XML YML file for Rozet shop
Route::get('/rozetk',     'RozetController@index')       ->name('rozetk'); 
Route::get('/createSQL',  'RozetController@createXMLSQL')->name('createSQL');

//Captcha, reCaptcha, Laravel Notify package
Route::get('/captcha',         'CaptchaController@index')         ->name('captcha');
Route::post('/handcaptcha',    'CaptchaController@handCaptcha')   ->name('handcaptcha');
Route::post('/package-captcha','CaptchaController@packageCaptcha')->name('package-captcha');



//Polymorphic relations + Gii Crud example (Controller is in subfolder)
Route::get('/polymorphic',       'Polymorphic_Controller\PolymorphicController@index') ->name('polymorphic');

// Gii table, show edit page
Route::get('gii-edit-post/{id}', 'Polymorphic_Controller\PolymorphicController@editProduct')  ->name('gii-edit-post/{id}'); //display form to edit an existing post
Route::put('update-post',        'Polymorphic_Controller\PolymorphicController@updateProduct')->name('update-post'); //$_PUT to update existing post

// Gii table, show "Create new" page
Route::get('gii-create-new-post',    'Polymorphic_Controller\PolymorphicController@createProduct')     ->name('gii-create-new-post'); //display form to create a new post
Route::post('create-new-polym-post', 'Polymorphic_Controller\PolymorphicController@createStoreProduct')->name('create-new-polym-post'); //$_POST to create a new post



//Elastic Search (Controller is in subfolder)
Route::get('/elastic',               'Elastic\ElasticController@index')          ->name('elastic');          //page with forms for simplle and elastic search
Route::get('/elas-one-product/{id}', 'Elastic\ElasticController@showOneProduct') ->name('elas-one-product'); //show one product by ID (when u click in Elastic Cloud Search results)
Route::get('/elastic-indexing',      'Elastic\ElasticController@doElasIndexing') ->name('elastic-indexing'); //page to do Elastic indexing for a Sql table



//SQL: Where vs Having(Controller is in subfolder)
Route::get('/where_having', 'SQL_where_having_Contr\Where_havingController@index') ->name('where_having');







//test route to call controller via command-line. Actually does not need any Route as called via CLI Tinker just to check it works. Controller function just saves current time to log.
Route::get('/cli', 'CliCommandController@index')->name('cli'); //


Route::get('/404', function () {
    return abort(404);
});













// Routes to emulate SSH on Hosting Server, when u don't have access to SSH

//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

Route::get('/any-route', function () {
  Artisan::call('storage:link');
});