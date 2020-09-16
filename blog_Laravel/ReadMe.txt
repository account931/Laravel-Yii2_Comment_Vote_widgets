Laravel Framework 5.4.36
Credentials: dimmm931@gmail.com =>  dimax2
Composer -> via Windows cmd, artisan -> via OpenServer, git -> via Windows cmd

Table of Content:
1.How to install Laravel
2.
3. Blade
4.Error handling, throw custom exceptions 
5.Atrisan commands
6.How to create new Controller/action, view and add to menu
7.Forms
8.Form Validation
9.Migrations
10.hasOne/hasMany relation
11.DB SQL queries

34.Highlight active menu item
35.Miscellaneous VA Laravel


//================================================
1.How to inst
http://laravel.su/docs/5.4/installation

1. If first time ever, install global installer=>  composer global require "laravel/installer"
2. Navigate to necessary folder and =>    laravel new yourProjectName
3. To add authentication (login/register) =>
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

#check if user is not guest =>  use Illuminate\Support\Facades\Auth; if (Auth::check()) {} => if (Auth::guest()


#ACF Yii2 equivalent, let only logged users, use in Controller =>   public function __construct(){$this->middleware('auth');}





//============================================	
3. Blade
 A blade {{}} is just the equilivant of <?php echo() ?>
#simple example => Hello, {{ $name }}	
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
					
#Blade iteration 2
  @php($count=0)

  @foreach($unit->materials as $m)
    @if($m->type == "videos")
        @php($count++)
    @endif
  @endforeach

  {{$count}}
===========================================




#Active Record / Eloquent => 
   in Controller=>     use App\users; $f = users::all(); return view('home2', compact('f')); 
   in View =>          foreach ($f as $a){
   
   
 #render =>  
      return view('home2', compact('f'));  === return View::make('page')->with('userInfo',$userInfo);
	  
#pass several vars => return view('showprofile')->with(compact('id', 'name'));
	  
#isGuest => if(!Auth::check()){)

#current user => use Illuminate\Support\Facades\Auth;  $id = auth()->user()->id;


# Turn on debugger => go to .env => APP_DEBUG=true




//================================================================================================
4.Error handling, throw custom exceptions => 
  see docs => https://code.tutsplus.com/ru/tutorials/exception-handling-in-laravel--cms-30210
  Usage => if(!Auth::check()){ throw new \App\Exceptions\myException('Something Went Wrong.'); }
  
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

//================================================================================================







//================================================================================================

8.Form Validation

https://laravel.ru/docs/v5/validation
  to be proccessed

//================================================================================================













//================================================================================================
9.Migrations => see docs at => https://laravel.ru/docs/v5/migrations
  #create migration   =>   php artisan make:migration create_users_table
  #run all migrations =>   php artisan migrate
  
  Можно также использовать параметры --table и --create для указания имени таблицы и того факта, что миграция будет создавать новую таблицу (а не изменять существующую — прим. пер.). =>
    php artisan make:migration create_wpress_blog_post_table --create=wpress_blog_post
  
 
 If migration error (Specified key was too long; max key length is 767 bytes)=> 
     SET @@global.innodb_large_prefix = 1;  => run this query before your query:, this will increase limit to 3072 bytes. SET @@global.innodb_large_prefix = 1;
  
  php artisan migrate:refresh
  
  #SEEDER
  //Загрузка начальных данных в БД
  Для добавления данных в БД используйте Artisan-команду => php artisan db:seed

//================================================================================================









//================================================================================================
10.hasOne/hasMany relation

10.1 hasOne relation
  1.Specify hasOne method in parent model  => 
      public function authorName(){return $this->hasOne('App\users', 'id', 'wpBlog_author');      //$this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');}
  2.Use in view =>
      @foreach ($articles as $a){ 	p>Author:   {{ $a->authorName->name   }}</p> <!--   --> 

10.2 hasMany relation
   1.Specify hasMany method in parent model  => 
     public function categoryNames(){return $this->belongsTo('App\models\wpress_category', 'wpBlog_category','wpCategory_id');  //return $this->belongsTo('App\modelName', 'parent_id_this_table', 'foreign_key_that_table');}
   2.Use in view =>
      <p>Category: {{ $a->categoryNames ->wpCategory_name }}</p> <!-- hasMany relations to show categoty name -->
//================================================================================================






//================================================================================================
11.DB SQL queries
  #For Eloquent ORM:
    $articles = wpress_blog_post::all();
    $articles =  wpress_blog_post::where('wpBlog_status', '1')->get();
	$articles = wpress_blog_post::where('wpBlog_status', '1')->where('wpBlog_category', 1)->get();

	$articles->count()
  
  #Метод get() возвращает объект Illuminate\Support\Collection (для версии 5.2 и ранее — массив) c результатами, в котором каждый результат — это экземпляр PHP-объекта StdClass.
  use Illuminate\Support\Facades\DB;  $users = $articles = DB::table('wpress_blog_post')->get();
  use Illuminate\Support\Facades\DB; $articles = DB::table('wpress_blog_post')->where('wpBlog_status', '1')->get();


//================================================================================================


//================================================================================================ 
34.Highlight active menu item
 #Highlight active menu item =>  (OR https://medium.com/@rizkhallamaau/create-a-helper-for-active-link-in-laravel-5-6-30827a760593)
     <li class="{{ Request::is('showProfile*') ? 'active' : '' }}">     <a href="{{ url('/showProfile') }}">ShowProfile    </a> </li>
	 <li class="{{ Request::is('EloquentExample*') ? 'active' : '' }}"> <a href="{{ url('/EloquentExample') }}">DB Eloquent </a></li>


	 
	 
	 
	 
//================================================================================================ 
35.Miscellaneous VA Laravel
#image =>           <img class="img-responsive my-cph" src="{{URL::to("/")}}/images/cph.jpg"  alt="a"/>
#link a href => 	<li><a href="{{ route('register') }}">Gii</a></li>
