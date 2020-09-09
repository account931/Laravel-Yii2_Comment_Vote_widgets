Credentials: admin@gmail.com =>  dimax2

Table of Content:
1.How to intsll Laravel
2.
3. Blade

//================================================
1.How to intsll Laravel
http://laravel.su/docs/5.4/installation

1. If first time ever, install global installer=>  composer global require "laravel/installer"
2. Navigate to necessary folder and =>    laravel new yourProjectName
3. To add authentication (login/register) =>
       CLI=> php artisan make:auth

Эту команду надо использовать на свежем приложении, она установит шаблоны для регистрации и входа, а также роуты для всех конечных точек аутентификации. Также будет сгенерирован HomeController, который обслуживает запросы к панели настроек вашего приложения после входа. Но вы можете изменить или даже удалить это контроллер, если это необходимо для вашего приложения.


https://developernotes.ru/laravel-5/modeli-i-baza-dannih-v-laravel-5
#Controllers => php artisan make:controller ShowProfile     location => \app\Http\Controllers
#Models => php artisan make:model tableName                   location => \app\Http
#Views location => resources\views
#Common Layout => resources\views\layouts\app.blade.php


#create migration   =>   php artisan make:migration create_users_table
#run all migrations =>   php artisan migrate

#check if user is not guest =>  use Illuminate\Support\Facades\Auth; if (Auth::check()) {} => if (Auth::guest()


#ACF Yii2 equivalent, let only logged users, use in Controller =>   public function __construct(){$this->middleware('auth');}





//============================================	
3. Blade	
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
	 
#Blade ecjo => {{ $user  }}	 
===========================================




#Active Record / Eloquent => 
   in Controller=>     use App\users; $f = users::all(); return view('home2', compact('f')); 
   in View =>          foreach ($f as $a){
   
   
 #render =>  
      return view('home2', compact('f'));  === return View::make('page')->with('userInfo',$userInfo);
	  
#pass several vars => return view('showprofile')->with(compact('id', 'name'));
	  
 #isGuest => if(!Auth::check()){