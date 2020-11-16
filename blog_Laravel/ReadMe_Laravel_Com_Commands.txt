Laravel Framework 5.4.36
OpenServer 5.2.2 Php 7.2
Credentials: dimmm931@gmail.com =>  dimax2

On HP EliteBook 2530p: Composer -> via Windows cmd, artisan -> via OpenServer, 
        git -> via Windows cmd, NPM -> composer

On T42: so far the same, but Composer -> via Openserver

Table of Content:
1.How to install Laravel
1.1 How to copy/clone existing Laravel project and run
2.
3. Blade
4.Error handling, throw custom exceptions 
5.Atrisan commands
6.How to create new Controller/action, view and add to menu
7.Forms
8.Form Validation
8.1 Form input with in-line validation errors <span>, like in Yii2 
8.2 Form fields Insert to DB
9.Migrations/Seeders
10.hasOne/hasMany relation
11.DB SQL Eloquent queries
12.Laravel Crud
13.REST API
13.1  Has Many relation in JSON (REST API)
14. Laravel Flash messages
15. Js/Css, minify, Laravel Mix
16. CRUD
17. RBAC 
18. Multilanguges (Localization)
19. Cookie.
20. How to create Helper
21. Login with username instead of email
22. Laravel production

34.Highlight active menu item
35.Miscellaneous VA Laravel
35.2.Miscellaneous VA HTML/CSS
35.3 Miscellaneous to move to Yii2 ReadMe
36. Known Errors

//================================================
1.How to inst
http://laravel.su/docs/5.4/installation

1. If first time ever, install global installer=>  composer global require "laravel/installer"
2. Navigate to necessary folder and =>    laravel new yourProjectName
3. To add authentication (login/register) (or read manual => https://vegibit.com/how-to-create-user-registration-in-laravel/ )=>
       CLI=> php artisan make:auth

Эту команду надо использовать на свежем приложении, она установит шаблоны для регистрации и входа, а также роуты для всех конечных точек аутентификации. Также будет сгенерирован HomeController, который обслуживает запросы к панели настроек вашего приложения после входа. Но вы можете изменить или даже удалить это контроллер, если это необходимо для вашего приложения.


https://developernotes.ru/laravel-5/modeli-i-baza-dannih-v-laravel-5
#Controllers => php artisan make:controller ShowProfile       location => \app\Http\Controllers
#Models => php artisan make:model tableName                   location => \app\Http
#Views                                                        location => resources\views
#Common Layout => resources\views\layouts\app.blade.php


#create migration   =>   php artisan make:migration create_users_table
#run all migrations =>   php artisan migrate


//================================= 


//============================================	

1.1 How to copy/clone existing Laravel project and run
credits => https://si-dev.com/ru/portfolio/larablog

Клонировать или загрузить репозиторий (ссылка на гитхаб ниже)
Перейти в директорию проекта и выполнить composer install
В корне проекта на основе .env.example создать файл .env с Вашими настройками (параметры подключения к БД и т.д.)
Выполнить php artisan key:generate
Выполнить php artisan migrate
Если есть необходимость заполнения базы данных фейковыми данными, выполнить php artisan db:seed 
Выполнить php artisan passport:install
-------------------------
Bonus => set-up for React
После сборки проекта в корне появится директория public с файлом index.html и поддиректориями js, css и images с соответствующими файлами
USAGE
Клонируйте или загрузите репозиторий (ниже ссылка на гитхаб)
Зайдите в директорию проекта и устновите зависимости выполнив команду npm install
Запустить проекта в режиме разработки: npm run start
Собрать проект: npm run build

//============================================	






//============================================	
3. Blade
 A blade {{}} is just the equilivant of <?php echo() ?>
#  simple example => Hello, {{ $name }}	
   without escaping htmlentities() => Hello, {!! $name !!}
 
#Blade if else
     @if (Auth::guest())
               <li><a href="{{ route('register') }}">Register</a></li>
          @else
               li><a href="{{ route('register') }}">Register</a></li>
     @endif
	 
#Blade Comments  =>  {{-- COMMENT HERE --}}

#Blade image =>  <img class="img-responsive my-cph" src="{{URL::to('/')}}/images/cph.jpg"  alt=""/>
#Blade pure php => 
     @php
     {{-- PHP code here --}}
     @endphp
	 
#Blade echo => {{ $user  }}	 

#Blade Foreach =>
           @foreach ($articles as $a)
					    <p> Article {{ $loop->iteration }}  </p>  <!-- {{ $loop->iteration }} is Blade equivalentof $i++ -->
                        <p>Title {{ $a->wpBlog_title }}</p>
            @endforeach
					
					
#Blade For Loop =>					
	@for ($i = 0; $i < 10; $i++)
    The current value is {{ $i }}
    @endfor
	
					
#Blade iteration 2
  @php($count=0)

  @foreach($unit->materials as $m)
    @if($m->type == "videos")
        @php($count++)
    @endif
  @endforeach

  {{$count}}
  
# Displays content without html escaping => {!! session()->get('flashMessageX') !!} 
===========================================








//================================================================================================
4.Error handling, throw custom exceptions => 
  see docs => https://code.tutsplus.com/ru/tutorials/exception-handling-in-laravel--cms-30210
  Usage => 
      use Illuminate\Support\Facades\Auth;
      if(!Auth::check()){ throw new \App\Exceptions\myException('Something Went Wrong.'); }
  
//=============================================================================================
 
 
 
 

//================================================================================================
5.Atrisan commands =>  
  create controller => php artisan make:controller FormSubmit 
 
//=============================================================================================
 
 
 
 
 
 
//================================================================================================
 
6.How to create new Controller/action, view and add to menu

   1.create controller => php artisan make:controller FormSubmit 
   2.addd route to {/routes/web.php} => Route::get('/formSubmit', 'FormSubmit@index')->name('formsubmit');  //form submit example Route
   3.create view file in {resources/views}, or firstly creeate new a folder if needed, e.g "formSumit" and file inside "form"
   4.add action to your controller =>  public function index() {return view('formSumit.form');}
   5.add url link in menu (for instance in main layout (resources\views\layouts\app.blade.php)) =>    <li class="{{ Request::is('formSubmit*') ? 'active' : '' }}">      <a href="{{ url('/formSubmit') }}"> FormSubmit  </a></li>

 
//=============================================================================================




//================================================================================================

7.Forms
  to be proccessed
  # get one input => $request->input('role_sel');
  
  #get form input => 
         use Illuminate\Support\Facades\Input;
		   var_dump(Input::get('description'));
		   dd(Input::all());
		   
 #creating custom error messages, if use {Validator::make()} in controller => 
 
  use Illuminate\Support\Facades\Validator;
  public function assignRole(Request $request){
		
    $rules = [
			'role_sel' => ['required', 'string', 'min:3', Rule::in( ['admin', 'owner'] ) ] , 
			'rDescr' => [ 'required', 'string' ] , 
			
		];
		
	//creating custom error messages. Should pass it as 3rd param in Validator::make()
	$mess = [ 'role_sel.required' => 'We need this field',];
		
	$validator = Validator::make($request->all(),$rules, $mess);
	if ($validator->fails()) {
			return redirect('/rbac')
			->withInput()
			->with('flashMessageX',"Validation Failed")
			->withErrors($validator);
	} else { return redirect('/rbac')->with('flashMessageX',"Assigned successfully " . $request->input('role_sel')); }   

# validate in range => $rules = ['role_sel' => ['required', 'string', Rule::in(['admin', 'second-zone']) ] , //integer];

//-------------------------------		   
#WHAT IS BELOW????
# Install require laravelcollective/html to be able to use {{ Form::open(array('url' => 'storeNewWpress')) }}

    composer require laravelcollective/html
    when the composer update the require html laravel collective then add these two line into config/app.php into the section of
    'aliases' => [ ],

        'Form' => Collective\Html\FormFacade::class,
        'Html' => Collective\Html\HtmlFacade::class,
    then add the line into config/app.php
    'providers' => [ ], and save the file
         Collective\Html\HtmlServiceProvider::class,

 #If LaravelCollective forms fields is cleared after failed validation:
 You need to use Input::old or you could bind a model to the form https://laravel.com/docs/4.2/html#form-model-binding
    <input type="text" class="form-control" name="title" value="{{old('title','')}}"/>
    <textarea cols="5" rows="5" class="form-control" name="description">{{old('description','')}}</textarea>
	
	+ (isNeeded????) =>if ($validator->fails()) {return redirect('/createNewWpress')->withInput()->withErrors($validator);
//================================================================================================







//================================================================================================

8.Form Validation => see example at https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/WpBlog.php   at =>  public function store(Request $request)
  # 4 ways of validation => https://laravel.demiart.ru/ways-of-laravel-validation/
  #Docs => https://laravel.ru/docs/v5/validation
  
  use Illuminate\Support\Facades\Validator;
//================================================================================================


//================================================================================================
8.1 Form input with in-line validation errors <span>, like in Yii2  => see example at https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/views/auth/login.blade.php
<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

@if ($errors->has('email'))
    <span class="help-block">
        <strong>{{ $errors->first('email') }}</strong>
    </span>
@endif
//================================================================================================





//================================================================================================

8.2 Form fields Insert to DB  => see example at https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/WpBlog.php   at =>  public function store(Request $request)
  Docs => https://www.studentstutorial.com/laravel/insert-data-laravel

//================================================================================================










//================================================================================================
9.9.Migrations/Seeders    => see docs at => https://laravel.ru/docs/v5/migrations
  see examples at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/tree/master/blog_Laravel/database/migrations
  
  Laravel SQL  equivalents => https://laravel.com/docs/4.2/schema
  
  #create migration   =>   php artisan make:migration create_users_table
  #run all migrations =>   php artisan migrate
  
  Можно также использовать параметры --table и --create для указания имени таблицы и того факта, что миграция будет создавать новую таблицу (а не изменять существующую — прим. пер.). =>
    php artisan make:migration create_wpress_blog_post_table --create=wpress_blog_post
  
 
 If migration error (Specified key was too long; max key length is 767 bytes)=> 
     SET @@global.innodb_large_prefix = 1;  => run this query before your query:, this will increase limit to 3072 bytes. SET @@global.innodb_large_prefix = 1;
  
  php artisan migrate:refresh
  
  
  //----------------------------
  
  #SEEDER
  see examples at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/database/seeds/DatabaseSeeder.php
  
  //Загрузка начальных данных в БД
  To seed all =>   php artisan db:seed   //By default, the db:seed command runs the DatabaseSeeder class, which may be used to call other seed classes
  # if u run seeder command and Seeder Class contain {DB::table('users')->delete()}, it will overwrite all data, if it doesnot, then it will add Seeder column data to existing values in DB 

  #to seed a specific class only => php artisan db:seed --class=UsersTableSeeder
  
  # If u want to place some seeder for some table in separate file in subfolder, i.e /SeedersFiles, place them there and then call them in DatabaseSeeder as ususal  (by {php artisan db:seed }) without subfolder prefix
      public function run(){
	  //call other seeders u need....
	  $this->call('ShopSimpleSeeder');  //call your subfolder without subfolder prefix
	  
  If u just created this subfolder, run {composer dump-autoload}
  
  
  #
  
  
//================================================================================================









//================================================================================================
10.hasOne/hasMany relation

10.1 hasOne relation
  1.Specify hasOne method in parent model  => 
      public function authorName(){return $this->hasOne('App\users', 'id', 'wpBlog_author')->withDefault(['name' => 'Unknown']);      //$this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');}
      //->withDefault(['name' => 'Unknown']) this prevents the crash if this author id does not exist in table User (for example after fresh install and u forget to add users to user table)

  2.Use in view =>
      @foreach ($articles as $a){ 	p>Author:   {{ $a->authorName->name   }}</p> <!--   --> 

10.2 hasMany relation
   1.Specify hasMany method in parent model  => 
     public function categoryNames(){return $this->belongsTo('App\models\wpress_category', 'wpBlog_category','wpCategory_id');  //return $this->belongsTo('App\modelName', 'parent_id_this_table', 'foreign_key_that_table');}
   2.Use in view =>
      <p>Category: {{ $a->categoryNames ->wpCategory_name }}</p> <!-- hasMany relations to show categoty name -->
//================================================================================================






//================================================================================================
11.DB SQL Eloquent queries
  #For Eloquent ORM:
    $articles = wpress_blog_post::all();
    $articles =  wpress_blog_post::where('wpBlog_status', '1')->get();
	$articles = wpress_blog_post::where('wpBlog_status', '1')->where('wpBlog_category', 1)->get();
    
	$user = User::where('username', '=', 'michele')->first();
	$roles = Role::select('role','surname')->where('id', 1)->get(); //select columns
	
	wpress_blog_post::where('wpBlog_id',$id)->delete(); //Delete
	
	$model = App\Flight::findOrFail(1); $model = App\Flight::where('legs', '>', 100)->firstOrFail();
       findOrFail() is alike of find() function with one extra ability - to throws the Not Found Exceptions. So use it instead of checking if record exists (as u like it to do )
	
	$articles->count()
  
  #Метод get() возвращает объект Illuminate\Support\Collection (для версии 5.2 и ранее — массив) c результатами, в котором каждый результат — это экземпляр PHP-объекта StdClass.
  use Illuminate\Support\Facades\DB;  $users = $articles = DB::table('wpress_blog_post')->get();
  use Illuminate\Support\Facades\DB; $articles = DB::table('wpress_blog_post')->where('wpBlog_status', '1')->get();

  //check if record exists, if not custom exception, traditional way like followingdoes not work =>  $articleOne = wpress_blog_post::where('wpBlog_id',$id)->get(); if ($articleOne){exception}
       try{
	      $articleOne = wpress_blog_post::where('wpBlog_id',$id)->firstOrFail(); //find the article by id  ->firstOrFail();
	   } catch (\Exception $e) {
	      throw new \App\Exceptions\myException('Article does not exist');
	   }
	//check if record exists-2    
	$roleAdmin =  self::where('name', 'admin')->get();
    if (!$roleAdmin){ }
	
	//check if record exists-3. Returns boolean. The best!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	if( Role_User::where('user_id', intval($request->input('user_id')))->where('role_id', intval($request->input('role_sel')) )->exists()) { 


   #Eloquent object to arry ->  $articleOne = wpress_blog_post::where('wpBlog_id',$id)->get(); $articleOne->toArray(); 
	
   #Eloquent search based on multiple ID's =>  
      $models = Model::find([1, 2, 3]); OR $models = Model::findMany([1, 2, 3]); //if in SQL Table column is called {id}
	  $models = Model::whereIn('shop_id', [1, 2, 3])->get(); ////if in SQL Table column is called other than {id}
   
   #find one user 
   in Controller => 
      $articleOne = wpress_blog_post::where('wpBlog_id',$id)->get();
      $articleOne[0]->wpBlog_author; // $articleOne>wpBlog_author;  DOES NOT WORK (<= NOT TRUE???)
	  
	# Pagination => 
	   Controller =>   $articles = wpress_blog_post::where('wpBlog_status', '1')->paginate(3); //$allDBProducts = ShopSimple::paginate(4);
	   View =>      {{ $articles->links() }}
//================================================================================================







//================================================================================================
12.Laravel Crud => see docs at https://appdividend.com/2017/10/15/laravel-5-5-crud-example-tutorial/

//================================================================================================






//================================================================================================
13.REST API => see docs at  https://developernotes.ru/laravel-5/rest-restful-api
   Endpoints:
    #routes for REST must be specifies in {routes/api.php} not {routes/web.php}
      get all articles from Db table {wpress_blog_post}  => /GET http://localhost/laravel+Yii2_widgets/blog_Laravel/public/api/articles
      get one article  from Db table {wpress_blog_post}  => /GET http://localhost/laravel+Yii2_widgets/blog_Laravel/public/api/articles/8
	  
	#If u mistakenly put routes in {routes/web.php}, REST Api endpoints will be => 
            http://localhost/laravel+Yii2_widgets/blog_Laravel/public/articles     http://localhost/laravel+Yii2_widgets/blog_Laravel/public/articles/8
	  
	
//================================================================================================





//================================================================================================

13.1  Has Many relation in JSON (REST API)

1. In model (REST model) add relation:

     public function authorName() //hasOne
       {return $this->hasOne('App\users', 'id', 'wpBlog_author');      //$this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');}
    
	public function categoryNames(){ //hasMany
    return $this->belongsTo('App\models\wpress_category', 'wpBlog_category','wpCategory_id');  //return $this->belongsTo('App\modelName', 'parent_id_this_table', 'foreign_key_that_table');}
	  
2. In controller:
    public function show($id)
        return WpressRest::with('authorName', 'categoryNames')->where('wpBlog_id', $id)->get(); //return WpressRest::with('authorName')->where('wpBlog_id', $id)->get();

3. Read in JS ajax success (while DB field name is {wpBlog_author}), author_name is model hasOne function, {name} is DB field)
     data[i].author_name.name 
	 
	 
#to exclude PASSWORD from returning JSON add to XXX->select(array('id', 'name')) otherwise it returns all fields from table {user}. protected $hidden = ['created_at', 'password']; works for non-relational fields
    return $this->hasOne('App\users', 'id', 'wpBlog_author')->select(array('id', 'name')); 
	
//================================================================================================








//================================================================================================
14. Laravel Flash messages
   In conroller=>
      return redirect('/createNewWpress')->with('success', 'New support ticket has been created! Wait sometime to get resolved');

		
  In view =>		
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
//================================================================================================









//================================================================================================
15. Js/Css, minify, Laravel Mix
   File => /webpack.mix.js
   Works so muck like Browserify + Gulp.......
    All Development css/js (js/css u're changing) are located in /resources/assets/. They are not included to index.php (\resources\views\layouts). 
	Included css/js are in /public. To convert Development assets to Production(to minify, concatenate), run => npm run production
    Запустить все задачи Mix и минифицировать вывод => go to cmd => npm run production 
   
   if error {"cross-env" не является внутренней или внешней командой}  =>   npm i cross-env --save
   if error {"Node events.js:167 throw er; // Unhandled 'error' event"} =>  Removing the node_modules directory and reinstalling again using npm install should solve the problem.

   
   # npm run watch     
   If is doesnot watch => npm run watch-poll
   If u run {npm run watch}, after any css/js change it rebuilds files in /public (even if they were prev minified), but does not minify them, so in the end run {npm run production} to do that.
   
   Alternative:
   can make all css/js edits in /public. When it comes to production< copy all css/js from /public to /resources/assets/, run {npm run production} and get in public all concatenated files
   


------------------------------------------------------
 #Loading CSS and JS files on specific views in Laravel 5.2

  Variant 1 (most working)(use/include in main layout, i.e /views/layout/blade.php)!!! =>
    <!-- To register JS/CSS file for specific view only (In layout template) -->
    @if (in_array(Route::getFacadeRoot()->current()->uri(), ['testRest', 'register']))
        <script src="{{ asset('js/test-rest/test-rest.js') }}"></script>
		<link href="{{ asset('css/rbac/rbac.css') }}" rel="stylesheet">
    @endif	
	
	Variant 2 (working) (use/include in any child view before {@endsection}, i.e /views/auth/login). OR right after @section('content') (if u don't want to encounter div loads for 1 sec without css styling) =>
	    <!-- Include js/css file for this view only -->
        <script src="{{ asset('js/ShopPaypalSimple/shopSimple.js')}}"></script>
        <link href="{{ asset('css/ShopPaypalSimple/shopSimple.css') }}" rel="stylesheet">
        @endsection	


//================================================================================================











//================================================================================================
16. CRUD
 16.1 Delete => see example at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/WpBlog.php   =>  public function destroy($id) 
 #Delete with confirm
  <a href = 'delete/{{ $a->wpBlog_id }}'> Delete  <img class="deletee" onclick="return confirm('Are you sure?')" src="{{URL::to("/")}}/images/delete.png"  alt="del"/></a>

  
  16.2 Update 
	   wpress_blog_post::where('wpBlog_id', $id)->update([  'wpBlog_text' => $data['description'], 'wpBlog_title' => $data['title'], 'wpBlog_category' => $data['category_sel'] ]);

//================================================================================================










//================================================================================================

17. RBAC 
https://github.com/Zizaco/entrust

#Entrust creates 4 tables in DB: permission_role, permissions, role_user, roles
#Mega Error "Cannot declare class App\Role, because the name is already in use" was caused by wrong namespace in /config/entrust.php
#NB!!!: By documantion, they suggest using {namespace App\models;} for models/Role.php but in /config/entrust.php they specified as App\Roles.php

#MEGA ERROR FIX (when Entrust hasRole() always returned false)=> in /config/entrust.php (that is generated by {php artisan vendor:publish}),
 while changing/adopting sections {Entrust Permission Model}, {Entrust Role Model} to my namespace (changing {'permission' => 'App\Permission'} to {'permission'  => 'App\models\Permission'}),
 accidentally changed as 'ROLE' {'role'  => 'App\models\Permission'}

--------------

# Usage=>
#In controller =>
  use Illuminate\Support\Facades\Auth;
  if(!Auth::user()->hasRole('admin')){ throw new \App\Exceptions\myException('You have No rbac rights'); }
		
#In view =>		
@if(\Auth::user()->hasRole('admin'))
    <div class="panel panel-success">SOME TEXT FOR ADMIN</div>
							
@else
	<div class="panel panel-danger">YOU ARE NOT AUTHORIZED</div>                           
@endif

--------

# How to extend roles => there's no built-in Entrust Rbac solution, so a hand-mande one =>
 if u want role 'admin' to be able to reach content of role 'manager' or any other, do always include 'admin' in hasRole() funcntion, when u check 'manager' role  =>
    $user->hasRole(['manager', 'admin']);   

# Detach/remove role from user (not in Entrusr readme) => $userModel = User::find(1); $userModel->detachRoles($role);

# How make Self-made Rbac  => https://laravel.demiart.ru/guide-to-roles-and-permissions/
//================================================================================================







//================================================================================================
18. Multilanguges (Localization). See example at => 
use Illuminate\Support\Facades\App;

#Store language translations in  folder /resources/lang => en/ru/dk....

#Change language with => App::setLocale('ua');

#Use In view =>
{{ trans('message.welcome') }} OR @lang('message.welcome')
//================================================================================================







//================================================================================================
19. Cookie. See example at => 
#Set cookie =>
   use Cookie; Cookie::queue('language', $lang, 9999); //working!!!!

#Get cookie =>   
   $lang = Cookie::get('language');

//================================================================================================






//================================================================================================
20. How to create Helper
To create Hepler function you can reuse in many places:
1. create helper class in folders path {App\Http\MyHelpers\Rbac\Helper_Rbac.php} according to namespace
    namespace App\Http\MyHelpers\Rbac;
        class Helper_Rbac
     {
      public static function stringMakeUpperCase(string $string){} }
	  
2. Call in view => {!! \App\Http\MyHelpers\Rbac\Helper_Rbac::stringMakeUpperCase('this is how to use autoloading correctly!!') !!}

//================================================================================================







//================================================================================================
21. Login with username instead of email => see docs => https://www.tutsplanet.com/laravel-auth-login-with-username-instead-of-email/

1. In View (\resources\views\auth\login.blade.php) change email input to name input (or username etc) => see example at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/views/auth/login.blade.php
2. In Controller (\app\Http\Controllers\Auth\LoginController) add function username() to overrude parrent method. Don't change the function name, regadless what u want to return, i.e "email, name, username" 
    public function username(){
	   return 'name'; //or return the DB  field which you want to use, i.e "email, name, username"
    }
//================================================================================================






//================================================================================================
22. Laravel production
1. Apply changes to .env file: => APP_ENV=production; APP_DEBUG=false;
2. Make sure that you are optimizing Composer's class autoloader map (docs):
  composer dump-autoload --optimize
  or along install: composer install --optimize-autoloader --no-dev
  or during update: composer update --optimize-autoloader

3. Optimizing Configuration Loading: => php artisan config:cache
4. Optimizing Route Loading => php artisan route:cache
5. Compile all of the application's Blade templates: => php artisan view:cache
6.Cache the framework bootstrap files:  =>  php artisan optimize
7.(Optional) Compiling assets (docs): => npm run production
8.(Optional) Generate the encryption keys Laravel Passport needs (docs):  => php artisan passport:keys
9.(Optional) Start Laravel task scheduler by adding the following Cron entry (docs): => * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
10.(Optional) Install, config and start the Supervisor (docs):
11. (Optional) Create a symbolic link from public/storage to storage/app/public (docs): => php artisan storage:link
//================================================================================================






//================================================================================================ 
34.Highlight active menu item
 #Highlight active menu item =>  (OR https://medium.com/@rizkhallamaau/create-a-helper-for-active-link-in-laravel-5-6-30827a760593)
     <li class="{{ Request::is('showProfile*') ? 'active' : '' }}">     <a href="{{ url('/showProfile') }}">ShowProfile    </a> </li>
	 <li class="{{ Request::is('EloquentExample*') ? 'active' : '' }}"> <a href="{{ url('/EloquentExample') }}">DB Eloquent </a></li>


	 
	 
	 
	 
//================================================================================================ 
35.Miscellaneous VA Laravel
# bootstrap => <div class="col-lg-3 col-md-3 col-sm-4">  <div class="col-sm-4 col-xs-4"> => Pc/mobile
    .xs (phones), .sm (tablets), .md (desktops), and .lg (larger desktops) 
    .col- (extra small devices - screen width less than 576px)
	.col-sm- (small devices - screen width equal to or greater than 576px)
    .col-md- (medium devices - screen width equal to or greater than 768px)
    .col-lg- (large devices - screen width equal to or greater than 992px)
    .col-xl- (xlarge devices - screen width equal to or greater than 1200px)
	
#image =>           <img class="img-responsive my-cph" src="{{URL::to("/")}}/images/cph.jpg"  alt="a"/>
#link a href => 	<li><a href="{{ route('register') }}">Gii</a></li>
#link a href with $_GET => <a href="{{route('profile', ['id' => 1])}}">login here</a>
#link with helper => $post = App\Models\Post::find(1);  echo url("/posts/{$post->id}");

# Render Controller/View (Active Record / Eloquent) => 
   in Controller=>     
       var 1: use App\users; $f = users::all();        return view('home2', compact('f'));  
	   var 2: use Illuminate\Support\Facades\View;     return View::make('rbac.rbacView')->with(compact('rbacStatus', 'status', 'userX'));
       var 3:                                          return View::make('page')->with('userInfo',$userInfo);
   
   in View =>          foreach ($f as $a){
   
   
	  
#pass several vars => return view('showprofile')->with(compact('id', 'name'));
	  
#isGuest var 1 => use Illuminate\Support\Facades\Auth; if(!Auth::check()){)
#isGuest var 2  =>   public function __construct(){$this->middleware('auth');}

#check if user is not guest =>  use Illuminate\Support\Facades\Auth; if (Auth::check()) {} => if (Auth::guest()
#ACF Yii2 equivalent, let only logged users, use in Controller =>   public function __construct(){$this->middleware('auth');}


#current user => use Illuminate\Support\Facades\Auth; $user = auth()->user();  $id = auth()->user()->id; 


# Turn on debugger => go to .env => APP_DEBUG=true

# js confirm to delete =>  
     <button><a href = 'delete/{{ $a->wpBlog_id }}'> Delete  <img class="deletee" onclick="return confirm('Are you sure to delete?')" src="{{URL::to("/")}}/images/delete.png"  alt="del"/></a></button>
     <button onclick="return confirm('Are you sure to delete?')" type="submit" class="btn">
	 
#Redirect=>
  return redirect()->back()->with('success',"Update successfully");
  return redirect()->back()->withInput()->withErrors($validator);
  return redirect('/wpBlogg')->with('flashMessage',"Record deleted successfully");


# Get current route path (returns part after last slash, i.e "testRest")
  use Illuminate\Support\Facades\Route;
  $currentPath= Route::getFacadeRoot()->current()->uri();


#routing =>
In route/web => Route::get('/multilanguage', 'MultiLanguage@index')->name('multilanguage'); 
In View => <li class="{{ Request::is('multilanguage*') ? 'active' : '' }}"> <a href="{{ route('multilanguage') }}">MultiLanguage</a></li>

#routing with $_GET['id']=>
When u use url like  => /showOneUser/3
In route/web => Route::get('/showOneUser/{id}', 'AllUsersEloquent@showOne')->name('showOneUser');
In controller => function showOne($id){}


# ternary =>
$articles = ($yourArticles->count() > 1) ? 'articles' : 'article';
In Blade (in-line) => <p> You have <b> {{$yourArticles->count()}} </b>  {{($yourArticles->count() > 1) ? 'articles' : 'article'}} </p>
                      <p> You have <b> {{$yourArticles->count()}} </b>  {{($yourArticles->count() > 1 || $yourArticles->count() == 0 ) ? 'articles' : 'article'}} </p>

# pass php var to js =>
Pass var from controller to view =>  return view('home2', compact('user')); 
  <script>
    var user = {!! $user->toJson() !!};
  </script>
  
# clear cache/reconfig =>  php artisan config:cache <==> php artisan cache:clear 

composer dump-autoload

# Exception with html unescapped tags=>
  In controller=> $text = 'You are not logged, <a href="'. route('login') . '"> click here  </a>  to login'; throw new \App\Exceptions\myException( $text );
  In View =>  Details: <b>{!! $exception->getMessage() !!}</b>
  
  
# get Date(2020-11-07 16:21:49) => date('Y-m-d H:i:s');

# Logging(logs go to /storage/logs/laravel.log) => use Illuminate\Support\Facades\Log;   Log::info('Showing user profile for user: '. $id . ' User IP is ' . $_SERVER['REMOTE_ADDR']);  
 
# Render partial =>  @include('ShopPaypalSimple.partial.dropdown', ['categ' => $allCategories])  => (will include the view at 'views/ShopPaypalSimple/partial/dropdown.blade.php'

# To prevent users entering get url for post method, i.e if user enter /checkOut manually in browser (use in routes/web.php) =>
        Route::get('/checkOut', function () { throw new \App\Exceptions\myException('Bad request. Not POST request, You are not expected to enter this page.'); });  
  









//================================================================================================
35.2.Miscellaneous VA HTML/CSS
# Line => <hr>

#Panel Styling =>
<div class="panel panel-default">
    <div class="panel-heading">text</div>
	<div class="panel-heading">text</div>
</div>










//================================================================================================
35.3 Miscellaneous to move to Yii2 ReadMe
//================================Move to Yii2 ReadMe =============================

---------------------- PHP ----------

# Array search examples (move it to Yii)
$listOfLanguages = array(
	"English" => array("langName" => "en", "langFlagImg" => "en-US.svg"),
	"Dansk"   => array("langName" => "dk", "langFlagImg" => "dk-DK.svg") );
	
# To find "English" in for{} loop ???
   $key = array_search ($a, $listOfLanguages); //e.g returns "English"
   {array_search} returns the index of value, e.g => $array = array(0 => 'blue', 1 => 'red'); $key = array_search('red', $array);    // $key = 1;
   
# To find "langFlagImg" value in array $listOfLanguages if you know that "langName" value is "dk" 
  $found = array_search($lang, array_column($listOfLanguages, 'langName')); //returns 3
  $keys = array_keys($listOfLanguages);
  $imageX = $listOfLanguages[$keys[$found]]['langFlagImg'];

# END  Array search (Move it to Yii)

#Benchmark => $startSec = time(); //seconds   $startMicroSec = microtime(true); //microseconds   $bench = $endSec - $startSec;

# Array push/add => array_push($array, "blue", "yellow");

---------------------- JS ----------

//Check if <select> is selected (not empty) (when multiple forms are generated in loop )=> 
$(document).on("click", '.sbmBtn', function() {   // this  click  is  used  to   react  to  newly generated cicles;
    if($(this).closest("form").find(":selected").val() == "select"){

# JS JQ selectors, use .parent() to go 1 level up, see example => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/public/js/rbac/my-rbac.js or at /resources/assets/
	var selectedText = $(this).closest("form").find(":selected").text();  //gets text of selected <select>, i.e 'manager'. If u use .val() instead of text(), u'll ger value, i.e 14
	var userRolesText = $(this).parent().parent().parent().find( $(".user-roles-list" )).html();  //gets the <td> text with user roles, i.e "owner, manager"

# JS JQ selectors var.2 (find 1st input) => var numProduct = Number($(this).closest('div').next().find('input:eq(0)').val()); see=> https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/public/js/ShopPaypalSimple/shopSimple.js or at /resources/assets/		   

# get value of <select> => $( "#myselect" ).val(); // i.e 13
# get text  of <select> => $( "#myselect option:selected" ).text(); // i.e 'manager'

# remove html tags from var userRolesText
    var regexHTMLTags = /(<([^>]+)>)/ig; //regExp for html tags
    var result = userRolesText.replace(regexHTMLTags, "");

# test/check if someString contains word 'e'
 if( new RegExp('text').test(someString) ){ 
 
# Sweet alerts with html tags => see example at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/public/js/rbac/my-rbac.js or at /resources/assets/		       
swal({html:true, title:'Attention!', text:'User has already selected role <b> ' + selectedRoleText + ' </b>.</br>  Back-end validation is also available.', type: 'error'});

# Prevent and send form with Sweet alerts confirm dialogue => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/public/js/rbac/my-rbac.js  or if it was Gulp Webpacked =>  at /resources/assets/

#//How to Toggle Password Visibility =>  https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/public/js/login/login.js  or if it was Gulp Webpacked =>  at /resources/assets/

# To show Bootstrap modal window by default => add class "in show" => div class="modal fade in show"

# Use {toFixed(2)} to return 33.00 not 33.0008 =>  $(this).parent().next().html((numProduct*price).toFixed(2)); 

//================================ End Move to Yii2 ReadMe =============================

//================================================================================================















//================================================================================================
36. Known Errors

# Error "Unknown Column 'updated_at' => public $timestamps = false; //put in model to override Error "Unknown Column 'updated_at'" that fires when saving new entry

# Error "Specified key was too long; max key length is 767 bytes" => see 9.Migrations/Seeders

# Error "TokenMismatchException" while form submitting => 
   change 	<input type="hidden" value="{{ csrf_token() }}" name="_token{{$loop->iteration}} " /> to   {!! csrf_field() !!}

# Error after install & migrate new Laravel 
"The only supported ciphers are AES-128-CBC and AES-256-CBC with the correct key lengths. laravel 5.3

You need to have .env on your appication folder then run: => $ php artisan key:generate
If you don't have .env copy from .env.example: =>   $ cp .env.example .env

# If can not type in form input => add to form CSS rule {z-index: 9999;}

# Error "Can't redeclare class" => check namespace (like it was with Enrtrust Role model), see details at => 17. RBAC 

# Error "Call to a member function hasRole() on null" => in my case happened, when being unlogged refered to {$user = auth()->user();}  and tried to use {if ($user->hasRole('admin'))}

# Error  "This cache store does not support tagging" => happens due Entrusr Rbac,  in .env file change {CACHE_DRIVER=file} to {CACHE_DRIVER=array}

# Error, when generating multiple <form> in foreach loop. the first form was never submitted, all the rest form were submitted OK (example in RBAC table Delete Form and Assihn new role Form).
  The solution => before 1st form add empty <form></form>

# CSS error if Bootstrap modal appearing under background =>  .modal-backdrop { z-index: -1;}
=============================

если токен не принимается обработчиком, то варианта существует по сути два – либо он не отправляется в запросе (отсутствует csrf_field() в форме, или нет нужного значения в аякс-запросе – там он может передаваться как в данных так и в заголовках запроса), либо на стороне сервера не загружается сессия – именно в ней сохраняется токен на стороне сервера, чтобы было с чем сравнить то что пришло в запросе.

диагностировать можно соответственно

а) через закладку Network в Dev Tools: проверить что сессия стартует при открытии страницы с формой вообще – сервер должен прислать Set-Cookie с кукой laravel_session (название по умолчанию, может быть изменено)
б) проверяем форму – открываем структуру документа и проверяем что там где был вызов csrf_field теперь красуется input type hidden с именем _token
в) при сабмите формы смотрим заголовки на закладке Network: у запроса должен быть заголовок Cookies содержащий правильное значение laravel_session, в данных формы должен отправляться _token. если запрос делается аяксом, токен может передаваться как обычно, а может – заголовком запроса X-CSRF-Token.

если всё на месте, значит фронтенд отрабатывает корректно. теперь смотрим бэкенд

а) сессии должны корректно сохраняться и восстанавливаться. за выбор способа работы с сессиями отвечает SESSION_DRIVER в .env а конкретные настройки лежат в config/session.php. по умолчанию стоит file – проверяем права доступа к storage/framework/sessions. если драйвер database – должна быть создана таблица сессий и настроено подключение к базе. для memcached и redis должны быть запущены и настроен доступ к соответствующим демонам. драйвера null и array не поддерживают сохранение данных никуда вообще – с ними CSRF-проверка работать не будет в любом случае. драйвер cookie не требует настроек так как передаёт все данные сразу в куках в шифрованном виде – неэффективно но просто и для того чтобы быстро что-то потестировать вполне подходит
б) если сессии настроены и работают – проверяем что сессия реально сохраняется и восстанавливается при запросах, за это отвечает миддлварь Illuminate\Session\Middleware\StartSession которая входит в группу миддлварей web. в версии 5.3 эта группа применена на маршрутах заданных в routes/web.php. в более ранних версиях оно задаётся явно в app\Http\routes.php с помощью группы Route::group(['middleware' => ['web']], function () { /* ... */ }); маршруты, которым не назначена группа web или явно миддлварь StartSession не получают сессии и соответственно не могут прочитать сохранённый токен
в) если сессии настроены, миддлвари прикреплены к маршрутам, где отображается и куда сабмитится форма, а токен всё равно нет тот – остаётся только установить xdebug и погулять по коду, проверяя где токены создаются и сравниваются, потому что на этом месте у меня закончилась фантазия как ещё можно сломать простой и надёжный как валенок механизм работы с CSRF-токенами smile