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

 
//});

//Test for middle (like one developed in Yii2)
Route::get('/testMiddle', 'TestMiddleController@index')->name('testMiddle'); 


//Rest Api with TokenGuard, access to Rest by token (Bearer authentication  (also called token authentication))
Route::get('/tokenGuard', 'TokenGuardController@index')->name('tokenGuard'); 






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