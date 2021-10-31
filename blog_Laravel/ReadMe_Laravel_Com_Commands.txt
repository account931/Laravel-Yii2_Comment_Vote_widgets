Laravel Framework 5.4.36 Release (January 24th, 2017), Security Fixes Until (January 24th, 2018)
OpenServer 5.2.2 Php 7.2 Node-v13.14.0-x86.msi
Credentials: dimmm931@gmail.com =>  dimax2
PhpMyAdmin => http://localhost/openserver/phpmyadmin/


NB: CHECK WPRESS MIGRATION (SETTING TIMESTAMP BY DEFAULT) (as varinat add to migration $table->timestamps(); but column name will change)!!!!!!!!!!!!!!!!!!!!!!! 

On HP EliteBook 2530p: Composer -> via Windows cmd, artisan -> via OpenServer (navigate to your project folder first with cd ), 
        git -> via Windows cmd, NPM -> via Windows cmd

On T42: so far the same, but Composer -> via Openserver (if troubles => go to folder, LMClick -> "Git Bash here"), NPM -> via Windows cmd



Table of Content:
1.How to install Laravel
1.1 How to copy/clone existing Laravel project and run
2.
3. Blade
4.Error handling, throw custom exceptions 
5.Atrisan commands
6.How to create new Controller/action, view and add to menu
7.Forms validation via Controller
8.Form Validation (General info)
8.1.1 Form Validation via Request Class
8.1.2 Custom Form Validation via Model(like in Yii2)
8.1.2 Image Upload and validation (regular form)
8.1.3 Image Upload and validation via ajax (Formdata)

8.1 Form input with in-line validation errors <span>, like in Yii2 
8.2 Form fields Insert to DB
9.Migrations/Seeders
10.hasOne/hasMany relation
11.DB SQL Eloquent queries
11.1 DB SQL Eloquent queries optimization
12.Laravel CRUD
12.24. Save to DB (SQL INSERT) via model function
13.REST API
13.1 Has Many relation in JSON (REST API)
13.2   REST API authentication via token (Token Bearer, String Query)
13.2.1 REST API authentication via Passport package
13.3 REST ajax server validation (& display errors in ajax)
13.4 REST API CRUD
14. Laravel Flash messages
15. Js/Css, minify, Laravel Mix
16. 
17.  RBAC on Zizaco/Entrust
17.1 RBAC on Spatie Laravel Permission.
17.2 Gates (variant of built-in Laravel RBAC)
17.3 Policy in Laravel
18. Multilanguges (Localization)
19. Cookie.
20. How to create Helper
21. Login with username instead of email
22. Laravel production
23. After Login redirect to previous page
23.2 After Registration redirect to previous page 
24.
25. Laravel Vue
25.1.1.1 Vue standalone (without Laravel)
25.9 React ReadMe
26. PayPal
27. CLI command => call controller via command line
28. PhpUnit tests vs Laravel Dusk
29. Events/Listeners
34.Highlight active menu item
35. Middleware
35.1 Middleware (CORS example)
36.	Socialite
37. Liqpay & Paypal

201. Laravel 6 LTS        => (IMPLEMENTED IN {abz_Laravel_6_LTS})
202. Yajra DataTables     => (IMPLEMENTED IN {abz_Laravel_6_LTS})
203. Yajra Datatables with CRUD. How it works => (IMPLEMENTED IN {abz_Laravel_6_LTS})
204. Admin LTE
205. Laravel Intervention => (IMPLEMENTED IN {abz_Laravel_6_LTS})
206. Laravel Voyager      => (IMPLEMENTED IN {abz_Laravel_6_LTS})
207. Laravel Gii Crud Generators 

355.Miscellaneous VA Laravel
356.Miscellaneous VA HTML/CSS
357.Miscellaneous Php (to move to Yii2 ReadMe)
357.1 Miscellaneous Untitled (Git, etc)
357.2 Miscellaneous JS 
358.Known Errors
400.SOLID principles
401.Design Patterns
402.Used Laravel Packages


//================================================
1.How to install Laravel
http://laravel.su/docs/5.4/installation

1. If first time ever, install global installer=>  composer global require "laravel/installer"
2. Navigate to necessary folder and =>    laravel new yourProjectName   Var2 => composer create-project laravel/laravel  Var3 => composer create-project --prefer-dist laravel/laravel blog "6.*"
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

 #composer install vs composer update
 
 composer install => check if exists {composer.lock}, if true install versions from {composer.lock}
 composer update  => check {composer.json}, install versions from {composer.json} and rewrite {composer.lock}
 
 #if change "composer.json" => use {composer update}



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
  
   Create your custom exception Class =>
     1. Create your custom exception Class, see example => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Exceptions/myException.php
         You don't need to implement {public function report()} in your custom exception class, as it will log any errors anyway(including when your custom exception fires) to storage/laravel.log. Due to {class myException extends Exception}
	 2. Add to App\Exceptions\Handler.php to public function render() to render your custom exception view =>
	        if ($exception instanceof \App\Exceptions\myException)  {
                return $exception->render($request); }
  
   Usage => 
      use Illuminate\Support\Facades\Auth;
      if(!Auth::check()){ throw new \App\Exceptions\myException('Something Went Wrong.'); }


--------------------------------------------	  
 #General Errors Disaplay info => on any framework error (not your exception), you'll see a detailed ErrorException (e.g "Trying to get property of non-object. View:/home/..index.blade.php"). 
 But in production you can set .env file with APP_DEBUG=false and then the browser will just show default built-in Laravel blank "Whoops, looks like something went wrong".
 
 
  In brief about what error u'll see =>
    # If u set in .env => APP_DEBUG=true,  on any error(except when u throw your custom exception by yourself), Laravel will show detaled debug, e.g '(1/1) FatalThrowableError. Parse error: syntax error, unexpected 'if' (T_IF)'
    # If u set in .env => APP_DEBUG=false, on any error(except when u throw your custom exception by yourself), Laravel will fire only "Whoops, looks like something went wrong." on an white screen.

    # If you throw your custom Exception {throw new \App\Exceptions\myException('Product ' . $id . ' does not exist');}, it does not matter if .env => APP_DEBUG=false or APP_DEBUG=true, it'll anyway show your custom exception view, e.g {custom.blade.php}
    # If you want that while in .env => APP_DEBUG=false, and u want Laravel to show your error view on errors, (instead of default built-in Laravel blank "Whoops, looks like something went wrong"), 
	then change /app/Exceptions/Handler.php by adding 
	       return response()->view('errors.custom-whoops'); 
	#But in this case, even if .env => APP_DEBUG=true u'll see only this your custom error view
  
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

7.Forms validation via Controller => 
    see example_1 at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/ShopPayPalSimpleController.php    at => public function storeToCart(Request $request)
    see example_2 at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/WpBlog.php   at =>  public function store(Request $request)
 
 # get one input => $request->input('role_sel'); vs $request->all()
  
  #get form input => 
         use Illuminate\Support\Facades\Input;
		   var_dump(Input::get('description'));
		   dd(Input::all());
		   
 #creating custom error messages, if use {Validator::make()} in controller => 
 
  use Illuminate\Support\Facades\Validator;
  public function assignRole(Request $request){
		
    $rules = [
			'role_sel' => ['required', 'string', 'min:3', Rule::in( ['admin', 'owner'] ) ],  // 'role_sel' is input name not DB field
			'rDescr' => [ 'required', 'string' ] , 
			
		];
		
	//creating custom error messages. Should pass it as 3rd param in Validator::make()
	 $mess = [ 
		    'role_sel.required' => 'You did not provided Description field', 
			'rDescr.min' => 'We need at least 3 letters for description',
			];
		
		
	$validator = Validator::make($request->all(),$rules, $mess);
	if ($validator->fails()) {
			return redirect('/rbac')
			->withInput()
			->with('flashMessageX',"Validation Failed")
			->withErrors($validator);
	} else { return redirect('/rbac')->with('flashMessageX',"Assigned successfully " . $request->input('role_sel')); }   

# validate in range => use Illuminate\Validation\Rule;  $rules = ['role_sel' => ['required', 'string', Rule::in(['admin', 'second-zone']) ] , //integer];   
See example at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/RbacController.php at section public function assignRole(Request $request)
See example with Range in message => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Requests/ShopPaypalSimple_AdminPanel/SaveNewProductRequest.php
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
	#For <select> => 
	     <select name="product-category" class="mdb-select md-form"> <!-- Saves the old value of select if submit failed due to Validation -->
			<option  disabled="disabled"  selected="selected">Choose category</option>
		        @foreach ($allCategories as $a)
				    <option value={{ $a->categ_id }} {{ old('product-category')!=null && old('product-category') == $a->categ_id  ?  ' selected="selected"' : '' }} > {{ $a->categ_name}} </option>
				@endforeach
		</select>
		
	+ (isNeeded????) =>if ($validator->fails()) {return redirect('/createNewWpress')->withInput()->withErrors($validator);
//================================================================================================







//================================================================================================

8.Form Validation  vai Controller(General info) => 
  NB: first implement back-emd validation, then front-end
  # 4 ways of validation => https://laravel.demiart.ru/ways-of-laravel-validation/
  #Docs => https://laravel.ru/docs/v5/validation
  
  use Illuminate\Support\Facades\Validator;
  
  
		$rules = [
			'first_name'  => ['required', 'string', 'min:3'], 
			'email'       => ['required', 'email', 'min:3', 'unique:abz_employees,email'], 
			'user_dob'    => ['required', 'date'], //date validation
			'user_phone'  => ['required',  "regex: $RegExp_Phone" ],
			'user_n'      => ['required', 'string', 'min:3'],
			'user_salary' => ['required',  'numeric'], //numeric to accept float
            'user_rank'   => ['required', 'integer', Rule::in($rankList) ] , //in range];
			'user_superior'   => ['required', 'integer', ],
			'user_hired_at'   => ['required', 'date'], //date validation
            'password'        => ['required', 'confirmed'], //password confirm match (works without specifiying the confirm input name, but the confirm input must be {foo_confirmation} i.e {password_confirmation})
			'image'           => ['required',  'mimes:png,jpg', 'max:5120' ], //2mb = 2048 //'mimes:jpeg,png,jpg,gif,svg'
			
		];
        
        $messages = [
        'first_name.min'  => 'First name at least 3 chars',
        'u_phone.regex'   => 'Phone must be in format +380....',
        ];

        $result =  Validator::make($request, $rules, $messages);
        if ($result->fails()) { //.........}  
//================================================================================================








//================================================================================================
8.1.1 Form Validation via Request Class, see example at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Requests/ShopShippingRequest.php
 1. php artisan make:request ShopShippingRequest
 2. In controller:
     use App\Http\Requests\ShopShippingRequest; 
	 function pay1(ShopShippingRequest $request) {
	     // your code if validation is OK
	 
 3. In app/Http/Requests/ShopShippingRequest
 use Illuminate\Validation\Rule; //for in: validation
 class ShopShippingRequest extends FormRequest
{ 
    public function authorize()
    {
        //return false;
		return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
		$RegExp_Phone = '/^[+]380[\d]{1,4}[0-9]+$/';
		
        return [
            'u_name' => ['required', 'string', 'min:3'], // 'u_name' is input name not DB field
			'u_address'  => [ 'required',  'string', 'min:8'],
            'u_email'  => [ 'required', 'email' ] ,
            'u_phone'  => [ 'required', "regex: $RegExp_Phone" ],
			'product-price' => ['required', 'numeric'], //numeric to accept float
			'user_salary' => ['required',  'numeric', 'between:1, 500.00'], //numeric to accept float, range between
			'product-quant' =>  ['required', 'integer', 'min:1' ],

			'product-category' => ['required', 'string', Rule::in(['admin', 'second-zone']) ] , //in range //integer];
			'product-name' =>  ['required', 'string', 'min:3', 'unique:shop_simple,shop_title'],  //unique:tableName, columnName
            'user_hired_at'   => ['required', 'date'], //date validation
			
			'image' => ['required', /*'image',*/ 'mimes:jpeg,png,jpg,gif,svg', 'max:2048' ], // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',,
			

        ];
    }
	
	/**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        // use trans instead on Lang 
        return [
           //'username.required' => Lang::get('userpasschange.usernamerequired'),
	       'u_name.required' => 'We need u to specify your name',
	       'u_email.email' => 'Give us real email',
	       'u_phone.regex' => 'Phone must be in format +380....',
		   'product-category.in' => 'Category has invalid value',

		];
	}
	/**
     * Return validation errors 
     *
     * @param Validator $validator
     */
    public function withValidator(Validator $validator)
    {
	    if ($validator->fails()) {
            return redirect('/checkOut2')->withInput()->with('flashMessageFailX', 'Validation Failed!!!' )->withErrors($validator);
        }
	}
 
}


----------------

 #If u want if Validation fails, the Controller still execute code =>
    See example_1 Controller => function AdminUpdateOneItem => https://github.com/account931/Laravel_Vue_Blog_V6_Passport/blob/main/app/Http/Controllers/WpBlog_Admin_Part/WpBlog_Admin_Rest_API_Contoller.php
	See example_1 Request    => https://github.com/account931/Laravel_Vue_Blog_V6_Passport/blob/main/app/Http/Requests/UpdateExistingArticleRequest.php
	
	See example_2 Controller => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/Polymorphic_Controller/PolymorphicController.php
	See example_2 Request    => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Requests/Polymorphic/PostPolymUpdateRequest.php
	
    In Request => protected function failedValidation(Validator $validator){$this->validator = $validator;}
    In Controller =>
        public function createPost(SaveNewArticleRequest $request) {
            if (isset($request->validator) && $request->validator->fails()) {
               //return response()->json($request->validator->messages(), 400);
               return response()->json(['error' => true, 'data' => 'Too Good, but validation crashes', 'validateErrors'=>  $request->validator->messages()]);
            } 
            
  ------------------ 
 # Variant 2 for controller validation =>
    use Illuminate\Support\Facades\Validator;

    $validator =  Validator::make($request->all(), [
            'name'                  => 'required|max:255',
            'email'                 => 'required|email|unique:users',
            'password'              => ['required', 'confirmed'], //same as => 'required|confirmed',
            'password_confirmation' => 'required' // //must be named 'password_confirmation', i.e 'firstINPUT_confirmation' to be automatically validate in back-end ()

        ]);
        
        if ($validator ->fails()) {
            return response()->json(['error' => true, 'data' => 'Too Good, but validation crashes', 'validateErrors'=>  $validator->messages()]);
        } 

        if ($validator ->passes()) {
            return response()->json(['error' => true, 'data' => 'Too Good, but validation OK']);
        }

   





//================================================================================================

8.1.2 Custom Form Validation via Model(like in Yii2), (when u can't use Request as intended, e.g for REST requests), see example at =>
   Controller => https://github.com/dimmm931/Laravel_Yajra_DataTables_AdminLTE/blob/main/app/Http/Controllers/YajraDataTablesCrudController.php
   Model      => https://github.com/dimmm931/Laravel_Yajra_DataTables_AdminLTE/blob/main/app/Models/Abz/Abz_Employees.php
                 validateRequest($request), interventionResizeSave($request)

//================================================================================================






//================================================================================================
8.1.2 Image Upload and validation (regular form)


 #Example_1 => 
   # Image Validation rules example (via Request Class) see at =>  https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Requests/ShopPaypalSimple_AdminPanel/SaveNewProductRequest.php
   # Upload image example (Controller) => see {public function storeProduct(SaveNewProductRequest $request)}  =>  https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/ShopPayPalSimple_AdminPanel.php
   # Delete image example (Controller) => see {public function deleteProduct(Request $request)} =>   https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/ShopPayPalSimple_AdminPanel.php
 
 #Example_2 (upload multiple images as array + form with input population) =>
   # Image Validation rules example (via Request Class) see at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Requests/Wpress_Images/SaveNewWpressImagesRequest.php
   # Upload image example (Controller) => see function store() => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/WpBlogImagesContoller.php
   # Upload form => see https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/views/wpBlog_Images/create.blade.php
   # Js to populate => \blog_Laravel\public\js\Wpress_ImagesBlog\wpress_blog.js
---------------------------------------
#u can get image via request =>  $request->image (DONT USE $request->input('image') as IT WON"T WORK)
# get file extension => $request->image->getClientOriginalExtension();
# get file size =>      $request->image->getSize()
# get file name =>      $request->image->getClientOriginalName()

#Dont forget to add to form enctype="multipart/form-data" =>  <form method="post" action="{{url('/storeNewWpressImg')}}"  enctype="multipart/form-data">



# U can as well upload an image using Intervention Library methods (not only upload, but resize, watermark, etc), see => 205. Laravel Intervention => (IMPLEMENTED IN {abz_Laravel_6_LTS})






//================================================================================================
8.1.3 Image Upload and validation via ajax (Formdata)

#One image ajax upload example => 
    View/Js    => https://github.com/dimmm931/Laravel_Yajra_DataTables_AdminLTE/blob/main/resources/views/admin-lte/admin-lte.blade.php
    Controller => https://github.com/dimmm931/Laravel_Yajra_DataTables_AdminLTE/blob/main/app/Http/Controllers/YajraDataTablesCrudController.php

#Multiple image ajax upload Vue example => 
    View/Js    => https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/WpBlog_Vue/components/pages/loadnew.vue
    Controller => https://github.com/account931/Laravel_Vue_Blog/blob/main/app/Http/Controllers/WpBlog_Rest_API_Contoller.php






//================================================================================================
8.1 Form input with in-line validation errors <span>, like in Yii2  => 
  => see example at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/views/auth/login.blade.php
  => see example2 with different inputs(textarea, select) at =>https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/views/ShopPaypalSimple_AdminPanel/shop-products/add-product.blade.php
  
<div class="form-group{{ $errors->has('product-name') ? ' has-error' : '' }}">
    <label for="product-name" class="col-md-4 control-label">Product name</label>

    div class="col-md-6">
        <input id="product-name" type="email" class="form-control" name="product-name" value="{{ old('email') }}" required autofocus>
                                
        @if ($errors->has('product-name'))
            <span class="help-block">
                <strong>{{ $errors->first('product-name') }}</strong>
            </span>
        @endif 
	</div>
 </div>	    
//================================================================================================





//================================================================================================

8.2 Form fields Insert to DB  => see example at https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/WpBlog.php   at =>  public function store(Request $request)
  Docs => https://www.studentstutorial.com/laravel/insert-data-laravel

//================================================================================================










//================================================================================================
9.9.Migrations/Seeders    => see docs at => https://laravel.ru/docs/v5/migrations
  see examples (with comment column) at =>  https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/database/migrations/2020_11_22_135811_create_shop_orders_main_table.php
  
  Laravel SQL  equivalents => https://laravel.com/docs/4.2/schema
  
  #create migration   =>   php artisan make:migration create_users_table
  #run all migrations =>   php artisan migrate
  
  Можно также использовать параметры --table и --create для указания имени таблицы и того факта, что миграция будет создавать новую таблицу (а не изменять существующую — прим. пер.). =>
    php artisan make:migration create_wpress_blog_post_table --create=wpress_blog_post
  
 
 If migration error (Specified key was too long; max key length is 767 bytes)=> it happens if you don't have at least MySQL 5.7.8 or MariaDB 10.2.2 installed
     #var_1 =>  SET @@global.innodb_large_prefix = 1;  => run this query before your query:, this will increase limit to 3072 bytes. SET @@global.innodb_large_prefix = 1;
     #var_2 => drop the new tables if there have been any created and change the charset/collation setting in ./config/database.php to these values:
        'connections' => [
            'mysql' => [
                // ...
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                // ...
            ] ]
			
	  #var_3(Working & Tested) =>  all you have to do is edit your /app/Providers/AppServiceProvider.php file and inside the boot method set a default string length:
                use Illuminate\Support\Facades\Schema;
                public function boot(){
                    Schema::defaultStringLength(191);
                }
	 
  # php artisan migrate:refresh
  
  
  #Create Foreign key in migration, e.g for table {shop_categories} => see example => 
       correct example   => https://github.com/dimmm931/Laravel_Yajra_DataTables_AdminLTE/blob/main/database/migrations/2021_02_05_140743_create_abz_employees_table.php
       corrupted example (Foreign key constraint is incorrectly formed) =>https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/database/migrations/2020_11_21_165700_create_shop_simple_table.php
	NB!!!! => If one table contains ID that used as Forein Keys in other table, then migration for this first table must be run first or migration will crash. Example: first create migration{create_shop_categories_table}, then {create_shop_simple_table}
    
	//Foreign key
    $table->bigInteger('rank_id')->unsigned()->comment = 'Rank Id from table (abz_ranks) (ForeignKey)'; 
    $table->foreign('rank_id')->references('id')->on('abz_ranks')->onUpdate('cascade')->onDelete('cascade');  //Id from table {abz_ranks}
	//End Foreign key
	
    If error "General error: 1005 Can't create table ,Foreign key constraint is incorrectly formed in laravel" => 
       => make sure that FK type is the same as the reference table id, so instead of defining your column as Integer use bigInteger insteated  
       => if ($table->bigIncrements('id');)        then use for FK ($table->bigInteger('a_tables_id')->unsigned();)
       => if ($table->increments('wpImStock_id');) then use for FK ($table->integer('wpImStock_postID')->unsigned()->nullable()->comment = 'Category';)
    #UNSIGNED only stores positive numbers (or zero), SIGNED positive and negative
    
  # To add a new column to existing table => see example at https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/database/migrations/2020_11_21_171640_add_2_columns_to_shop_simple_table.php
     1. php artisan make:migration add_2_columns_to_shop_simple_table
	 2. see content in example
	 
  # Add automatic timestamps =>  $table->timestamps();  //adding created_at and updated_at columns
  
  //----------------------------
  
  #SEEDER
  see examples at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/database/seeds/DatabaseSeeder.php
  	NB!!!! => If one table contains ID that used as Forein Keys in other table, first table must be seeded first or seeding will crash. Example: first seed {shop_categories_table}, then {shop_simple_table}


  //Загрузка начальных данных в БД
  To seed all =>   php artisan db:seed   //By default, the db:seed command runs the DatabaseSeeder class, which may be used to call other seed classes
  # if u run seeder command and Seeder Class contain {DB::table('users')->delete()}, it will overwrite all data, if it doesnot, then it will add Seeder column data to existing values in DB 

  #to seed a specific class only => php artisan db:seed --class=UsersTableSeeder
  
  # If u want to place some seeder for some table in separate file in subfolder, i.e /SeedersFiles, place them there and then call them in DatabaseSeeder as ususal  (by {php artisan db:seed }) without subfolder prefix
      public function run(){
	  //call other seeders u need....
	  $this->call('ShopSimpleSeeder');  //call your subfolder without subfolder prefix
	  
  If u just created this subfolder, run {composer dump-autoload}
 
  # Way to set auto increment back to 1 before seeding a table. Go to seeder Class => 
      Instead of   DB::table('products')->delete(); use =>
	  
	  DB::statement('SET FOREIGN_KEY_CHECKS=0');
      DB::table('products')->truncate();
  
  # Set/seed 'created_at' with current timestamp => 
      use Carbon\Carbon;
      'created_at' => Carbon::now()->format('Y-m-d H:i:s')
//================================================================================================









//================================================================================================
10.hasOne/hasMany relation

#For Rest API see => 13.1 Has Many relation in JSON (REST API)

#Main difference between hasOne/hasMany vs belongsTo: (if table 'X' primary ID is used in other table as ordinary table, then 'X' model hasOne/hasMany)
  belongsTo and belongsToMany - you're telling Laravel that this table holds the foreign key that connects it to the other table.
  hasOne and hasMany - you're telling Laravel that this table does not have the foreign key.



10.1 hasOne relation
  1.Specify hasOne method in parent model  => 
      public function authorName(){return $this->hasOne('App\users', 'id', 'wpBlog_author')->withDefault(['name' => 'Unknown']);      //$this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');}
      //->withDefault(['name' => 'Unknown']) this prevents the crash if this author id does not exist in table User (for example after fresh install and u forget to add users to user table)
      arg -> (foreign_key', 'local_key');
	
  2. In controller for DB optimization use Eager loading (::with('')) instead of simple (->get()) => 
         $articles = Book::with('authorName', 'otherHasOne')->get();
		 
  3.Use in view =>
      @foreach ($articles as $a){ 	p>Author:   {{ $a->authorName->name   }}</p> <!--   --> 
	  
----------------------------

10.2 hasMany relation, see example at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/views/ShopPaypalSimple_AdminPanel/orders.blade.php
   1.Specify hasMany method in parent model  => 
       public function categoryNames(){ return $this->hasMany('App\models\ShopSimple\ShopOrdersItems', 'fk_order_id', 'order_id');//->withDefault(['fk_order_id' => 'Unknown']); //arg -> (foreign_key', 'local_key');
       WRONG => //public function categoryNames(){ return $this->belongsTo('App\models\wpress_category', 'wpBlog_category','wpCategory_id');  //return $this->belongsTo('App\modelName', 'parent_id_this_table', 'foreign_key_that_table');}
    
   2. In controller for DB optimization use Eager loading (::with('')) instead of simple (->get())
   
   3.Use in view =>
	  @foreach ($dbResulta as $v)
	      @foreach ($v->categoryNames as $x) //hasMany must be inside second foreach
		    {{$x->columnName}}
	      @endforeach
	  @endforeach
	  WRONG =>  //<p>Category: {{ $a->categoryNames ->wpCategory_name }}</p> <!-- hasMany relations to show categoty name -->

 # Check if relation exists (example for hasMany), see example at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/views/ShopPaypalSimple_AdminPanel/orders.blade.php
  @if( $v->orderDetail->isEmpty() )
 
 -----------
 
 #LATEST UPDATE, NB =>
   hasMany returns hasMany method in DB result as subArray(must be foreached the 2nd time), e.g $data = ['some' =>'text', 'some2' => 'text', 'hasManyMethod' => array( [coulmnName=>''], [coulmnName=>'']) ]
   
   //Version for $db->get(), i.e if it returns array of objects  //getImages is a model hasMany method  
   $data = Wpress_images_Posts::with('getImages', 'authorName', 'categoryNames')->where('wpBlog_id', $idN)->orderBy('wpBlog_created_at', 'desc')->get(); //->with('getImages', 'authorName', 'categoryNames') => hasMany/belongTo Eager Loading
        $text = "";
        foreach($data as $b){
            if ($b->getImages->isEmpty()){
                $text.= 'Empty ';
            } else {
                foreach($b->getImages as $f){
                    $text.= " Id to delete: " . $f->wpImStock_id . " ";
                }
            }
        }
 
 
 
    //Version for $db->findOrFail($idN), i.e if it returns one object
    $data = Wpress_images_Posts::with('getImages')->findOrFail($idN);
    $text = "";
    if ($data->getImages->isEmpty()){
        $text.= ' No images connected to post found. ';
    } else {
        foreach($data->getImages as $f){
            $text.= " Id to delete: " . $f->wpImStock_id . " ";
        }
    }
  
 
 
 
 
 
 
 
 
 
 
 
  
                
                
 ---------------------------- 
 
 10.3 belongsTo relation (The Inverse Of The Relationship)
 
  public function getRank() 
        return $this->belongsTo('App\Models\Abz\Abz_Ranks', 'rank_id', 'id');   //'foreign_key', 'owner_key' i.e 'this TableColumn', 'that TableColumn'
	}

 
//================================================================================================






//================================================================================================
11.DB SQL Eloquent queries
  
  #For Eloquent ORM:
    User::all() and User::get() will do the exact same thing. get() is a method on the Eloquent\Builder object. If you need to modify the query, such as adding a where clause, then you have to use get().
	
    $articles = wpress_blog_post::all();
    $articles = wpress_blog_post::where('wpBlog_status', '1')->get();  INSIDE MODEL =>   $articles = $this->where('wpBlog_status', '1')->get();
	$articles = wpress_blog_post::where('wpBlog_status', '1')->where('wpBlog_category', 1)->get(); //multiple where
    
	$user = User::where('username', '=', 'michele')->first();
	$roles = Role::select('role','surname')->where('id', 1)->get(); //select columns
	
	wpress_blog_post::where('wpBlog_id',$id)->delete(); //Delete
	
	$model = App\Flight::findOrFail(1); $model = App\Flight::where('legs', '>', 100)->firstOrFail();  //To get in view:  $model->property
       findOrFail() is alike of find() function with one extra ability - to throws the Not Found Exceptions. So use it instead of checking if record exists (as u like it to do )
	   //If model field is not 'id', make sure to add to model => protected $primaryKey = 'wpBlog_id';
	   
	$articles->count()
	
	$books = Book::with('author', 'categories')->get(); => Eager loading for hasOne/hasMany relations (use instead of simple (->get()) for DB oprimaization), 'author', 'categories' are models' hasOne/hasMany relations.
    $books = Wpress_images_Posts::with('getImages', 'authorName', 'categoryNames')->findOrFail($id);
  
  #Метод get() возвращает объект Illuminate\Support\Collection (для версии 5.2 и ранее — массив) c результатами, в котором каждый результат — это экземпляр PHP-объекта StdClass.
  use Illuminate\Support\Facades\DB;  $users = $articles = DB::table('wpress_blog_post')->get();
  use Illuminate\Support\Facades\DB; $articles = DB::table('wpress_blog_post')->where('wpBlog_status', '1')->get();



  //Check if record exists-1, if not throw custom exception, traditional way like followingdoes not work =>  $articleOne = wpress_blog_post::where('wpBlog_id',$id)->get(); if ($articleOne){exception}
       try{
	      $articleOne = wpress_blog_post::where('wpBlog_id',$id)->firstOrFail(); //find the article by id  ->firstOrFail();
	   } catch (\Exception $e) {
	      throw new \App\Exceptions\myException('Article does not exist');
	   }
	//Check if record exists-2    
	$roleAdmin =  self::where('name', 'admin')->get();
    if (!$roleAdmin){ }
	
	//Check if record exists-3. Returns boolean. The best!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	if( Role_User::where('user_id', intval($request->input('user_id')))->where('role_id', intval($request->input('role_sel')) )->exists()) { 
    if (!User::where('id', $id)->exists()) { 
	      throw new \App\Exceptions\myException('User ' . $id . ' does not exist');
	}




   #Eloquent object to array ->  $articleOne = wpress_blog_post::where('wpBlog_id',$id)->get(); $articleOne->toArray(); 
	
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
	   
	# $allDBProducts = ShopSimple::orderBy('shop_price', 'desc')->paginate(6); //with pagination and desc/asc
	
	# Eloqent query with different "orderBy" clauses based on $_GET['order'] => see example at function index() => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/ShopPayPalSimpleController.php
	
	    if ( !isset($_GET['shop-category']) /*|| (isset($_GET['shop-category']) && $_GET['shop-category']==null  ) */){ 
		    
			$allDBProducts = ShopSimple::when(isset($_GET['order']) && $_GET['order'] == 'lowest', function ($q) /* use($s) */  {
               return $q->orderBy('shop_price', 'asc');
            })
			->when(isset($_GET['order']) && $_GET['order'] == 'highest', function ($q) /* use($s) */  {
               return $q->orderBy('shop_price', 'desc');
            })
			->when(isset($_GET['order']) && $_GET['order'] == 'newest', function ($q) /* use($s) */  {
               return $q->orderBy('shop_created_at', 'desc');
            })
			->paginate(6); //with pagination
	
# delete orders from table {shop_orders_main} which are older than 24 hours based on Carbon
    use Carbon\Carbon;
    
    $yesterday = Carbon::now()->subDays(1)->toDateTimeString(); //2021-05-23 14:37:08"
    $delete = ShopOrdersMain::where('if_paid', '0')->where('ord_placed', '<=', $yesterday)->get(); //get for foreach
    ShopOrdersMain::where('if_paid', '0')->where('ord_placed', '<=', $yesterday)->delete(); //delete
        
    //delete relevant rows in table {order_item}
    $array_of_ids = array();
    foreach($delete as $v){
        array_push($array_of_ids, $v->order_id); //[id, id, id]            
    }
    $subDelete = ShopOrdersItems::whereIn('fk_order_id', $array_of_ids)->delete(); //delete multiple ids
    
   

   
# If Laravel Pagination links not including other GET parameters =>
	//adds this to SQL Result Object (in Controller) in order Laravel Pagination links would including other GET parameters when u naviagate to page=2, etc; i.e the URL would contain previous $_GET[] params, like it was "shopSimple?order=lowest", when goes to page=2 it will be "shopSimple?order=lowest&page=2". Without this fix URL will be just "shopSimple?page=2"
	$allDBProducts = ShopSimple::orderBy('shop_price', 'desc')->paginate(6);
	$allDBProducts = $allDBProducts->appends(\Illuminate\Support\Facades\Input::except('page'));
	//... return view(......)
			
//================================================================================================














//================================================================================================
11.1 DB SQL Eloquent queries optimization https://laravel.demiart.ru/laravel-database-queries-optimization/
    1. Use chunk =>
        $posts = Post::chunk(100, function($posts){
        foreach ($posts as $post){ /* do smth */ }  });
    2. Select only required fields => 
        $posts = Post::select(['id','title'])->find(1); //Eloquent
        $posts = DB::table('posts')->where('id','=',1)->select(['id','title'])->first(); //query builder
    3. Pluck => $posts = Post::pluck('title', 'slug');
    4. Count => instead of  $posts = Post::all()->count(); , DO => $posts = Post::count();
    5. Eager loading => 
        $posts = Post::with(['author'])->get();
        $posts = WpressRest::with('authorName', 'categoryNames')->where('wpBlog_id', $id)->get();
    6. Use simplePaginate instead of Paginate =>
        NOT: $posts = Post::paginate(20);  YES: $posts = Post::simplePaginate(20); //links only to next and prev page
    7. WHERE usage => NOT: $posts = Post::whereDate('created_at', '>=', now() )->get();  YES: $posts = Post::where('created_at', '>=', now() )->get();
    8. Getting last SQL row =>
       NOT: $posts = Post::latest()->get();   YES: $posts = Post::latest('id')->get();
    9. Group similar queries =>
        NOT:
        $published_posts = Post::where('status','=','published')->get();
        $featured_posts = Post::where('status','=','featured')->get();
        $scheduled_posts = Post::where('status','=','scheduled')->get();
        YES:
        $posts = Post::whereIn('status',['published', 'featured', 'scheduled'])->get();
        $published_posts = $posts->where('status','=','published');
        $featured_posts = $posts->where('status','=','featured');
        $scheduled_posts = $posts->where('status','=','scheduled');
 






//================================================================================================

11.2 Eloquent vs Query builder: 
  Eloquent is Laravel's implementation of Active Record pattern. Less faster Performance. When you process a few records, there is nothing to worry about. But for cases when you read lots of records (e.g. for datagrids, for reports, for batch processing etc.) the plain Laravel DB methods is a better approach
  
  #Query builder => 
      use Illuminate\Support\Facades\DB;
      $posts = DB::table('posts')->where('id','=',1)->select(['id','title'])->first();















//================================================================================================
12.Laravel CRUD => see docs at https://appdividend.com/2017/10/15/laravel-5-5-crud-example-tutorial/

--------------------------------------
12.1 Delete => see example_1 at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/WpBlog.php   =>  public function destroy($id) 
 #Delete with confirm
  <a href = 'delete/{{ $a->wpBlog_id }}'> Delete  <img class="deletee" onclick="return confirm('Are you sure?')" src="{{URL::to("/")}}/images/delete.png"  alt="del"/></a>
 
 
 # Delete example_2 => 
     # View => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/views/ShopPaypalSimple_AdminPanel/shop-products/shop-products-list.blade.php
              <button><a href = 'admin-edit-product/{{ $oneProduct->shop_id }}'>  <span onclick="return confirm('Are you sure to edit?')">Edit via /GET  <img class="deletee"  src="{{URL::to("/")}}/images/edit.png"  alt="edit"/></span></a></button>  
     # Controller => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/ShopPayPalSimple_AdminPanel.php
	                 => public function deleteProduct(Request $request){}
	
--------------------------------------	
  12.2 Update 
	   Update example_1 (Wpress) => 
	        # View (form) =>  https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/views/wpBlog/edit.blade.php
	                    
            
			# Controller => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/WpBlog.php
			                => public function edit($id) {)                     (Edit Form)
							=> public function update(Request $request, $id) {} (Store)
	                        wpress_blog_post::where('wpBlog_id', $id)->update([  'wpBlog_text' => $data['description'], 'wpBlog_title' => $data['title'], 'wpBlog_category' => $data['category_sel'] ]);
					
					
		Update example_2 (Shop AdminPanel, edit product) => 
		    # View (Form) => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/views/ShopPaypalSimple_AdminPanel/shop-products/edit-product.blade.php
			# Controller =>  https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/ShopPayPalSimple_AdminPanel.php
			                 public function editProduct($id){} (Form)
							                                    (Store)????
		
        Example_3 =>
       //gets the Row
		$q = ShopQuantity::where('product_id', $request->input('prod-id'))->get();
		$newQuantity = $q[0]->all_quantity + $request->input('product-quant');
		
		if (ShopQuantity::where('product_id', $request->input('prod-id'))->update(['all_quantity' => $newQuantity])) {
		    return redirect()->back()->withInput()->with('flashMessageX', 'Quantity added ' . $request->input('product-quant') . ' to ' . $q[0]->all_quantity . ' id ' .  $q[0]->product_id );
		
---------------------------------------

    12.3 Create (Save) example_1 (Shop AdminPanel, create product) => 
	        # View (Form) => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/views/ShopPaypalSimple_AdminPanel/shop-products/add-product.blade.php
            
			# Controller  => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/ShopPayPalSimple_AdminPanel.php
              public function addProduct(){} (Form)
			  public function storeProduct(SaveNewProductRequest $request) (Store)
			
 
          # Example_2 Create (Save via ::create()) =>  => https://github.com/account931/abz_Laravel_6_LTS/blob/main/app/Http/Controllers/YajraDataTablesCrudController.php			
            function store(Request $request){
		      $form_data = array(
                  'name'        =>  $request->first_name, //DB column => input name
				  'image'       =>  $imageName, //$request->image,
              );

              if ( Abz_Employees::create($form_data)) {
                  return response()->json(['success' => 'Data Added successfully']);
		      } else {} }
			  
--------------------------------------

    12.4 Read example => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/ShopPayPalSimple_AdminPanel.php
	                     public function products(){}

//================================================================================================







//================================================================================================
12.24. Save to DB (SQL INSERT) via model function, see example at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/models/ShopSimple/ShopOrdersMain.php
  1. In Cotroller =>
       public function pay1(ShopShippingRequest $request){
	     //save Order to DB tables {shop_orders_main} and {shop_order_item}
		$shopOrdersMain = new ShopOrdersMain();
		if($shopOrdersMain->saveFields($request->all())){ //all form inputs
			return redirect('payPage2')->with(compact('input'));
		} else {
		    return redirect('/checkOut2')->with('flashMessageFailX', "Error saving to DB. Try Later" );
        }
  2. In model =>
      public function saveFields($data){
		$this->ord_uuid =        $data['u_uuid']; //auth()->user()->id;
		$this->ord_sum =         $data['u_sum'];
		$this->ord_phone =       $data['u_phone'];
		//$this->ord_placed =      date('Y-m-d H:i:s');
		$this->save();
		return true;
	}
//================================================================================================











//================================================================================================
13.REST API => see docs at  https://developernotes.ru/laravel-5/rest-restful-api

  #Rest controller example => see https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/Rest.php
  #Rest model example      => see https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/models/Rest/WpressRest.php
   
  #Example => Client working with Rest Endpoint Controller => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/TestRest.php
  #Example => Client working with Rest Endpoint Js Ajax    => var_1 => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/public/js/test-rest/test-rest.js
                                                           => var_2 => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/assets/js/WpBlog_Vue/components/CreatePost.vue
  
  #Endpoints:
    #routes for REST must be specifies in {routes/api.php} not {routes/web.php}
      get all articles from Db table {wpress_blog_post}  => /GET http://localhost/laravel+Yii2_widgets/blog_Laravel/public/api/articles
      get one article  from Db table {wpress_blog_post}  => /GET http://localhost/laravel+Yii2_widgets/blog_Laravel/public/api/articles/8
	  
	#If u mistakenly put routes in {routes/web.php}, REST Api endpoints will be => 
            http://localhost/laravel+Yii2_widgets/blog_Laravel/public/articles     http://localhost/laravel+Yii2_widgets/blog_Laravel/public/articles/8
	
    ------------------------------
    # REST routes/methods => 
    Route::get   ('/sample/edit/{id}',   'YajraDataTablesCrudController@getFormVal')->name('/sample.edit'); //get some DB data to fill Edit/Update form
    Route::post  ('articles',      'Rest@store');
    Route::put   ('articles/{id}', 'Rest@update');
    Route::delete('articles/{id}', 'Rest@delete');
    
    -----------------------------
    
    #REST CRUD roadmap EXAMPLES =>
      *routes => https://github.com/dimmm931/Laravel_Yajra_DataTables_AdminLTE/blob/main/routes/web.php 
      *js/ajax => https://github.com/dimmm931/Laravel_Yajra_DataTables_AdminLTE/blob/main/resources/views/admin-lte/admin-lte.blade.php
      *server-side REST controller => https://github.com/dimmm931/Laravel_Yajra_DataTables_AdminLTE/blob/main/app/Http/Controllers/YajraDataTablesCrudController.php
   
   
   ------------------------------
   
   #Ajax CSRF => 
   #Variant_1: 
       Form must have csrf_token =>  <input type="hidden" value="{{csrf_token()}}" name="_token" /><!-- csrf-->
   #Variant_2:
       # Html must contain =>  <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSFR meta token --> 
       # In JS before ajax =>
            //ajax CSRF token  
            $.ajaxSetup({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            
    ------------------------
    #If you have issue with PUT method (update) => see example at => https://github.com/dimmm931/Laravel_Yajra_DataTables_AdminLTE/blob/main/resources/views/admin-lte/admin-lte.blade.php
    to solve this you have to send a POST request, with a POST param _method with value PUT. Or if use {formData}=> 
        var formData = new FormData(thatX)
        formData. append("_method", "PUT"); //fix for PUT method


     
   # REST DELETE => return value 
     204: The server has successfully fulfilled the request and that there is no additional content to send in the response payload body.
     200: The request has succeeded and the request payload includes a representation of the status of the action.
     
//================================================================================================





//================================================================================================

13.1 Has Many relation in JSON (REST API)

1. In model (REST model) add relation:

     public function authorName() //hasOne
       {return $this->hasOne('App\users', 'id', 'wpBlog_author');      //$this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');}
    
	public function categoryNames(){ //hasMany
        return $this->belongsTo('App\models\wpress_category', 'wpBlog_category','wpCategory_id');  //return $this->belongsTo('App\modelName', 'parent_id_this_table', 'foreign_key_that_table');} Eager loading.
	  
2. In controller:
    public function show($id)
        return WpressRest::with('authorName', 'categoryNames')->where('wpBlog_id', $id)->get(); //return WpressRest::with('authorName')->where('wpBlog_id', $id)->get();

3. Read in JS ajax success (while DB field name is {wpBlog_author}), author_name is model hasOne function, {name} is DB field)
     data[i].author_name.name  //it is correct, {authorName} to {author_name}
	 
	 
#to exclude PASSWORD from returning JSON add to XXX->select(array('id', 'name')) otherwise it returns all fields from table {user}. protected $hidden = ['created_at', 'password']; works for non-relational fields
    return $this->hasOne('App\users', 'id', 'wpBlog_author')->select(array('id', 'name')); 
	
//================================================================================================






//================================================================================================

13.2   REST API authentication via token (Token Bearer, String Query)

 #If u use routes in /routes/web.php and have auth middleware { Route::group(['middleware' => 'auth'}, access to Endpoints will be protected by session (request will redirect u to login page) & all is OK, but not correct for REST API, u have to use  /routes/api.php and it gonna crash without certain work
 
 #If u use routes in /routes/api.php and have auth middleware .....
  https://dev.to/grantholle/implementing-laravel-s-built-in-token-authentication-48cf

# Middleware => ['auth:api'] in /routes/api.php automatically makes sure to check if access token(User's field{api_token}) is passed ()u don'y need to check it manually on API Back-end), BUT passing the token must be implemented by you (as string query/header in js or php)

# Built-in Api Route (returns current user) => http://localhost/CLEANSED_GIT_HUB/Laravel_Vue_Blog/public/api/user

# In order to return {"error":"Unauthenticated."} not redirection to /home if the Token is wrong => DO Force json response on every api request via middleware =>

# Tempo: middleware AccessTokenMiddleware kind of working, though including in routes/api as middelware does not imply any meaning,
   what really has menaing is wether in /app/Http/Kernel.ph   protected $middleware = [] contains this  AccessTokenMiddleware (protected $middleware are executed on every request)




====================================

# My simple (without Passport )manual implementation of Token Authentication if u use routes in /routes/api.php  =>

1.VARIANT_1 Authentication, when u send Bearer token in Headers in ajax (used in CLEANSED_GIT_HUB\Laravel_Vue_Blog) => see => https://github.com/account931/Laravel_Vue_Blog
    #1.1. For token we use (User's table field {api_token})
    #1.2 # In order to return {"error":"Unauthenticated."} not redirection to /home if the Token is wrong => DO Force json response on every api request via middleware =>
        create middleware MyForceJsonResponse => see example => https://github.com/account931/Laravel_Vue_Blog/blob/main/app/Http/Middleware/MyForceJsonResponse.php
        and register it in /app/Kernel.php => 
            protected $middlewareGroups = [
                'web' => [],
                'api' => [
                    \App\Http\Middleware\MyForceJsonResponse::class, //Force json response on every api request (as result when token is incorrect, it returns {"error":"Unauthenticated."} not redirect to /home)
                     //...........
  
    
    #1.3 in /routes/api we use 'auth:api' middleware(it checks if user is logged via token), it will do the Token checking/verifying automatically, simple 'api' won't. BUT passing the token in API request must be implemented by you (as string query/header in js or php) =>
        Route::group(['middleware' => ['auth:api'/*, 'sendTokenMyX'*/, 'myJsonForce'],  'prefix' => 'post'],  //e.g of a route => "api/post/get_all"
    
    #1.3.1 in {/config/auth.php}  'guards' => [ 'api' => [ 'driver'   => 'passport' ] ],
    
    #1.4 Pass current User to Vue component in /views/wpBlog_Vue/index.blade.php  => <vue-router-menu-with-link-content-display v-bind:current-user='{!! Auth::user()->toJson() !!}'>  => see https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/views/wpBlog_Vue/index.blade.php
    
    #1.5 In /WpBlog_Vue/components/VueRouterMenu.vue we add {props: ['currentUser']} to read passed value and push/uplift this value to Vuex store in beforeMount => https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/WpBlog_Vue/components/VueRouterMenu.vue
         <script>
         export default {
            props: ['currentUser'],
            //......
            beforeMount() { 
                var dataTest = this.currentUser.api_token; //passed from php in view as <vue-router-menu-with-link-content-display v-bind:current-user='{!! Auth::user()->toJson() !!}'> 
                this.$store.dispatch('changeVuexStoreTokenFromChild', dataTest); //working example how to change Vuex store from child component  
            },
    #1.6 In Store {/store/index.js} => https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/store/index.js
        In Store we use {changeVuexStoreTokenFromChild({ commit }, dataTestX)} to trigger mutation {setApiToken(state, response)} and set passed token to store.state.api_tokenY 
        And then and we call ajax/fetch add it as Header =>
            fetch('api/post/get_all', { //http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/post/get_all
               method: 'get',
               //pass Bearer token in headers ()
               headers: { 'Content-Type': 'application/json', 'Authorization': 'Bearer ' + state.api_tokenY },
               
    #1.7 In REST controller WpBlog_Rest_API_Contoller we need no manual check(and they won't work) as all is done by middleware 'auth:api'
    
    
    
    --------------
   
      
    2.VARIANT_2, when u send token as String Query in ajax as url?token=xxxxx => fetch('api/post/get_all?token=' + state.api_tokenY
      # Route::group(['middleware' => ['api'],  'prefix' => 'post'],
      # Pass current User to component in view  => <vue-router-menu-with-link-content-display v-bind:current-user='{!! Auth::user()->toJson() !!}'> 
      # In /components/VueRouterMenu.vue we add {props: ['currentUser']} to read passed value and push this value to Vuex store in beforeMount => https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/WpBlog_Vue/components/VueRouterMenu.vue
         <script>
         export default {
            props: ['currentUser'],
            //......
            beforeMount() { 
               var dataTest = this.currentUser.api_token; //passed from php in view as <vue-router-menu-with-link-content-display v-bind:current-user='{!! Auth::user()->toJson() !!}'> 
               this.$store.dispatch('changeVuexStoreTokenFromChild', dataTest); //working example how to change Vuex store from child component  
            },
      # In Store {/store/index.js} => https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/store/index.js
        In Store we set token to store state.api_tokenY and add it in ajax as api/post/get_all?token=' + state.api_tokenY
      # In REST controller WpBlog_Rest_API_Contoller we check $_GET['token'] existance and if OK, return json collection of Wpress_images_Posts => https://github.com/account931/Laravel_Vue_Blog/blob/main/app/Http/Controllers/WpBlog_Rest_API_Contoller.php
  
  
  --------------
    3.VARIANT_3. Usage of AccessTokenMiddleware (70% working, cant get user instance in middleware)
      # Create AccessTokenMiddleware and pass there {field {api_token} as header (CURRENTLY NOT WORKING, HAVE TO PASS MANUALLY) => https://github.com/account931/Laravel_Vue_Blog/blob/main/app/Http/Middleware/AccessTokenMiddleware.php
      # Register AccessTokenMiddleware in /app/Kernel.php in protected $middleware =[]
      # In REST controller WpBlog_Rest_API_Contoller we check $request->bearerToken() existance and if OK, return json collection of Wpress_images_Posts 
      //$request->bearerToken() is an access token sent in headers in ajax










============================================================================
13.2.1 REST API authentication via Passport package

#NB: more detailed Passport info is at README.md & Readme_This_Project_itself.txt => at =>  https://github.com/account931/Laravel_Vue_Blog_V6_Passport

#Passport 
  composer require laravel/passport "4.0.3" for L 5.4
  
  and proceed with complete set-up specified in documentation(migrate, passport:install, add {HasApiTokens} trait to model {User}, 
  in {app/Providers/AuthServiceProvider} add use Laravel\Passport\Passport; public function boot(){ $this->registerPolicies(); Passport::routes();}, in {/config/auth.php} => 'guards' => [ 'api' => [ 'driver'   => 'passport' ]], etc)
    #Set-up manual => https://www.twilio.com/blog/build-secure-api-php-laravel-passport
    #Manual        => https://tutsforweb.com/laravel-passport-create-rest-api-with-authentication
    #Manual GitHub =>https://github.com/hamzaali00001/laravel-passport-authentication

# Passport Migration creates tables: oauth_access_tokens, oauth_auth_codes, oauth_clients, oauth_personal_access_clients, oauth_refresh_tokens

-----

#General explanation (how it works in https://github.com/account931/Laravel_Vue_Blog_V6_Passport) =>

#Login via REST API, see example at => https://github.com/account931/Laravel_Vue_Blog_V6_Passport/blob/main/app/Http/Controllers/Auth_API/UserAuthController.php
Login auth is done not via regular session, on succesful login, we create a token via Passport, and Json it back.
Note that $token is not the same as recorded to DB table {oauth_access_tokens}
   $token = auth()->user()->createToken('API Token Any Name')->accessToken; //create token via Passport
   return response(['user' => auth()->user(), 'token' => $token]);

-------------------------------------------------------

# Auth::user()->id;  //getting the logged user ID, version for Passport
# Auth::user();      //getting the logged user Object, version for Passport


====================================
# JWT (not working)=> https://codebriefly.com/laravel-jwt-authentication-vue-ja-spa-part-1/
1. composer require tymon/jwt-auth

2.
'providers' => [
    ....
    ....
    Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
],
'aliases' => [
    ....
    'JWTAuth' => Tymon\JWTAuth\Facades\JWTAuth::class,
    'JWTFactory' => Tymon\JWTAuth\Facades\JWTFactory::class,
    ....
],

3. php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

4. php artisan jwt:secret

5. 
class User extends Authenticatable implements JWTSubject
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

# If {php artisan jwt:generate} returns error "  There are no commands defined in the "jwt" namespace." => 
    php artisan config:clear
    php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\JWTAuthServiceProvider::class"
    php artisan config:cache
    php artisan vendor:publish











//================================================================================================


13.3 REST ajax server validation (& display errors in ajax)
   Example 1 =>
       Controller   => function createPost(SaveNewArticleRequest $request) => https://github.com/account931/Laravel_Vue_Blog/blob/main/app/Http/Controllers/WpBlog_Rest_API_Contoller.php
       Request      => https://github.com/account931/Laravel_Vue_Blog/blob/main/app/Http/Requests/SaveNewArticleRequest.php
       View(Vue.js) => https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/WpBlog_Vue/components/pages/loadnew.vue
    
    Example 2 =>
       Controller                    => function store(request $request)        =>  https://github.com/dimmm931/Laravel_Yajra_DataTables_AdminLTE/blob/main/app/Http/Controllers/YajraDataTablesCrudController.php
       Validate(in model)(via model) => function validateStoreRequest($request) =>  https://github.com/dimmm931/Laravel_Yajra_DataTables_AdminLTE/blob/main/app/Models/Abz/Abz_Employees.php
       View                          => $('#sample_form').on('submit'           => https://github.com/dimmm931/Laravel_Yajra_DataTables_AdminLTE/blob/main/resources/views/admin-lte/admin-lte.blade.php





//================================================================================================

13.4 REST API CRUD
    -------------------
    #READ =>
        Example 1 =>
            JS part(Vue)  => https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/WpBlog_Vue/components/pages/blog_2021.vue
            PHP part      => https://github.com/account931/Laravel_Vue_Blog/blob/main/app/Http/Controllers/WpBlog_Rest_API_Contoller.php
    
    --------------------
    #CREATE => 
        Example 1 =>
            JS part  => https://github.com/dimmm931/Laravel_Yajra_DataTables_AdminLTE/blob/main/resources/views/admin-lte/admin-lte.blade.php
            PHP part => https://github.com/dimmm931/Laravel_Yajra_DataTables_AdminLTE/blob/main/app/Http/Controllers/YajraDataTablesCrudController.php

        Example 2 =>
            JS part(Vue)  => https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/WpBlog_Vue/components/pages/loadnew.vue
            PHP part      => https://github.com/account931/Laravel_Vue_Blog/blob/main/app/Http/Controllers/WpBlog_Rest_API_Contoller.php



    --------------------
    #UPDATE =>
        Example 1 =>
            JS part(Vue)  => https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/WpBlog_Admin_Part/components/pages/editItem.vue
            PHP part      => https://github.com/account931/Laravel_Vue_Blog/blob/main/app/Http/Controllers/WpBlog_Admin_Part/WpBlog_Admin_Rest_API_Contoller.php

     --------------------
    #DELETE =>
         Example 1 =>
            JS part(Vue)  => https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/WpBlog_Admin_Part/components/pages/list_all.vue
            PHP part      => https://github.com/account931/Laravel_Vue_Blog/blob/main/app/Http/Controllers/WpBlog_Admin_Part/WpBlog_Admin_Rest_API_Contoller.php

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
15. Js/Css, minify, Laravel Mix CAUSION => read {Alternative (and currently used)}
   File => /webpack.mix.js
   # If 1st time ever => npm install
   
   Works so muck like Browserify + Gulp.......
    All Development css/js (js/css u're changing) are located in /resources/assets/. They are not included to index.php (\resources\views\layouts). 
	Included css/js are in /public. To convert Development assets to Production(to minify, concatenate), run => npm run production
    # npm run production  => Запустить все задачи Mix и минифицировать вывод => go to cmd => 
   
   if error {"cross-env" не является внутренней или внешней командой} (in project folder)  =>   npm i cross-env --save
   if error {"Node events.js:167 throw er; // Unhandled 'error' event"} =>  Removing the node_modules directory and reinstalling again using npm install should solve the problem.

   
   # npm run watch     
   If is doesnot watch => npm run watch-poll
   If u run {npm run watch}, after any css/js change it rebuilds files in /public (even if they were prev minified), but does not minify them, so in the end run {npm run production} to do that.
   
   #Alternative (and currently used):
     you can make all css/js edits in /public. When it comes to production< copy all css/js from /public to /resources/assets/, run {npm run production} and get in public all concatenated files. 
      IMPORTANT: SEE CAREFULLY WHAT JS/CSS TO COPY(OVERWRITE) FROM '/PUBLIC' TO '/resources/assets/' in order not to erase/replace source code with uglified js. See /webpacl.mix for details. Currently don't copy to '/resources/assets/' from 'public/js/Appointment' and 'public/js/app.js' 
   


------------------------------------------------------
 #Loading CSS and JS files on specific views in Laravel 5.2. include css

  #Variant 1 (most working)(use/include in main layout, i.e /views/layout/blade.php)!!! =>
    <!-- To register JS/CSS file for specific view only (In layout template) -->
    @if (in_array(Route::getFacadeRoot()->current()->uri(), ['testRest', 'register', 'showOneProduct/{id}']))
        <script src="{{ asset('js/test-rest/test-rest.js') }}"></script>
		<link href="{{ asset('css/rbac/rbac.css') }}" rel="stylesheet">
    @endif	
	
	
	
	#Variant 2 (working) (use/include in any child view before {@endsection}, i.e /views/auth/login). OR right after @section('content') (if u don't want to encounter div loads for 1 sec without css styling) =>
	    => see example => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/views/ShopPaypalSimple_AdminPanel/shop-products/edit-product.blade.php
		<!-- Include js/css file for this view only -->
        <script src="{{ asset('js/ShopPaypalSimple/shopSimple.js')}}"></script>
        <link href="{{ asset('css/ShopPaypalSimple/shopSimple.css') }}" rel="stylesheet">
        @endsection	
    ---------
 
    #Variant 3, in Blade =>
	    @section('content')
	        some content
	    @endsection
	
	    @section('js')
           <script>//...........inject your js here 
	    @stop
		
	------------
	
	
	#Variant 4, in main layout using @stack =>
	    In main layout, before  </body> =>
		          <!-- Bootstrap JavaScript -->
                  <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
                  <!-- My App scripts -->
                  @stack('scripts')
                 </body>
				 
		In view =>
		        @section('content')
                   Some content
                @stop

                @push('scripts')
                    <script>
                    $(function() { //.....inject your js here 
				@endpush
//================================================================================================











//================================================================================================
16. 
 
 
 
 
 
//================================================================================================









//================================================================================================

17.  RBAC on Zizaco/Entrust   Works on Laravel 5, Does not work on < Laravel 6
https://github.com/Zizaco/entrust
Requires composer installing package Zizaco/Entrust

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

17.1 RBAC on Spatie Laravel Permission. Works on Laravel < 5.8. 
Substitution for Zizaco/entrust that does not work on Lavaravel > 6
    https://spatie.be/docs/laravel-permission/v4/introduction
    Install => composer require spatie/laravel-permission
    
# it is strongly recommended to always use permission directives, instead of role directives.

# Unlike Entrust Rbac, Spatie Rbac has buil-in models {Permission, Role}, so u don't need to create them manually.
Just use them where needed => 
    use Spatie\Permission\Models\Role;
    use Spatie\Permission\Models\Permission;
    
# Spatie Rbac uses 4 tables => model_has_permissions, model_has_roles, role_has_permissions, role, permission.

# See example of assigning => class Spatie_Seeder =>  https://github.com/account931/Laravel_Vue_Blog_V6_Passport/blob/main/database/seeds/DatabaseSeeder.php

# Example Check permisssion in Controller=> 
    //$userX = auth()->user(); //current user
    $userX = User::where('api_token', '=', $request->bearerToken())->first(); //$request->bearerToken() is an access token sent in headers in ajax
    if(!$userX->hasAllPermissions(['edit articles', 'delete articles',])){ 

#Blade permisssion check in views => @can('edit articles')     @endcan 
   
# Example Check role in Controller => $user->hasRole(['AdminX', 'moderator']);
# Blade role check in views => @role('writer') I am a writer!  @else  I am not a writer... @endrole



//================================================================================================

17.2 Gates (variant of built-in Laravel RBAC)
Built-in Laravel RBAC 
https://laravel.demiart.ru/laravel-gates/

#Gates are defined in closures in 'app/Providers/AuthServiceProvider.php' in public function boot()=> see example => https://github.com/account931/Laravel_LaraAppointments/blob/main/app/Providers/AuthServiceProvider.php
     
	 use Illuminate\Support\Facades\Gate;
	 Gate::define('user_management_access', function ($user) {
         return in_array($user->role_id, [1]);  //users having column 'role_id' == 1 (in table Users)
	     //return $user->id == 1; //only for user with ID == 1
      });
	
	
# Use in Controller => see example at => https://github.com/account931/Laravel_LaraAppointments/blob/main/app/Http/Controllers/Admin/AppointmentsController.php
    use Illuminate\Support\Facades\Gate;
	if (! Gate::allows('user_management_access')) {
            return abort(401);
    }
	
	
# Use in Blade => see example at => https://github.com/account931/Laravel_LaraAppointments/blob/main/resources/views/partials/sidebar.blade.php
              @can('user_management_access')
			  <!-- content -->
			  @endcan






//================================================================================================
17.3 Policy in Laravel
Read => https://laravel.demiart.ru/laravel-policy/
Policies are in => app/Policies + must be registered  in AuthServiceProvider => protected $policies = [Post::class => PostPolicy::class,];

//Example of policy => user can edit only his own articles
public function edit (User $user, Post $post) {
        return $user->id == $post->user_id;
    }
	
	
	
	
	
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
23. After Login redirect to previous page, see example at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/Auth/LoginController.php

In LoginController:

use Illuminate\Support\Facades\Session;
//use Illuminate\Support\Facades\URL; //?????

   public function __construct()
    {
        $this->middleware('guest')->except('logout'); //was by default
	    //MINE to redirect to prev page after Login
		Session::put('backUrl', url()->previous());	
    }
	

    //MINE to redirect to prev page after Login
    public function redirectTo()
    {
	   //dd(session()->get('backUrl'));
       return session()->get('backUrl') ? session()->get('backUrl') :   $this->redirectTo;
    }
	




//================================================================================================
23.2 After Registration redirect to previous page 
It is done pretty like the same as for Login, see  example at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/Auth/RegisterController.php











//================================================================================================
25. Laravel Vue
 Vue components are updated upon {npm run watch}  or {npm run production}, see details at => 15. Js/Css, minify, Laravel Mix
 
 # Roadmap to start vue.js implement =>
    #1. Create one start source code core Vue.js file in "/resources/asset/js/someOneFile.js".
        For Example => \resources\assets\js\WpBlog_Vue\wpblog-vue-start
    #2. You have to include this file in webpack.mix as source file and specify the output folder, concatenated/uglified file will be saved in that folder with the same name. U have to add this file (public/js/Wpress_Vue_JS/wpblog-vue-start.js) in html =>
       .js('resources/assets/js/WpBlog_Vue/wpblog-vue-start.js',   'public/js/Wpress_Vue_JS')  //Vue.js; Source-> Destination
    #3. Include js file "public/js/Wpress_Vue_JS/wpblog-vue-start.js" in html (e.g views/layout/app.php)
	#4. Init some components in \resources\assets\js\WpBlog_Vue\wpblog-vue-start.js, then put this Vue components where u need in /views/../some_view_file
	    Example => Vue.component('create-post',  require('./components/CreatePost.vue')); => in html => <create-post/>
	#5. Run {npm run watch} to watch changes

	
 #Examples of a start Vue file see =>  /resources/assets/js/WpBlog_Vue/wpblog-vue-start.js
                                   =>  /resources/assets/js/Appointment/appoint-vue-start.js
								  

   
    
 
 Table of content:
   25.1 Change css based on props
   25.2 Vue ajax
   25.3 Add values to Object (Object that is from data, i.e equivalent of React State)
   25.4 Iterate over Object (Object that is from data, i.e equivalent of React State)
   25.4.2 Iterate over Array (Array that is from data, i.e equivalent of React State)
   25.5 Register components
   25.6 Use component in another component
   25.7 Click action
   25.8 Call function from other external file
   25.9 Vue store Vuex
   25.9.1 Vue Router
   26. Unsorted Vue (uplift to parent, pass to child, etc)
   ------------------------------
   25.1 Change css based on props =>
            <div class="panel-body" :class="cssState? ' text-danger' : ''"> <!-- change css based on props -->
			
   ------------------------------
   25.2 Vue ajax =>  
       Ajax in Vue can be used in different ways: can be used directly in component and set result to local data; or u can dispatch/trigger a Vuex Store method in local component, specify the logic/mutation in Vuex Store and use in local component as {this.$store.state.adm_posts_qunatity}
       #Example_1 (ajax used in component)  at => https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/WpBlog_Admin_Part/components/pages/list_all.vue
       #Example_2 (ajax used in Vuex Store )  => 
            Component    => https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/WpBlog_Vue/components/pages/blog_2021.vue
            Vues store   => https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/store/index.js
           
       #Example_3 at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/assets/js/Appointment/components/subcomponents/rooms-in-loop.vue
       #Example_4 at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/assets/js/Appointment/components/test-ajax.vue
	   
	   
	   mounted() {
            console.log('Component mounted.')
			
			var thisXCursor = this; //get context, is a must
			
			 $.get( 'http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/api/articles' ) 
			 .then(function(dataZ) {  
	            console.log( dataZ ); 
				thisXCursor.info = dataZ; //assign ajax result to Object info() (Object that is from  data, i.e equivalent of React State)
	        });
			
	-----------------------------		 
	 25.3 Add values to Object (Object that is from data, i.e equivalent of React State)) =>		 
			 
				thisXCursor.info = Object.assign({}, thisXCursor.info, {
                   newProperty1: 'myNewValue',
                   newProperty2: 9311
                });
				
	------------------------------
	25.4 Iterate over Object (Object info{} that is from data, i.e equivalent of React State)
	    <div v-for="(value, name) in info">
            {{ name }}: {{ value.wpBlog_id }} {{ value.wpBlog_title }} {{ value }}
        </div>
		
    ------------------------------
	
	25.4.2 Iterate over Array (Array that is from data, i.e equivalent of React State)
        var_1 => <p v-for="item in companiesArray"> {{ item }} {{ value }}</p>
		
		var_2 => 
		        <!-- iterate over array -->
		        <div v-for="(item, index) in companies" :key="index">        
                    <one-room v-for="(item, index) in companies" :key="index" :itemZ="item" /> <!-- sendin props-->
                </div> 
				
	   var_3 iterate with componemt <one-room/>  =>
	      <one-room v-for="(item, index) in companies" :key="index" :itemZ="item" /> <!-- sendin props-->

    --------------------------------
    
    25.4.4 Iterate loop over  Vuex store, adding a "col-sm-12 col-xs-12"  after every 2nd "col-sm-6 col-xs-6" 
    
    <div class="row">
        
            <!-- Original -->
            <div v-for="(post, i) in posts" :key=i> <!-- or this.$store.state.posts -->
                
                <!-- is rendered only if i % 2 == 0 -->
                <div class="col-sm-12 col-xs-12"  style="border: 1px solid black;" v-if="i % 2 == 0"> 
                    banner 
                </div>
                
                <!-- is rendered always -->
                <div class="col-sm-6 col-xs-6">
	
                    <!-- Show 1st image if exists. HasMany Relation. {get_images} is a model {function getImages()}  HasMany Relation -->		 
                    <!--<img v-if="post.get_images.length" class="card-img-top my-img" :src="`images/${post.get_images[0].wpImStock_name}`" />-->
		
		            <!-- Image with LightBox -->
	                <a v-if="post.get_images.length" :href="`images/${post.get_images[0].wpImStock_name}`"   title="image" :data-lightbox="`roadtrip${post.wpBlog_id}`" > <!-- roadtrip + currentID, to create a unique data-lightbox name, so in modal LightBox will show images related to this article only, not all -->
                        <img v-if="post.get_images.length" class="card-img-top my-img" :src="`images/${post.get_images[0].wpImStock_name}`" />
	                </a>
                    <!-- End Image with LightBox -->
		
                    <div class="card-body">
                        <p class="card-text"><strong>{{ post.wpBlog_title }}</strong> <br>
                           {{ truncateText(post.wpBlog_text) }}
                        </p>
                    </div>
                    <button class="btn btn-success m-2 z-overlay-fix-2" v-on:click="viewPost(i)">View   <i class="fa fa-crosshairs" style="font-size:14px"></i></button>
                    <button class="btn btn-info m-2 z-overlay-fix-2"    @click="goTodetail(i)" > Router <i class="fa fa-tag" style="font-size:14px"></i></button>
		            <hr>
                </div>
            </div>
	     </div> <!-- end class="row"-->
         
    
    ----------------------------------
    
    25.4.5 Iterate over array without html tag
        <template v-for="(item2, index2) in vertical">
                <!-- Build empty td cell, used for building IF this iterator is undefined in gameHits[] -->            
                <td :key="index2" v-if="booksGet[index * horizontal + index2] == undefined " class="game-cell" :id="index * horizontal + index2"  @click="mainUserClick(index * horizontal + index2)">
                    Nul{{index * horizontal + index2}}                
                </td>
            
                <!-- Build taken td cell ("0" of "X"), used for building IF this iterator is defined in gameHits[] as ("0" of "X") -->            
                <td :key="index2" v-if="booksGet[index * horizontal + index2] != undefined " class="game-cell" :id="index * horizontal + index2"> <!-- if array el is not undefined, dispplay it's value -->
                    {{ booksGet[index * horizontal + index2 ] }} {{ index * horizontal + index2  }}     
                </td>
        </template>
    -----------------------------
    
    -----------------------------
	25.5 Register components => \resources\assets\js\Appointment/appoint-vue-start.js
    
    ----------------------------------------------
    
    25.6 Use component in another component => \resources\assets\js\Appointment\components\generateListOfRoom.js
	    <template>
           <div class="col-sm-12 col-xs-12">
               <h5>Hello from /subcomponents/room-in-loops</h5>				
		           <one-room></one-room>		   
	       </div>
        </template>

        <script>
        //using other sub-component 
        import oneRoom from './one-room.vue';  //import file from same level folder
	
        export default {
	        //using other sub-component 
	        components: {
                'one-room': oneRoom 
            },
	   
		    //i.e props
		    data: function () {
                return {
                   companies: [],
				   myStateTextX: "I am an appoint state",
				   cssState: false,
				   info: {}, 
                }
            },
			//...
		
		
		<p v-for="item in companies"> {{ item }}</p>
		
		NB: if troubles see => if in subcomponent in nested loops can't get passed from Parents props
        
        
		-------------------------
		 25.7 Click action
		<div class='subfolder shadowX' v-on:click="greet"></div>
		//...
		methods: {
			greet: function (event) {
                if (event) {
                  alert(event.target);
				  console.log(event.target)
                }
			}
		}
		//......
		
		
		-------------------------------------------------
		25.8 Call function from other external file, see example at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/assets/js/Appointment/components/subcomponents/one-room.vue
	       1. Create external file, e.g '/my_functions/scroll_function.js'
		         export const ScrollExternalFile = {
				     
					  scrollResults: function(divName, parent){}
				 };
			2. In targetted component => 
			    <script>
	            //import function from other external file
	            import {ScrollExternalFile} from '../my_functions/scroll_function.js';  //name in {} i.e 'ScrollExternalFile' must be cooherent to name in "export const ScrollExternalFile" in '/scroll_function.js'
				//.........
				
			3. Call the function in targetted component =>
			    ScrollExternalFile.scrollResults(".selected-room");
				
       
	        4.NB: if external file function uses {this}, e.g {this.gameHits}, u have to pass {this} as arg in targetted component, but in external file function can't use the same name {this} as arg, for example use {thisX}
	   
	   
        -------------------------------------------------
	    25.9 Vue store Vuex
		
		Main difference between Redux and Vuex - while Redux uses reducers Vuex uses mutations. In Redux state is always immutable, while in Vuex committing mutation by the store is the only way to change data
		#NB: must have Vuex dependecies in package.json, see example at => https://github.com/account931/Laravel_Vue_Blog/blob/main/package.json
        
		see example of Vuex store => 
		   #Vuex store itself                            
                 example_1 => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/assets/js/store/index.js
		         example_2 => https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/store/index.js

           #Store connected/initiated in main entry file 
                 example_1 => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/assets/js/WpBlog_Vue/wpblog-vue-start.js
		         example_2 => https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/WpBlog_Vue/wpblog-vue-start.js
           
           #Store used/displayed in component =>           
		              example_1 (with ajax) => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/assets/js/WpBlog_Vue/components/AllPosts.vue
		              example_2             => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/assets/js/WpBlog_Vue/components/pages/details.vue
                      example_3             => https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/WpBlog_Vue/components/pages/blog_2021.vue
                      
		#working example how to change Vuex store from child component => see changeVuexStoreFromChild in  => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/assets/js/WpBlog_Vue/components/AllPosts.vue
		
		
		//-------------------------------------------------------------------------------------
		# How To use Vuex store (brief roadmap):
		   # create store/index.js (see example link above)
		   
		   # import {Store} in main js => 
		          import store from '../store/index'; //import Vuex Store
				  const app2 = new Vue({
	                 store, //connect Vuex store, must-have
                     el: '#app2'
                  });
			
		   # Then use Vuex store in your component, 3 diffrent ways are avialble =>
		   
		    1. In needed component you may address Vuex store value as for example => this.$store.state.products[0].productId
            2. Or u can use ......mapState() and address Vuex store value by it's Stores's name, e.g "products".     
		       //...mapState(['products']) is needed for Vuex store, after it u may address Vuex Store value as {products} instead of {this.$store.state.products}
			   //mapState() gets Vuex Store data to local data, so u can address it like local {products} 
   
		        <script>
                    import { mapState } from 'vuex';
			        computed: {  //computed property is used to declaratively describe a value that depends on other values. When you data-bind to a computed property inside the template, Vue knows when to update the DOM when any of the values depended upon by the computed property has changed.

	                    ...mapState(['products']), //{products} is from Vuex store
			 			//...................................
			3. Use computed, => see "3" next paragraph 
	 
		   #So actually u can address Vuex store value in template in three different ways  => 
		      1.if didn't use {...mapState()} => {{ this.$store.state.products[0].productId }}
			  2.if used {...mapState()}       => {{ products[0].productId }}  + like in 1st variant
		      3.if used computed: {checkStore() {return this.$store.state.products;} }, ) =>  {{  checkStore[0].productId }} 

		   
		   

		//-------------------------------------------------------------------------------------
		
		
		# How To use Vuex store with Ajax (brief roadmap), see example Link above at =>  example_1 (with ajax)
		  1. Mind the prev chapter "How To use Vuex store (brief roadmap)"
		  2. In needed child component trigger firing an ajax method "getAllPosts" => 
		         beforeMount() {
                    //run ajax in Vuex store
                    this.$store.dispatch('getAllPosts'); //trigger ajax function getAllPosts(), which is executed in Vuex store
	
		  3. In Vuex store (resorces/assets/js/store/index.js) specify method {getAllPosts} => in {getAllPosts} first run ajax to REST Controller, then in success run mutation method {setPosts} => return commit('setPosts', dataZ );
		
		
		//-------------------------------------------------------------------------------------
        
        # How to update/change Vuex store from child component => see example at => this.$store.dispatch('changeVuexStoreFromChild', dataTest); =>  https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/WpBlog_Vue/components/AllPosts.vue
		
  
		-------------------------------------------------
		25.9.1 Vue Router
		npm install vue-router --save
		
		# Router example => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/assets/js/WpBlog_Vue/router/index.js
	    # Component with Menu Vue-Router is inited here   => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/assets/js/WpBlog_Vue/wpblog-vue-start.js
		# Component with Menu Vue-Router Links and with view area <router-view/> => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/assets/js/WpBlog_Vue/components/VueRouterMenu.vue
		# Vue-Router Menu's pages are in => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/tree/master/blog_Laravel/resources/assets/js/WpBlog_Vue/components/pages
		
		
		
		-------------------------------------------------
		26. Unsorted Vue (uplift to parent, pass to child, etc)
		------------------------------------------------
		# how to use data (equivalent of React state)=>
		     <template> {{count}} </template>
			 <script>
			 //..
			 data()  { return{ count: 0 } },
			 methods:{ increment(){this.count +=1;} },
		  
		  
		  
		# set data attribute => <div class='subfolder shadowX' v-on:click="greet" v-bind:data-id="this.itemZ" >
		# get data attribute => greet: function (event) {
			    alert(event.currentTarget.getAttribute('data-id')); }
		
		-----------------
        # pass from parent to child =>
		    in Parent => <selectedRoom :clickedX="this.idClicked"/>
		    in Child =>  
		        export default {
		            props: ['clickedX',],
		         //.....
		     in template =>
		         <p> Room {{  this.clickedX }}  </p>
		
		-------------------
		# uplift value from child to parent => see 2 examples at child => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/assets/js/Appointment/components/subcomponents/one-room.vue
		                                       parent is => /rooms-in-loop.js		
        in Child=> 
		        methods: {
                     onClickButton (event) {
                         this.$emit('clicked', 'someValue')
                     }
		
		    in parent => 
		        <child @clicked="onClickChild"></child>
         
                //...
                methods: {
                   onClickChild (value) {
                       console.log(value) // someValue
                    }
        -------------------
        
        # same flow (as uplift value from child to parent) goes to call parent method from child =>
            => see parent example => https://github.com/account931/CPH_miscellaneous/blob/main/Tic_tac_Vue_Framework/src/components/TicTac/TicTacStart.vue
            => see child example  => https://github.com/account931/CPH_miscellaneous/blob/main/Tic_tac_Vue_Framework/src/components/TicTac/sub_components/gameField.vue

        -------------------
        # pass props to child on ternary => 
		     <selectedRoom :clickedX="this.idClicked" :hostname="typeof(this.idClicked)=== 'string' ? 'No select so far' : this.roomsX[this.idClicked].r_host_name "/>
        
		# Image in Vue =>    <img v-if="post.get_images.length" class="card-img-top" :src="`images/wpressImages/${post.get_images[0].wpImStock_name}`" />
        
        # Image in Vue with if(){} else {} . Example is from Loop =>    
                    <img v-if="post.get_images.length" class="card-img-top my-img" :src="`images/${post.get_images[0].wpImStock_name}`" />
                    <img v-else class="card-img-top my-img" :src="`images/no-image-found.png`" />
                     
        # Import/include a file at same folder level => import store from './store/index'; , to import file one level up => import store from '../store/index';
        
		# LightBox Library on Vue vs Blade php =>
		
		    <!----- Blade php Image with LightBox -->
			<a href="{{URL::to("/")}}/images/wpressImages/{{$x->wpImStock_name}}"  title="" data-lightbox="roadtrip{{$a->wpBlog_id}}"> <!-- roadtrip + currentID, to create a unique data-lightbox name, so in modal LightBox will show images related to this article only, not all -->
			   <img class="image-main" src="{{URL::to("/")}}/images/wpressImages/{{$x->wpImStock_name}}"  alt="img"/>
			</a>
		    <!-- End Blade php Image with LightBox -->
		
		
            <!------ VUE Image with LightBox -->
	        <a v-if="post.get_images.length" :href="`images/wpressImages/${post.get_images[0].wpImStock_name}`"   title="some" :data-lightbox="`roadtrip${post.wpBlog_id}`" > <!-- roadtrip + currentID, to create a unique data-lightbox name, so in modal LightBox will show images related to this article only, not all -->
               <img v-if="post.get_images.length" class="card-img-top my-img" :src="`images/wpressImages/${post.get_images[0].wpImStock_name}`" />
	        </a>
            <!-- End VUE Image with LightBox -->
			
			
		# How to refer laravel csrf field inside a vue template =>
		     <input type="hidden" name="_token" :value="tokenXX" /> <!-- csfr token -->
			 //...
			 data () {
                 return {
	                 tokenXX:'',
                 }
             },
			 //......
			 mounted () {
                 let token = document.head.querySelector('meta[name="csrf-token"]'); //gets meta
	             this.tokenXX = token.content; //gets token and set to data.tokenXX
            },
			
		# How to get route ID => e.g "wpBlogVueFrameWork#/details/2", gets 2. See example => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/assets/js/WpBlog_Vue/components/pages/details.vue
	       var ID = this.$route.params.Pid; //gets 2  //{Pid} is set in 'pages/home' in => this.$router.push({name:'details',params:{Pid:proId}})

        # Pass var from php to vue component => 
            1.  in view => <vue-router-menu-with-link-content-display v-bind:current-user='{!! Auth::user()->toJson() !!}'>  //User array contains id, name, api_token, etc
            1.2 For strings use double quotes "'string'" =>  
                           <vue-router-menu-with-link-content-display v-bind:current-user="'someString'" >         <!-- Passport Changes (double quotes is a must-have FIX)-->

            2. in component add => 
               <script>
               export default {
                   props: ['currentUser'],
                   //......................
            3. and can use in component as => {{this.currentUser.api_token}}
            
        # Pass data between router component =>  see example at =>https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/WpBlog_Vue/router/index.js
            1. add {props} at /router/index.js  to targeted router component =>  
               path: '/New_2021', 
               name: 'new_2021', //same as in component return section
               component: blog_2021,  //component itself
               props: { tokenZZ: 'FFFFFFFFV' },
            2. use in component as => {{tokenZZ}} 

        # Problem with {this}, e.g can't set state in ajax success (this.List = someResult) => 
          Explaination => if you use this.data, it is incorrect, because when 'this' reference the vue-app, you could use this.data, but here (ajax success callback function), this does not reference to vue-app, instead 'this' reference to whatever who called this function(ajax call)
          const that = this;   //or var that = this; 
          that.List =  someResult   

        # Vue ensure state Reactivity (e.g state.errorList gets some result on ajax success) => see example and note issue with {var that = this;} => booksGet =>  https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/WpBlog_Vue/components/pages/loadnew.vue      
        
        # Vue comment => {{ /* checkStore */ }}  VS <!--{{ this.$store.state.posts.length }}-->
        
        # Vue assign id => <div v-for="(postAdmin, i) in booksGet" :key=i class="col-sm-12 col-xs-12 oneAdminPost" :id="postAdmin.wpBlog_id"> 
        # Vue get id of clicked => @click="deletePost(postAdmin.wpBlog_id)   => https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/WpBlog_Admin_Part/components/pages/list_all.vue
        # Vue set inpt value with ajax response => v-model="inputTitleValue" => https://github.com/account931/Laravel_Vue_Blog/tree/main/resources/assets/js/WpBlog_Admin_Part/components/pages/editItem.vue


        # Use dispatch with argument(can use 1 arg only) (dispatch to fire some action in Vuex Store from some other component) =>
            #In ajax, see example at => https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/WpBlog_Admin_Part/components/pages/list_all.vue => 
                var that = this; //Explaination => if you use this.data, it is incorrect, because when 'this' reference the vue-app, you could use this.data, but here (ajax success callback function), this does not reference to vue-app, instead 'this' reference to whatever who called this function(ajax call)
              
		        $.ajax({
                   //......
                   success: function(data) {
                       that.$store.dispatch('setPostsQuantity', data.data.length); 
          
            #In Vuex Store, see example at  => https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/store/index.js =>
                
                actions: {
                    setPostsQuantity ({ commit, state  }, passedArgument) {  //state is a fix
                       return commit('setQuantMutations', passedArgument ); //to store via mutation
                    },
                },
               
                mutations: {
                    //mutation to quantity of Blog to STORE
                    setQuantMutations(state, myPassedArg) {
                        state.adm_posts_qunatity = myPassedArg;        
                    },
          
            # Getter value isLoggedIn based on computed property of other state => 
                getters: {
                    isLoggedIn: state => !!state.passport_api_tokenY, //get value (true/false) based on other state
            
                Use in other component => <p> {{this.$store.getters.isLoggedIn}} </p> 
            
                Or do checking =>
                    Variant 1 => 
                       < div v-if="this.$store.state.passport_api_tokenY !== null"> Logged <logged-user-page></logged-user-page></div>
                        <div v-else class="col-sm-12 col-xs-12 alert alert-danger"> Not logged </div>
                    Variant 2 => 
                        <div v-if="this.$store.getters.isLoggedIn"> Logged </div>
                        <div v-else class="col-sm-12 col-xs-12 alert alert-danger"> Not logged</div>
                        
                        
            -----------------------------------
            
            # {{index * 3 + index2}} <!-- fu**ing iterator for 2 loops one in other, just tobreplace simple i++ -->
            
            #   //this.gameHits[item] = "x"; //add to main array //VUE ALERT: this approach is NOT reactive
                this.gameHits.splice(item, 0, "x"); //to ensure reactivity should use this approach to change array


            #if in subcomponent in nested for loops u can't get passed from Parents props, then use computed to get them => 
                => computed: { fkGetVertical () { return this.verticalX;}, }
//================================================================================================










//================================================================================================
25.1.1.1 Vue standalone (without Laravel)
Star a new project => 
    https://monsterlessons.com/project/lessons/bystryj-start-s-vuejs
    # Install once globally => npm install -g vue-cli
    # Create new project    => vue init webpack name_goes_here
    # npm install
    # npm run dev   => it will launch it on http://localhost:8080/. Watch will be done automatically. NB: OpenServer must run too ???? (CHECK)
    # npm run build => to build product to folder /build (for production). Goes to folder /dist, not /build!!!!
    NB: after {npm run build}, just like in React, u have to go /dist/index.html and replace all {/static} to {{static}}, otherwise it won't run




//================================================================================================
25.9 React ReadMe
  See => https://github.com/account931/sms_Textbelt_Api_React_JS/blob/master/README_MY_React_Com_Commands.txt







//================================================================================================
26. PayPal
 https://developer.paypal.com/developer/accounts/
 https://www.sandbox.paypal.com/mep/dashboard

For SandBox use:
  Facilitator/Business Account
  Buyer Account
  
Ready solution => https://laravel.demiart.ru/paypal-into-laravel/
  
  
//================================================================================================







//================================================================================================

27. CLI command => call Controller function via command line
navigate by CLI to folder and:
  php artisan tinker
  $cc = app()->make('App\Http\Controllers\CliCommandController');
  app()->call([$cc, 'index'], ['filter[id]'=>1, 'anotherparam' => '2']); //the last [] in the app()->call() can hold arguments such as [user_id] => 10 etc'

# Create console command =>  https://dev.to/grantholle/implementing-laravel-s-built-in-token-authentication-48cf
//================================================================================================








//================================================================================================
28. PhpUnit tests vs Laravel Dusk

PhpUnit supports module (i.e unit) tests and functional tests.
https://phpunit.readthedocs.io/ru/latest/assertions.html

  php vendor/phpunit/phpunit/phpunit    => run all PhpUnit tests (in folder "tests/Unit" and "tests/Feature"). Does not run tests in "/tests/Browser"
  php artisan dusk                      => run Dusk tests only (in "/tests/Browser")
  
  # Unit test example => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/tests/Unit/MyTest.php
  # to use Dusk uncomment register in /app/Providers/AppServiceProvider.php
  
  // below is ????
  php artisan dusk:make LoginTest
  
 The visit and see method no longer works in Laravel 5.4 by default. You need to install Laravel Dusk package.
    composer require --dev laravel/dusk

    php artisan dusk:install

composer require laravel/browser-kit-testing --dev

composer require --dev laravel/dusk v1.1    => only this is OK for Laravel 5.4 !!!!!!!!!!!!!!


//update Composer
 c:\users\dima\desktop\server\ospanel\modules\php\PHP_7.2\composer self-update
Updating to version 2.0.8 (stable channel).
Use composer self-update --rollback to return to version 522ea033a3c6e72d72954f7cd019a3b75e28f391
//================================================================================================







//================================================================================================
29. Events/Listeners
  # You can define your custom Events or use a built-in Laravek Event (like login, logout).
  # Custom made Events must be triggered manually (somewhere in Controller). In Listeners u define what to do when Event happens.
  
  # See my working example => Controller/EventsListenersController.php
  
 # Inet Example => https://code.tutsplus.com/ru/tutorials/custom-events-in-laravel--cms-30331
 # Complete List Of Laravel Built-inCore Events => https://mettle.io/blog/complete-list-of-laravel-5-events

 
# How to implement Events/Listeners: 

1. Go to "app/Providers/EventServiceProvider.php" and define your pairs of Events => Listeners in {protected $listen = []}
   protected $listen = [
		 //here is mine defined Events => Listeners
		 'App\Events\SomeEventX'        => ['App\Listeners\EventListenerX', ], //on my SomeEventX run EventListenerX
		 'Illuminate\Auth\Events\Login' => ['App\Listeners\WriteCredentialsToLog',], //on login run WriteCredentialsToLog (event Login is a built Laravel event, we don't have to define it)
    ];
2. Run => php artisan event:generate
   It will generate Event files in folder "/app/Events" and Listeners files in "/app/Listeners". If Event is a built in framework, e.g 'Illuminate\Auth\Events\Login', it won't be generated in  folder "/app/Events"


3. Define in "/app/Listeners/EventListenerX" what u want to do =>
    public function handle(SomeEventX $event) { 
	    dd('Event SomeEventX was fired. Code of action to happen is located in /app/Listeners/EventListenerX');}

3.1 The same way define other Listeners if there are, like "/app/Listeners/WriteCredentialsToLog" (on Login saves username to Log)=> 
     public function handle(Login $event){
         // get logged in user's email and username
        $username = $event->user->name;
		//writing to /storage/log
		Log::info("Listerner WriteCredentialsToLog says: Login at " . date('Y-m-d H:i:s') . " with username " . $username);
    
     
4. In Cotroller trigger the event (if it has to be triggered manually, i.e 'Illuminate\Auth\Events\Login' DOESN'T need manual triggering, it happen on LOGIN itself) =>
      use App\Events\SomeEventX; //event
	  public function triggerEvent()
      {
	    .......
        // here we trigger an event 'App\Events\SomeEventX'
        event(new SomeEventX());

 
 

======= NB about some buil-in Events functionality ====================

Built-in event 'Illuminate\Auth\Events\Login' works like a charm, though a built-in event 'eloquent.deleting' does not work that way.
While trying to emulate Yii2 analogue of beforeDeleted() event I tried to emplement it as specified above in {# How to implement Events/Listeners:} but it did not work. Plus I tried to implement it in App/Traits/trait UserStampsTrait and use this Train in model App/User. It should fire when I manually dellete a user with ID 999, but it does not work.
So, the only working way to emulate Yii2 analogue of beforeDeleted() event is use this code in  model App/User (fires when u delete any user, i.e model User instance) => see example => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/User.php
    public static function boot()
    {
        parent::boot(); 
        static::deleting(function($user) {   
            Log::info("Listener in model App/User says: Deleted User with ID:" . $user->id .  " at " . date('Y-m-d H:i:s') );
        });
    }
    
Plus, there is a bug: {User::where('id',999)->delete();} in Contoller delete an entry but does not fire a Delete Event, it  must be  {User::where('id',999)->first()->delete();} 





//================================================================================================ 
34.Highlight active menu item
 #Highlight active menu item =>  (OR https://medium.com/@rizkhallamaau/create-a-helper-for-active-link-in-laravel-5-6-30827a760593)
     <li class="{{ Request::is('showProfile*') ? 'active' : '' }}">     <a href="{{ url('/showProfile') }}">ShowProfile    </a> </li>
	 <li class="{{ Request::is('EloquentExample*') ? 'active' : '' }}"> <a href="{{ url('/EloquentExample') }}">DB Eloquent </a></li>





//================================================================================================	 
35. Middleware (registered in app/Http/Kernel.php)
My Rbac middleware example  => https://github.com/dimmm931/Laravel_Shop/blob/master/app/Http/Middleware/RbacMiddle.php
Instructions                => https://code.tutsplus.com/ru/tutorials/understand-the-basics-of-laravel-middleware--cms-29147

-----
# if want to get some data first, like user, use firstly => 
     $response = $next($request); 
     //get some data... $token = auth()->user()->api_token;
     return $response;
# If u do return this {return $next($request);} at the end of file at once, u won't get user  => 
-----
Several middlewares => Route::group(['middleware' => ['auth', 'web']],


	 
//================================================================================================	 
35.1 Middleware (CORS example)
For CORS speicifically, see => # Cors in Ajax (Cross-origin resource sharing)(Same-Origin-Policy) => see https://github.com/account931/sms_Textbelt_Api_React_JS/blob/master/README_MY.txt

CORS middleware => https://stackoverflow.com/questions/34748981/laravel-5-2-cors-get-not-working-with-preflight-options
	
	header('Access-Control-Allow-Origin:  *');
    header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
    header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');
	
	
    
    
    
	
//================================================================================================	
36.	Socialite
https://codeguida.com/post/678

#Install             => composer require laravel/socialite
If use Laravel < 5.6 => composer require laravel/socialite "^3.2.0"	

# /config/app.php => add provider and aliase  
# /config/services.php => add  
        'client_id'     => env('FACEBOOK_ID'), 
        'client_secret' => env('FACEBOOK_SECRET'), 
        'redirect'      => env('FACEBOOK_URL'), 
# add values {FACEBOOK_ID, FACEBOOK_SECRET, FACEBOOK_URL}to .env.php  

#Get Facebook appID and secret key => register as a developer => https://developers.facebook.com/ => https://developers.facebook.com/apps

#add column 'fb_id' to Table Users, see migration =>  https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/database/migrations/2021_04_27_144812_add_fb_id_column_in_users_table.php

#Режим "В разработке" is OK to work, localhost is OK too.

# Errors =>
   'The request is invalid because the app is configured as a desktop app' => Tick "No" to "Нативное приложение или приложение для ПК?" (https://developers.facebook.com/apps -> settings/advanced/))
   'This IP can't make requests for that application' => remove IPs from Security-> Список разрешенных IP-адресов сервера               (https://developers.facebook.com/apps -> settings/advanced/)




//================================================================================================
37. Liqpay & Paypal

37.1 Liqpay example (use App\ThirdParty_SDK\LiqPaySDK\LiqPay; +.env credentials) => 
      Controller => public function pay2() => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/ShopPayPalSimpleController.php
      View       =>  https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/views/ShopPaypalSimple/pay-page.blade.php

37.2 Paypal example =>
      View       =>  https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/views/ShopPaypalSimple/pay-page.blade.php

# Or look up more up-to-date Cleansed Shop version (same contoller, view, .env name) at => https://github.com/dimmm931/Laravel_Shop




//================================================================================================
201. Laravel 6 LTS        => (IMPLEMENTED IN {abz_Laravel_6_LTS})

# IMPLEMENTED IN {abz_Laravel_6_LTS}

#Install =>  composer create-project --prefer-dist laravel/laravel blog "6.*"
#Make Auth => 
      composer require laravel/ui "^1.0" --dev
	  php artisan ui vue --auth    (if this requires, do in Win cmd => npm install  var2 => npm install && npm run dev )
	  php artisan migrate


# Yajra Datatables =>  https://www.positronx.io/laravel-datatables-example/
                   =>  https://datatables.yajrabox.com/starter


#Yajra Datatables-2 with CRUD (working) => https://www.webslesson.info/2019/10/laravel-6-crud-application-using-yajra-datatables-and-ajax.html







//================================================================================================

202. Yajra DataTables     => (IMPLEMENTED IN {abz_Laravel_6_LTS})

# IMPLEMENTED IN {abz_Laravel_6_LTS}

 #By default datatables comes with built-in pagination, sorting, searching but without CRUD operation. You have to implement it.

 #IF an error when installing via composer in Laravel < 6, add to composer :
          "require": {
               "yajra/laravel-datatables-oracle": "~6.0"
          }
    After run composer update
	
 # You can implement simple DataTable (with built-in pagination, sorting, searching but without CRUD operation) just in a few lines, see https://github.com/account931/abz_Laravel_6_LTS/blob/main/app/Http/Controllers/AdminLTEController.php => function adminlte() (example of table {users}) + in /views/admin-lte/admin-lte.blade.php  => $('#laravel_datatable').DataTable();
    or you can implement Yajra DataTables with CRUD (that's more complicated, see how to do it in next 202.1 & 203 Chapters)


--------------------------

202.1 My working example of Yajra DataTables with CRUD. 
  In Controller =>  see CRUD example at => YajraDataTablesCrudController.php => https://github.com/account931/abz_Laravel_6_LTS/blob/main/app/Http/Controllers/YajraDataTablesCrudController.php
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Student::latest()->get();
            return DataTables::of($data)
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('yajra-data-tables-crud2.sample_data');
    }
	
#In View => see example at => /views/yajra-data-tables-crud2/sample_data.blade
     <table id="user_table" class="table table-bordered table-striped">
     <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
			<th>Dob</th>
			<th>Image</th>
            <th>Action</th>
        </tr>
     </thead>
    </table>
	
	<script>
    $(document).ready(function(){

        $('#user_table').DataTable({
           processing: true,
           serverSide: true,
           ajax: {
           url: "{{ route('sample.index') }}",
        },
        columns: [
            { data: 'name', name: 'name'},
            { data: 'email', name: 'email' },
            { data: 'dob', name: 'dob' },
   
             //image column
            { data: 'image', name: 'image',
                render: function( data, type, full, meta ) {
                    return "<img src=\"images/students/" + data + "\" height=\"50\"/>";
                }
            },
   
            { data: 'action', name: 'action',orderable: false } //delete/edit column
        ]
        });




   -----------------------------------
   
203. Yajra Datatables with CRUD. How it works => (IMPLEMENTED IN {abz_Laravel_6_LTS})
Detailed explaination of Chapter => 202.1 My working example of Yajra DataTables with CRUD

Controller: YajraDataTablesCrudController.
Models: Abz_Employees, Abz_Ranks.
All js is included in view.

#Display Datatables.
Works as SPA(one page for all CRUD).
On load, main and the only view /views/yajra-data-tables-crud2/sample_data.php sends ajax to YajraDataTablesCrudController/ function index(Request $request). This function handles either return view or return DataTables.

$('#user_table').DataTable({ processing: true, serverSide: true, ajax: { url: "{{ route('sample.index') }}", },//,,,,


#Displaying Superior name column uses hasOne relation (for that we have defined hasOne function in modelsAbz_Employees, then use this function in Controller query ( Abz_Employees::with('getRank', 'getSuperior'), then use it in js =>
        $('#user_table').DataTable({ //...
          columns: [ //....
          { data: 'get_superior.name', name:     'superior_id' },

#If u want add a new column (from SQL results) to datatable:  add new <th> to table + add  new data in js (to columns: [ {data:"new ", name:"new "}//....]

#If u want to add additional action button, e.g "View", do:
   1. Add to controller => return DataTables::of($data)->addColumn('action', function($data){ //..add View button,see exampleat  YajraDataTablesCrudController-> function index()
   2. Add to js,   in views/data_sample.php code to add column (not necessary, if u added prev other action fields for "Upadate", "Delete", etc and agree that new action "View" button will be in one column with "Upadate", "Delete", etc (i.e several action buttons in one Yajra column))
   3. Add to html, in views/data_sample.php a hidden modal, that will represent "View"
   3. Add to js, in views/data_sample.php code that will react on View click, get ajax data, html() ajax success results and show hidden modal


 #On Edit: js shows hidden modal (the same as for Create), sends ajax to function getFormVal($id) and on success html () values to edit form. Uses hasOne relation to get values to edit form.
On cliking submit sends $_Post ajax to

#On Create: js showd hidden modal (the same as for Edit)

#On Delete: js shows modal window to confirm delete, then sends ajax to......



# HOW to add (implement) new input fileds to form to create new / edit existing record=>
  1. Add input to html folr itself
  2. Add SQL column name to model to protected $fillable = []. Considering it already exists in SQl, u just want to be able to edit/store it.
  3. In Controller in relevantvant function (function store(Request $request) or function update(Request $request)) 
      add this form input name to  {$rules = []} and it to 
	   $form_data = array(
            'name'   =>  $request->first_name, //DB column => input name
  4. For edit case, in order to load this field value from SQL to input), add to JS (in ajax success)=> 
        $('#user_rank').val(data.result.get_rank.rank_name); //hasOne realtion





//================================================================================================ 

204. Admin LTE + datatables => https://github.com/jeroennoten/Laravel-AdminLTE
                            https://www.codeandtuts.com/create-admin-panel-using-laravel-adminlte-package/
			                https://www.google.com/search?q=https%3A%2F%2Fwww.codeandtuts.com+yajra+admin+lte&oq=https%3A%2F%2Fwww.codeandtuts.com+yajra+admin+lte&aqs=chrome..69i57j69i58.15029j0j4&sourceid=chrome&ie=UTF-8


# Edit layout menu => config/adminlte.php. If does not refresh => php artisan config:clear


//================================================================================================

205. Laravel Intervention => (IMPLEMENTED IN {abz_Laravel_6_LTS})

  #See example (upload image, resize and move to folder + save to DB) => https://github.com/account931/abz_Laravel_6_LTS/blob/main/app/Http/Controllers/YajraDataTablesCrudController.php at public function update(Request $request)
  # All Intervention methods => http://image.intervention.io/
  
  #Install => composer require intervention/image
  #SetUp   => go to config/app.php .
      return [   
          ......
          $provides => [
              ......
              ......,
              'Intervention\Image\ImageServiceProvider'
          ],
          $aliases => [
              .....
              .....,
              'Image' => 'Intervention\Image\Facades\Image'
         ] ]










//================================================================================================ 
206. Laravel Voyager      => (IMPLEMENTED IN {abz_Laravel_6_LTS})
   https://voyager-docs.devdojo.com/getting-started/installation
   
  # While installing Voyager (without dummy data), it will add (via migration) to existing table {users} fileds 'avatar', 'role_id' + several new tables
    But migration files won't be added to /datatables/migrations/. If u wish, u can copy migrations files from GitHub and run migration in CLI => https://github.com/the-control-group/voyager/tree/1.4/migrations
  
  # Change authentic model /app/User => class User extends \TCG\Voyager\Models\User
  
  # To change views of Voyager, go to => \vendor\tcg\voyager\resources\views






//================================================================================================ 
207. Laravel Gii Crud Generators      => 
1. https://github.com/mehradsadeghi/laravel-crud-generator/blob/master/README.md
   Generates controller only, model must be created manually before, no views generated. Works on fillable[]
       php artisan make:crud UserController --model=User --validation
 
	


#Hand-made Gii example, see => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/ShopPayPalSimple_AdminPanel.php
 or see => CRUD section


    
//================================================================================================ 
355.Miscellaneous VA Laravel



#image =>           <img class="img-responsive my-cph" src="{{URL::to("/")}}/images/cph.jpg"  alt="a"/>
#link a href => 	<li><a href="{{ route('register') }}">Register</a></li>
#link a href with $_GET => <a href="{{route('profile', ['id' => 1])}}">login here</a>
#link with helper => $post = App\Models\Post::find(1);  echo url("/posts/{$post->id}");  Use => <a href ="<?php  echo url("/posts/2"); ?>"> link </a>

# Link by route ID => i.e /edit/156
   In '/routes/web.php'  => Route::get('/showOneProduct/{id}', 'ShopPayPalSimpleController@showOneProductt')->name('showOneProduct');
   In view Var_1 => <a href="{{ route('showOneProduct', ['id'=> 3]) }}">  // ..blog_Laravel/public/showOneProduct/3
   In view Var_2(Best) => <a href="{{ url('/admin-edit-product')}}/{{$productOne[0]->shop_id }}" >
   
   

# Render Controller/View (Active Record / Eloquent) => 
   in Controller=>     
       var 1: use App\users; $f = users::all();        return view('home2', compact('f'));  
	   var 2: use Illuminate\Support\Facades\View;     return View::make('rbac.rbacView')->with(compact('rbacStatus', 'status', 'userX'));
       var 3:                                          return View::make('page')->with('userInfo',$userInfo);
   
   in View =>          foreach ($f as $a){
   
   
	  
#pass several vars => return view('showprofile')->with(compact('id', 'name'));
	  
#isGuest var 1 (in Controller) =>   use Illuminate\Support\Facades\Auth;  if(!Auth::check()){)
#isGuest var 2 (in Controller) =>   public function __construct(){$this->middleware('auth');}
#isGuest var 3 (in routes/web) =>   Route::get('/wpBlogVueFrameWork', 'WpBlog_VueContoller@index') ->name('wpBlogVueFrameWork')->middleware('auth'); 
#isGuest var 4 (in routes/web) => 
    Route::group(['middleware' => 'auth', 'prefix' => 'post'], function () { //url must contain /post/, i.e /post/get_all
        //rotes here....
    });


#check if user is not guest =>  use Illuminate\Support\Facades\Auth; if (Auth::check()) {} => if (Auth::guest()
#ACF Yii2 equivalent, let only logged users, use in Controller =>   public function __construct(){$this->middleware('auth');}


#current user => use Illuminate\Support\Facades\Auth; 
    $user = auth()->user(); //returns array with all DB columns  
	$name = auth()->user()->name;  $id = auth()->user()->id; 


# Turn on debugger => go to .env => APP_DEBUG=true  Variant 2 => in /config/app.php set debug=>true

# js confirm to delete =>  
     <button><a href = 'delete/{{ $a->wpBlog_id }}'> Delete  <img class="deletee" onclick="return confirm('Are you sure to delete?')" src="{{URL::to("/")}}/images/delete.png"  alt="del"/></a></button>
     <button onclick="return confirm('Are you sure to delete?')" type="submit" class="btn">
	 
#Redirect=>
  return redirect()->back()->with('success',"Update successfully");
  return redirect()->back()->withInput()->withErrors($validator);
  return redirect('/wpBlogg')->with('flashMessage',"Record deleted successfully");
  
#Redirect with view with data =>  
    In controller:  return redirect('payPage2')->with(compact('input'));
    get in view:    $input = session()->get('input');  


# Get current route path (returns part after last slash, i.e "testRest")
    use Illuminate\Support\Facades\Route;
    $currentPath= Route::getFacadeRoot()->current()->uri();


#routing =>
    In route/web => Route::get('/multilanguage', 'MultiLanguage@index')->name('multilanguage'); 
    In View => <li class="{{ Request::is('multilanguage*') ? 'active' : '' }}"> <a href="{{ route('multilanguage') }}">MultiLanguage</a></li>

    //example of usage of Middleware and Prefix Group Routing=>
    Route::group(['middleware' => 'auth', 'prefix' => 'post'], function () { //url must contain /post/, i.e /post/get_all
      Route::get('get_all',      'WpBlog_VueContoller@getAllPosts')->name('fetch_all');
    }


#routing with $_GET['id']=>
     When u use url like  => /showOneUser/3
     In route/web => Route::get('/showOneUser/{id}', 'AllUsersEloquent@showOne')->name('showOneUser');
     In controller => function showOne($id){}


# routing with Resource variant =>
    Route::resource('article', ArticleController::class); will generate =>
        Verb        Path                    Action  Route Name
        GET         /article                index   article.index
        GET         /article/create         create  article.create
        POST        /article                store   article.store
        GET         /article/{article}      show    article.show
        GET         /article/{article}/edit edit    article.edit
        PUT/PATCH   /article/{article}      update  article.update
        DELETE      /article/{article}      destroy article.destroy


# ternary =>
$articles = ($yourArticles->count() > 1) ? 'articles' : 'article';
In Blade (in-line) => <p> You have <b> {{$yourArticles->count()}} </b>  {{($yourArticles->count() > 1) ? 'articles' : 'article'}} </p>
                      <p> You have <b> {{$yourArticles->count()}} </b>  {{($yourArticles->count() > 1 || $yourArticles->count() == 0 ) ? 'articles' : 'article'}} </p>

# ternary CSS class=>
     <li class="{{ (isset($_GET['admOrderStatus']) && $_GET['admOrderStatus'] == 'Shipped') ? 'hidden':''}}">

# ternary <select> <option selected="selected"> (see "If LaravelCollective forms fields is cleared after failed validation" =>
	<option value={{ $a->categ_id }} {{ old('product-category')!=null && old('product-category') == $a->categ_id  ?  ' selected="selected"' : '' }} > {{ $a->categ_name}} </option>


# pass php var to js =>
Pass var from controller to view =>  return view('home2', compact('user')); 
  <script>
    var user = {!! $user->toJson() !!};
  </script>
  
# clear cache/reconfig =>  php artisan config:cache <==> php artisan cache:clear 

# class not found => composer dump-autoload

# Exception with html unescapped tags / without escapping ('Bad request, go LOGIN first') => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/ShowProfile.php
  In controller=> $text = 'You are not logged, <a href="'. route('login') . '"> click here  </a>  to login'; throw new \App\Exceptions\myException( $text );
  In View =>  Details: <b>{!! $exception->getMessage() !!}</b>
  
  
# get Date(2020-11-07 16:21:49) => date('Y-m-d H:i:s');

# Logging(logs go to /storage/logs/laravel.log) => use Illuminate\Support\Facades\Log;   Log::info('Showing user profile for user: '. $id . ' User IP is ' . $_SERVER['REMOTE_ADDR']);  
 
# Render partial =>  @include('ShopPaypalSimple.partial.dropdown', ['categ' => $allCategories])  => (will include the view at 'views/ShopPaypalSimple/partial/dropdown.blade.php'

# To prevent users entering get url for post method, i.e if user enter /checkOut manually in browser (use in routes/web.php) =>
        Route::get('/checkOut', function () { throw new \App\Exceptions\myException('Bad request. Not POST request, You are not expected to enter this page.'); });  
  
# Session set => use Illuminate\Support\Facades\Session; Session::put('backUrl', url()->previous());
# Session get => session()->get('backUrl');	

# Get id of new last saved row/Get the Last Inserted Id => $m->save(); $id = $m->id;  see function saveFields_to_shopOrdersMain at example at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/models/ShopSimple/ShopOrdersMain.php
# Get Last saved ID in model Example1 => saveNewProduct($data, $imageName)   => https://github.com/dimmm931/Laravel_Shop/blob/master/app/models/ShopSimple/ShopSimple.php
                             Example2 => saveFields_to_shopOrdersMain($data) => https://github.com/dimmm931/Laravel_Shop/blob/master/app/models/ShopSimple/ShopOrdersMain.php

# gets url route for ajax =>
  1. via js  =>  see example at =>https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/public/js/ShopPaypalSimple_Admin/ajax_count_orders_quantity.js
       var loc = window.location.pathname;
       var dir = loc.substring(0, loc.lastIndexOf('/'));  ///laravel+Yii2_widgets/blog_Laravel/public    
       var urlX = dir + '/count-orders';
  2. via php => see =>  # pass php var to js


# where store API Keys (Works on hosting, does not work on local) => in .env.php =>  SECRET_API_KEY=PUT YOUR API KEY HERE  //use no single quotes!!!
   get key =>   env('SECRET_API_KEY');
   
# how to check laravel version =>   php artisan --version       Check php version =>  php -v


# to register smth in AppServiceProvider => go to app/providers/AppServiceProvider 
# Application Timezone => go to  '/config/app.hp'    =>  'timezone' => 'Europe/Kiev', //'UTC',


# remove file (image) from Folder =>
       //delete an actual image from folder '/images/ShopSimple/'
		if(file_exists(public_path('images/ShopSimple/' . $product->shop_image))){ //check if image exists
		    \Illuminate\Support\Facades\File::delete('images/ShopSimple/' . $product->shop_image);
			$s = ' Image was removed from Folder.';
		} else {
			$s = ' Image removing crashed.';
		}


# Edit form input field, show either old input or value from DB/Session => 
    #Lar built-in way => see "#If LaravelCollective forms fields is cleared after failed validation"
    #Manual way       => <input id="email" type="email" class="form-control" name="email" value="{{ $mailX ? $mailX : old('email') }}" required>
    
    

# Blade template with flashMessageX, flashMessageFailX, with block to display form validation errors, with alert-info block => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/views/tokenGuard/index.blade.php

# Add data to the request->all => 
  $data = $request->all();
  $data['sector_id'] = whatever you want;
  Question::create($data);
  
# Faker => see class Students_Seeder in database/seeder/DataBaseSeeder //In this project. Or example of usage in {abz_Laravel_6_LTS} as Abz_Employees_Seeder

# ElasticSearch equivalent => https://github.com/ErickTamayo/laravel-scout-elastic
    if ($request->has('searcher')) { // equivalent if (isset($search_data) && !empty($search_data) )
        $results = $product->whereRaw(
            "MATCH(product_name,product_id,description) AGAINST(? IN BOOLEAN MODE)",
            [$request->searcher]
        )->get();
        return view('products/search')->with('results', $results);
    } 


# Slug URL via 'cviebrock/eloquent-sluggable' => https://cleverman.org/post/laravel-5-5-i-slug-chto-takoe-slagi-i-zachem-oni-nuzhny
# Docker in 15 min => https://laravel.demiart.ru/dockerizing-laravel-in-15-minutes/

# Change default home route => Route::get('/', ['uses'=>'BandController@index']);

# Redirect from root folder all requests to /public, i.e no need to go to => localhost, then choose /public => Create in root file .htaccess => 
Options -MultiViews
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ public [L]

# Moving Controllers to Sub folders /move Controllers to separate folder (controller in subfolder)
 1. append the folder name in the namespace => namespace App\Http\Controllers\Panel;
 2. Add "use App\Http\Controllers\Controller;" to the controller => 
 3. Route => Route::get('foo','Panel\PanelController@anyaction');

# Return redirect from model => In controller u have to return model's method =>
    In Controller => return $model->addOrRemoveItmemsFromCart($request);
    In model      => function addOrRemoveItmemsFromCart($request){....return redirect('/shopSimple')->with('flashMessageFailX', 'Product <b> ' . $productOne[0]->shop_title . ' </b> was deleted from cart' );
}


# Errors "Class not found " while => new DOMDocument('1.0'); new SimpleXMLElement();
 Use global namespace => new \DOMDocument('1.0');









//================================================================================================
356.Miscellaneous VA HTML/CSS

# bootstrap => <div class="col-lg-3 col-md-3 col-sm-4">  <div class="col-sm-4 col-xs-4"> => Pc/mobile
    .xs (phones), .sm (tablets), .md (desktops), and .lg (larger desktops) 
    .col- (extra small devices - screen width less than 576px)
	.col-sm- (small devices - screen width equal to or greater than 576px)
    .col-md- (medium devices - screen width equal to or greater than 768px)
    .col-lg- (large devices - screen width equal to or greater than 992px)
    .col-xl- (xlarge devices - screen width equal to or greater than 1200px)
	
# bootstrap 3 hidden/visible on mobile  => .hidden-xs	visible-xs
# bootstrap 3 hidden/visible on desktop  => .hidden-sm	visible-sm  
                                           .visible-inline-xs is used to display on the same line not next 
										   
# Line => <hr>

#Panel Styling =>
<div class="panel panel-default">
    <div class="panel-heading">text</div>
	<div class="panel-heading">text</div>
</div>

 # Bootstrap small red font-size =>  <span class='small font-italic text-danger'>
 
/* ---------------------------------------- Mobile */
@media screen and (max-width: 480px) { 
    .my-one {width:100%;} /* my shop image*/
}
 

# To close bootstrap collapsed responsive menu on menuItem click => Simply add the properties on main div as such, like on the MENU button => <div class="nav-collapse collapse" data-toggle="collapse"  data-target=".nav-collapse">


 /* ---- Shadow CSS */
.shadowX {
	box-shadow: 0 1px 4px rgba(0, 0, 0, .3),
                -23px 0 20px -23px rgba(0, 0, 0, .6),
                 23px 0 20px -23px rgba(0, 0, 0, .6),
                inset 0 0 40px rgba(0, 0, 0, .1);
}




//================================================================================================
357.Miscellaneous Php (to move to Yii2 ReadMe)

//================================ Move to Yii2 ReadMe =============================

---------------------- PHP ----------
# Php Types: 8 primitive data types: 4 scalar types: Integer, Float, String, Booleans; Array, Object, resource and NULL
     + iterable pseudo-type (PHP 7.1) => (function x(iterable $myIterable)) function getIterable():iterable {return ["a", "b", "c"];}
     + callable pseudo-type (anonymous function {$x = function ($a) {return $a * 2;}}, a string containing the name of a function. )

# Type Hinting => function x(string $arg){}  function x(callable $callable) {$callable();}

# Return type declarations => function arraysSum(array ...$arrays): array {}

# Php Closure (also known as anonymous function) => 
            $example = function () use ($message) {var_dump($message);}; $example(); //setting global scope
            $greet = function($name){}; //anonymous function
            $a=array(1,2,3,4,5); $x2 = array_map(function($v){return $v + 1;}, $a);//anonymous function as a callback

# Access global variable (u can pass it as param or in funct {global $data;} or use in Closure)=>
  $data = 'My data';
  $menugen = function() use ($data) {echo "[".$data."]";};
            
# Null coalescing operator (php 7.0) =>  just isset() in a handy operator => $foo = $bar ?? 'something';  EQUALS $foo = isset($bar) ? $bar : 'something';
                        assign value => return $cache['key'] ??= getSomeVal('key')
# Nullable types => defines ?int as either int or null => function nullOrInt(?int $arg)

# Array search examples
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

# UUID => function generateUUID($length=10) {$this->UUID = "sh-" . time() ."-". substr( md5(uniqid()), 0, $length);  return $this->UUID;}

# Check if not null => if($value->master && $value->master !== null)

# Authentication(login/pass) vs authorization (Rbac)

#function return multiple/several values => https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/models/BookingCph.php
    function some(){return array($a, $b);}  $r = some(); $value1 = $r[0]; $value2 = $r[1];  
    function some(){return array('a'=> $a, 'b'=> $b);}  $r = some(); $value1 = $r['a']; $value2 = $r['b'];

# GD Library, save text to image =>  public function index() => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/CaptchaController.php





=======================================================================
357.1 Miscellaneous Untitled (Git, etc)


#Github Readme.md => Markdown is a lightweight markup language => See example => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/readme_template_example.md
Create Anchor => 
    - [1. Go to My Acnchored Section 1](#1-real-cool-heading1)    ## 1. Real Cool Heading1
   Some my text
   
 to test what my readme.md file will look like before committing to github => http://tmpvar.com/markdown.html
 see my example => /root/readme_template_example.md

# Add image to Readme.md =>  ![Screenshot](folderName/screenshot.png)

# Conventional Commits (git-flow) => 
   example=>
   fix(products): поправить длину строки с ценой
   Часть заголовков неправильно отображается в мобильной версии из-за ошибокв проектировании универсальных компонентов.

 type=>
  build	 => Сборка проекта или изменения внешних зависимостей    ci	 => Настройка CI и работа со скриптами
  feat  =>Добавление нового функционала     fix  => Исправление ошибок
  docs  => Обновление документации          perf => Изменения направленные на улучшение производительности  
  refactor => Правки кода без исправления ошибок или добавления новых функций  revert  => Откат на предыдущие коммиты
  style	=> Правки по кодстайлу (табы, отступы, точки, запятые и т.д.)             test => Добавление тестов

# phpdoc => 
    /* @var $this yii\web\View */
    /* @var $searchModel \app\models\search\UserSearch */
    /* @var $dataProvider yii\data\ActiveDataProvider */
	
	/**
     * Saves the current record.
     * @param boolean $runValidation whether to perform validation before saving the record.
     * @param array $attributeNames list of attribute names that need to be saved.
     * @return boolean whether the saving succeeded (i.e. no validation errors occurred).
	 * @return void
     */
     
     
	 

# Github tab/space/indentation problem => create a file in the project root named “.editorconfig” and give it the following contents (or ?ts=4) => 
  [*]
  indent_style = tab
  indent_size = 4

# Edit last commit  => git commit --amend

# Git track directories/folder but not their files (e.g folder with images) =>
 to include a .gitignore file in your upload folder with this content
   # Ignore everything in this directory
   *
   # Except this file
   !.gitignore

# git change default master to main  => https://stevenmortimer.com/5-steps-to-change-github-default-branch-from-master-to-main/

# git: how restore/save files if you removed 2 last commits with  git reset --hard HEAD~2
      git reflog   => it 'll display all commits which are/were created in your repository - after this you should checkout to removed commit by checkout command
      git checkout <your commit-SHA>

# git: when try to git add . , gets error => Unable to create '...git/index.lock': File exists.
    Solution: run => rm -f ./.git/index.lock
	
	
	
# git: check repo consistency => { git fsck } , if "error: refs/remotes/origin/master: Invalid sha1 pointer", do {git pull} and create new commit as usual (git add .  git commit)
	
	
	

#RegExp regular expression Php =>  
    # if (!preg_match($RegExp_Phone, $phone)), returns 1 if a match was found,or 0
    # preg_replace('/microsoft/i', 'W3Schools', $str); Returns a string or an array of strings
    #if(preg_match_all("/ain/i", $str, $matches)), returns the number of matches or FALSE and populates a variable $matches with the matches 
    
    $RegExp_Phone = '/^[+]380[\d]{1,4}[0-9]+$/'; //phone regexp
    $RegExp_Phone = '/^[+]380\([\d]{1,4}\)[0-9]+$/'; //old var
    $RegExp_Name='/^[a-zA-Z]{3,16}$/'; //name, min 3, max 16
    $RegExp_Email='/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/';
    

#RegExp JS  => 
    # test()  {RegExpPattern.test(string);} tests for a match in a string,  returns true if it finds a match or False 
              var patternX = /details-info\/[0-9]+/g;  //RegExp if (patternX.test(from.path)){ 
    # match() {string.match(/ain/g);}      method searches a string,  returns the matches, as an Array object or null
    # replace() var res = str.replace("oldWord", "newWord");
    
    var RegExp_Phone = /^[+][\d]{8,9}[0-9]+$/; //phone number regExp for world wide
	var RegExp_Phone_UA = /^[+]380[\d]{2}[0-9]{7}$/; //phone number regExp for Ukraine //must have strict +380 & 9 digits ///^[+]380[\d]{1,4}[0-9]+$/;
    //from blankspace
    var RegExp_PlsKnow = /please (know||note) (?!that)\w*/gi;
    var numbComma      = (textarea.match(/ \,+/g) || []).length; //count space+comma
    var numbDot        = (textarea.match(/ \.+/g) || []).length; //count space+dot
    var doubleWords    = (textarea.match(/\b(\w+)\s+\1\b/g) || []).length; // count all consecutive duplicate words
    var doubleCommas   = (textarea.match(/(\,\,+)/g  ) || []).length; // count all consecutive duplicate commas (i.e ",,")
    var doubleDots     = (textarea.match(/(\.\.+)/g  ) || []).length; // count all consecutive duplicate dots (i.e "..")




# see ajax => F12 => Network -> XHR
# View POST in Chrome F12 (e.g for ajax see form submit) => Network" tab => refresh => select POST in left =>  Choose "Headers" tab ("All" must be selected )
# View Server Response(e.g e.g for ajax to see dd() ) in Chrome F12 => Network" tab => click/select the Request under "Name" => Response. On server-side do => var_dump($request->all(), true); die();
           => or click "Preview" to see raw Server response
# View Cookies => in Chrome =>  Network" tab => click/select the Request under "Name" => Cookies







=======================================
357.2 Miscellaneous JS 


---------------------- JS ----------
# JS Array Vs JS Object iteration methods => Map, Each etc

 //jQuery each function (iterate over Array)
 someArray = ["image1", "image2", "image3", "image4"];
 $.each(someArray, function (index, value) {
    formData.append(`imagesZZZ[${index}]`, value);
    //imagesUploaded.push(`images[${index}]`, value);
  });

  
  //Array (pure JS)
  someArray.forEach(function(item, i, arr) {
     alert( i + ": " + item + " (массив:" + arr + ")" );
  });

  //Array (pure JS)
  var nameLengths = someArray.map(function(name, i) {
      return name.length;
  });
  
  //Object (pure JS)
  for (let key in obj) {
     console.log(key, obj[key]);
  }
  
  //jQuery each function (iterate over Object)
  var obj = {one: 1, two: 2, three: 3, four: 4, five: 5};
  $.each(obj, function (index, value) {
     console.log(value);
  });
-----

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
 

#//How to Toggle Password Visibility =>  https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/public/js/login/login.js  or if it was Gulp Webpacked =>  at /resources/assets/

# To show Bootstrap modal window by default => add class "in show" => div class="modal fade in show"

# Use {toFixed(2)} to return 33.00 not 33.0008 =>  $(this).parent().next().html((numProduct*price).toFixed(2)); 


# Makes Grid table to be wide with scroll => <div class="col-sm-12 col-xs-12" style="width:80em;overflow-x: scroll;">

# Sweet alerts with html tags => see example at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/public/js/rbac/my-rbac.js or at /resources/assets/		       
swal({html:true, title:'Attention!', text:'User has already selected role <b> ' + selectedRoleText + ' </b>.</br>  Back-end validation is also available.', type: 'error'});

# Prevent and send form with Sweet alerts confirm dialogue => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/public/js/rbac/my-rbac.js  or if it was Gulp Webpacked =>  at /resources/assets/


# Swal Sweet Alert not waiting until user clicks ok => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/public/js/rbac/my-rbac.js or relevant at at /resources/assets/ . See section => $(document).on("click", '.detach-role', function(e)

#  Convert a JavaScript object into a string =>  alert(JSON.stringify(data, null, 4))  

# Fix to load image via ajax, serialize() wont't work =>  var formData = new FormData(this);  see example => https://github.com/account931/abz_Laravel_6_LTS/blob/main/resources/views/yajra-data-tables-crud2/sample_data.blade.php

# If LightBox Controls are not visible, make sure to load folder image from GitHub LightBox ->src->images. Insert it in CSS folder connected to your page.

# to populate <input type="file"> with JS, (on click "+", adds/creates a new <input> => see #Example_2 (upload multiple images as array + form with input population)
Inet example => https://appdividend.com/2018/02/05/laravel-multiple-images-upload-tutorial/
     => see \blog_Laravel\resources\views\wpBlog_Images\create.blade.php + \blog_Laravel\public\js\Wpress_ImagesBlog\wpress_blog.js
     => consider adding to html <div class="increment"> and <div class="increment"> + 4 lines of js

	 
# Preview an image before it is uploaded (when u select image in <input type="file">) =>  \blog_Laravel\public\js\Wpress_ImagesBlog\wpress_blog.js

# fetch http example (with then promises)       => https://github.com/account931/Laravel_Vue_Blog_V6_Passport/blob/main/resources/assets/js/store/index.js
# axios example and difference from fetch      => https://github.com/account931/Laravel_Vue_Blog_V6_Passport/blob/main/resources/assets/js/store/index.js

//with animation
$("#game").stop().fadeOut(/*"slow"*/ 200 ,function(){  $(this).html(result)}).fadeIn(2000);






//================================ End Move to Yii2 ReadMe =============================

//================================================================================================















//================================================================================================
358.Known Errors

# Error "Unknown Column 'updated_at' => public $timestamps = false; //put in model to override Error "Unknown Column 'updated_at'" that fires when saving new entry
2 =>     /**
          * The primary key associated with the table.
          * @var string
          */
         protected $primaryKey = 'wpBlog_id'; //to show Laravel what id column is 'wpBlog_id' not 'id'        // override in model autoincrement id column name
         protected $table      = 'wpress_blog_post'; //specify the DB table table
		 protected $fillable   = ['wpBlog_author', 'wpBlog_title', 'wpBlog_text', 'wpBlog_category']; //specify fields for mass assignment

# Error "Specified key was too long; max key length is 767 bytes" => see 9.Migrations/Seeders

# Error "TokenMismatchException" while form submitting => 
   change 	<input type="hidden" value="{{ csrf_token() }}" name="_token{{$loop->iteration}} " /> to   {!! csrf_field() !!}



========================== New application, moving, migrate to hosting ===============
# Error after install & migrate new Laravel 
"The only supported ciphers are AES-128-CBC and AES-256-CBC with the correct key lengths. laravel 5.3

  You need to have .env on your appication then run: => $ php artisan key:generate  +  $  php artisan config:cache
  If you don't have .env copy from .env.example: =>   $ cp .env.example .env

# If u encounter this error on hosting (after migrate to hosting) "The only supported ciphers are AES-128-CBC and AES-256-CBC with the correct key lengths => 
   go /config/app.php and re-set .env APP_KEY value =>
   'key' => env('APP_KEY', 'base64:BSaw42CbRqRLo19TWc9ICD7XZzuhfqzf5lxwVzpTztQ='), //instead of 'key' => env('APP_KEY'),  // 'base64:BSaw42CbRqRLo19TWc9ICD7XZzuhfqzf5lxwVzpTztQ=' is a {APP_KEY} from .env

# If error on hosting "SQLSTATE[HY000] [2002] Connection refused within Laravel homestead" => 
  go /config/database.php and re-set .env DB values =>
      'host' => env('DB_HOST', 'localhost'),
      'port' => env('DB_PORT', '3306'),
      'database' => env('DB_DATABASE', 'id1611*******'),
      'username' => env('DB_USERNAME', 'id161********'),
      'password' => env('DB_PASSWORD', 'fghdgf********),
 
# If error after install new package and moving to hosting => check vendor folders with today's date
===========================================



# If can not type in form input => add to form CSS rule {z-index: 9999;}

# Error "Can't redeclare class" => check namespace (like it was with Enrtrust Role model), see details at => 17. RBAC 

# Error "Call to a member function hasRole() on null" => in my case happened, when being unlogged refered to {$user = auth()->user();}  and tried to use {if ($user->hasRole('admin'))}

# Error  "This cache store does not support tagging" => happens due Entrusr Rbac,  in .env file change {CACHE_DRIVER=file} to {CACHE_DRIVER=array}

# Error, when generating multiple <form> in foreach loop. the first form was never submitted, all the rest form were submitted OK (example in RBAC table Delete Form and Assihn new role Form).
  The solution => before 1st form add empty <form></form>

# CSS error if Bootstrap modal appearing under background =>  .modal-backdrop { z-index: -1;}

# $_POST => simple rule to make your life easier... NEVER return a view in response to a POST request. Always redirect somewhere else which shows the result of the post or displays the next form.

# Laravel view not found on production Server => Just delete all files in the bootstrap/cache folder of the server. Now the server will not use the cache of the localhost.

# Laravel does not show images on production server => causes the same folder /bootstrap/cache. Run on local {php artisan cache:clear} then {php artisan optimize} and  re-upload /bootstrap/cache to server. {php artisan optimize} will optimize command which will re-build your configuration cache, bootstrap file cache and route

# Faker won't produce image in seeder => upgrade Faker to version 1.9.1 in composer.json =>
    "require-dev": {
        "fakerphp/faker": "^1.9.1",
		
# 'unserialize(): Error at offset 0 of 40 bytes Error' => php artisan config:clear   php artisan view:clear   php artisan key:generate

# Collapsed Bootstrap main toggle menu won't open on click => 
   move Bootstrap script from <head> to bottom (after  @yield('content')</div>)(in views/layouts/app.blade.php) =>
          <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> -->  
		  
# Error 'In PackageManifest.php line 122: Undefined index: name' =>
     go to vendor/laravel/framework/src/Illuminate/Foundation/PackageManifest.php
     Find this line and comment it:
         $packages = json_decode($this->files->get($path), true);
     Add two new lines after the above commented line:
         $installed = json_decode($this->files->get($path), true);
         $packages = $installed['packages'] ?? $installed;
		 
# Error when 'Element-UI' (Vue 2.0 based component library) is used in Vue, but does not show icons, even though main CSS is imported in start Vue.js file, e.g{import 'element-ui/lib/theme-chalk/index.css';} => 
    1.Copy folder '/theme-chalk' (which contains index.css and other files) from '/node_modules/element-ui/lib/theme-chalk/' to some your css folder, e.g to 'css/Wpress_Vue_JS/Element_UI/theme-chalk'
	2.Add this css manually in '/layout.app.css' or in view directly =>
         <link  href="{{ asset('css/Wpress_Vue_JS/Element_UI/theme-chalk/index.css') }}" rel="stylesheet"> <!-- Elememt UI icons  -->


# Two Laravel applications Login Conflict => when u log in to 1st Laravel app, the 2nd automatically log out & vice versa
  I.e synonyms: "Session conflicts with multiple Laravel projects on one server" or "Multiple laravel project in the same server session auth conflict"
  To fix add to config/session.php and set Unique cookie name => 
      'cookie' => 'laravel_session_SOME_UNIQUE_NAME',
	  
# 405 Method is not allowed, 500 (Internal Server Error) on ajax POST  => 
     CORS issue, to fix didn't required adding HEADERS to REST Controller, just a correct ajax request, including csrf-token in data{}, see example in =>  https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/resources/assets/js/WpBlog_Vue/components/CreatePost.vue


# Click does not work in mobile  => 
    Solution 1 => style="position:relative; z-index:9999999999;"
	Solution 2 => on IOS, safari JS click fix => add empty {onClick}  => <span onClick="" id="someID"></span>   OR => cursor: pointer;

# Laravel notify toasts are hidden by menu bar => wrap  @include('notify::messages') in <div style="position:relative;z-index:99999999999999999;"></div>	

# Error => Out of memory (allocated 1570766848) (tried to allocate 4096 bytes) 
    => COMPOSER_MEMORY_LIMIT=-1 composer install
    
# JS Error => ajax formdata : Illegal invocation => add to ajax =>
      processData: false,
      contentType: false   
      
# JS Webkitformboundary when sending Formdata via ajax POST =>
   set up tha ajax correctly, see example at => https://github.com/account931/Laravel_Vue_Blog/blob/main/resources/assets/js/WpBlog_Vue/components/pages/loadnew.vue
 

# Error "Undefined Class Constant App\Providers\RouteServicProvider::Home" when trying to get all routes list with {php artisan route:list} => 
    add to App\Providers\RouteServiceProvider.php => public const HOME = '/home';


# ErrorException file_put_contents failed to open stream: No such file or directory =>  php artisan cache:clear    php artisan config:cache

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














//================================================================================================

400.SOLID principles
S - Single-responsiblity Principle => 
    A class should have one and only one reason to change, meaning that a class should have only one job.

    #BEFORE SOLID =>

    class Order
    {
	    public function calculateTotalSum(){/*...*/}  public function getItems(){/*...*/}
	    public function addItem($item){/*...*/}       public function deleteItem($item){/*...*/}

	    public function printOrder(){/*...*/}         public function showOrder(){/*...*/}

	    public function load(){/*...*/} public function save(){/*...*/} public function update(){/*...*/} public function delete(){/*...*/}
    }

  #AFTER SOLID =>

    class Order
    {
	    public function calculateTotalSum(){/*...*/}
	    public function getItems(){/*...*/}      public function getItemCount(){/*...*/}
	    public function addItem($item){/*...*/}  public function deleteItem($item){/*...*/}
    }

    class OrderRepository
    {
	    public function load($orderID){/*...*/} public function save($order){/*...*/}
	    public function update($order){/*...*/} public function delete($order){/*...*/}
    }

    class OrderViewer
    {
	    public function printOrder($order){/*...*/} public function showOrder($order){/*...*/}
    }
	
-------------------------
O - Open-closed Principle => 
    Objects or entities should be open for extension but closed for modification (engages to Dependency injection)
    #BEFORE SOLID =>
	    class OrderRepository
        {
	        public function load($orderID) {
		        $pdo = new PDO($this->config->getDsn(), $this->config->getDBUser(), $this->config->getDBPassword());
		        $statement = $pdo->prepare('SELECT * FROM `orders` WHERE id=:id');
		        $statement->execute(array(':id' => $orderID));
		        return $query->fetchObject('Order');	
	        }
	        public function save($order){/*...*/}
	        public function update($order){/*...*/}
	        public function delete($order){/*...*/}
        }
		
	#AFTER SOLID =>
	    class OrderRepository
        {
	        private $source;
	        public function setSource(IOrderSource $source){ $this->source = $source; }
	        public function load($orderID){ return $this->source->load($orderID); }
	        public function save($order){/*...*/}
	        public function update($order){/*...*/}
        }

        interface IOrderSource
        {
	        public function load($orderID);  public function save($order);
	        public function update($order);  public function delete($order);
        }

        class MySQLOrderSource implements IOrderSource
        {
	        public function load($orderID);          public function save($order){/*...*/}
	        public function update($order){/*...*/}  public function delete($order){/*...*/}
        }

        class ApiOrderSource implements IOrderSource
        {
	         public function load($orderID);         public function save($order){/*...*/} 
			 public function update($order){/*...*/} public function delete($order){/*...*/}
        }
-------------------------
L - Liskov Substitution Principle => 
    Every subclass or derived class should be substitutable for their base or parent class.
-------------------------
I - Interface Segregation Principle => 
    A client should never be forced to implement an interface that it doesn’t use, or clients shouldn’t be forced to depend on methods they do not use.
-------------------------
D - Dependency Inversion Principle => 
    Entities must depend on abstractions, not on concretions. It states that the high-level module must not depend on the low-level module, but they should depend on abstractions.
    (Abstraction should not depend on details, details must depend on abstractions)
	
	
	
	
	
	
	
//================================================================================================
401.Design Patterns
Creational(to create objects while hiding the creation logic) => Builder, Singleton, Factory, Prototype
Structural(concern class and object composition) => Adapter, Bridge, Facade, Decorator 
Behavioral(communication between objects) Patterns  => Chain of responsibility, Observer, Strategy, Iterator, Visitor
Порождающие, Структурные, Поведенческие 

401.1 Singleton
     class Singleton
     { // object instance
         protected static $instance;
 
         private function __construct(){
		      try {
			      $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
                  // set the PDO error mode to exception
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); echo "Connected successfully";
              } catch(PDOException $e) { echo "Connection failed: " . $e->getMessage();}
		 }
         private function __clone(){}
         private function __wakeup(){}

         public static function getInstance(){
             if (is_null(self::$instance)) {
                 self::$instance = new self;
             }
            return self::$instance;
         }

         public function doAction(){/* ... */) }
		 
		 Singleton::getInstance()->doAction();
------------------------------------------------
402.2 Strategy => поведенческий шаблон, similar to Dependency injection

------------------------------------------------
402.3 Factory method
    class Position{
        public $x; public $y;
    }
    class ShapeFactory{
        public function create($class, $position){
            return new $class($position);
        }
    }
    $pos = new Position;
    $pos->x = 34;
    $pos->y = 55;
    $shape = new ShapeFactory;
    $rect = $shape->create("Rectangle", $pos);
    var_dump($rect);
	
------------------------------------------------
402.4 Abstract Factory
    class MySQLConn {
        public function __construct() { echo "MySQL Database Connection" . PHP_EOL;}
        public function select() { echo "Your mysql select query execute here" . PHP_EOL;}
    }

    class OracleConn {
        public function __construct() { echo "Oracle Database Connection" . PHP_EOL; }
        public function select() { echo "Your oracle select query execute here" . PHP_EOL; }
    }
	
	class DBFactory {
        public static function getConn($dbtype) {
                switch($dbtype) {
                        case "MySQL":  $dbobj = new MySQLConn();  break;
                        case "Oracle": $dbobj = new OracleConn(); break;
                        default:       $dbobj = new MySQLConn();  break;
                }
                return $dbobj;
        } }
        //Usage=> User just need to pass the name of the database type
        $dbconn1 = DBFactory::getConn("MySQL");
        $dbconn1->select();
		
------------------------------------------------
402.5 Dependency injection => pattern uses principle of IoC (Inversion Of Control). 
Can be done via constructor => function __construct($service){$this->service = $service;} Or via setter => function setService($service){$this->service = $service;}
    #BEFORE Dependency injection
	    class Service{ 
		    private $data; private $key;
            function __construct ($key) {$this->key = $key;}
		}
		class App{    
			function __construct(){$this->service = new Service();
		}
		
	    $app = new App('789');
		
	#AFTER Dependency injection
	class App{
        protected $service;
        function __construct(Service $service){ $this->service = $service; }
        // ...
    }

    $service = new Service('777');
    $app = new App($service);

------------------------------------------------

402.6 Service Container, Injection Dependency Container, IoC Container or Injector =>  объект, который знает, как создавать и настраивать объекты
    class Container
    {
        protected $parameters = array();
        public function __construct(array $parameters = array())
        {
            $this->parameters = $parameters;
        }

        public function getSomeService()
        {
            return new Service(
            $this->parameters['option1'],
            $this->parameters['option2']
            );
        }  
    }

    $container = new Container(array(
        'option1' => 'foo',
        'option2' => 'bar'
    );
    $service = $container->getSomeService();


------------------------------------------------
402.7 Facade => is used to hide complecated realisation in one class. If we have 10 classes and 10 methods to run, just create one Facade to run them all 
    class Controller  // (this is Facade)
    {
        function __construct(){
	        $this->model = new Model(); // create onw Class
	        $this->view = new View();   // create other
        }
 
        function run(){  
		    $this->model->getData();  $this->view->render();
        }
    }
------------------------------------------------
402.8 Repository 
=> https://heera.it/laravel-repository-pattern#.VuJcVfl97cs
=> https://coderius.biz.ua/blog/article/repozitorij-repository-pattern-sablon-proektirovania-v-php

NB: this example is not 100% Repository, better look for Repository example at => O - Open-closed Principle => 

 #Example of Repository Pattern (Controller -> Service Layout -> Repository -> Model) => see example at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/ServiceLayoutController.php
 Instead of this in Controller:
    public function getAllUsers(){
        $users = User::all();
        return View::make('user.index', compact('users'));
    }
    
 #Repository Pattern:
    
    namespace App\Interfaces;
    interface IUserRepository {
        public function getAllUsers();
        public function getUserById($id);
        public function createOrUpdate($id = null);
    }
    
    namespace App\Repositories;
    use App\User;
    use App\Interfaces\IUserRepository;
    
    class UserRepository implements IUserRepository {
        public function getAllUsers(){ return User::all(); }
 
        public function getUserById($id){ return User::find($id); }
 
        public function createOrUpdate($id = null){
        if(is_null($id)) {
            // create after validation
            $user = new User;
            $user->name = 'Sheikh Heera'
            $user->email = 'me@yahoo.com';
            $user->password = '123456'
            return $user->save();
        }
        else {
            // update after validation
            $user = User::find($id);
            $user->name = 'Sheikh Heera'
            $user->email = 'me@yahoo.com';
            $user->password = '123456'
            return $user->save();
        }
    }   }
    
    namespace App\Http\Controllers;
    use App\Interfaces\IUserRepository;
    class ServiceLayoutController extends Controller {
        protected $user = null;
    
        // IUserRepository is the interface
        public function __construct(IUserRepository $user){ 
            $this->user = $user; }
 
        public function showUsers(){
            $users = $this->user->getAllUsers();
            return View::make('user.index', compact('users'));
        }
 
        public function getUser($id) {
            $user = $this->user->getUserById($id);
            return View::make('user.profile', compact('user'));
        }
 
        public function saveUser($id = null){
            if($id) {
                $this->user->createOrUpdate($id);
            } else {
                 $this->user->createOrUpdate();
            }
        // return redirect...
    } }
 
    # Create MyServiceProvide => App\Providers\MyServiceProvider => see https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Providers/MyServiceProvider.php
        namespace App\Providers;
        use Illuminate\Support\ServiceProvider;
        class MyServiceProvider extends ServiceProvider {
        public function register() {
            $this->app->bind('App\\Interfaces\\IUserRepository', 'App\\Repositories\\UserRepository');
        } }
    # Register MyServiceProvide in /config/app.php in 'providers' => [
         App\Providers\MyServiceProvider::class,
         
         
         
         
         
         
         
       
------------------------------------------------
402.9 Observer, Adopter, Decorator => https://medium.com/@ivorobioff/the-5-most-common-design-patterns-in-php-applications-7f33b6b7d8d6


-------------------------------------------------

402.10 Service Layer => ("S" in SOLID). 
Never use models directly into the controllers. Use Service Layer to contain the business logic.
Service Layer is a design pattern that will help you to abstract your logic. Actually, you delegate the application logic to a common service (the service layer) and have only one class to maintain.
https://m.dotdev.co/design-pattern-service-layer-with-laravel-5-740ff0a7b65f?gi=7be9d92be90a
https://habr.com/ru/post/547510/
https://habr.com/ru/post/350778/  pizza

EXAMPLE => see https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/ServiceLayoutController.php
namespace App\Services;
use App\Models\Bar;
class MyService
{
    public function foo(Bar $bar) {
       // do things
    } }
  
  
namespace App\Http\Controllers;
use App\Services\MyService;
use App\Models\Bar;
class MyController extends Controller
{
    protected $myService;
    public function __construct(MyService $myService) {
        $this->myService = $myService;
    }

    public function handleRequest(Bar $bar){
        $this->myService->foo($bar);
    } }


-----------------------------------
402.11 Service providers 
are the central place of all Laravel application bootstrapping. Your own application, as well as all of Laravel's core services, are bootstrapped via service providers.





//================================================================================================
402.Used Laravel Packages
 1. Laravel Notify           => https://github.com/mckenziearts/laravel-notify
 2. Mews\Captcha             => https://github.com/mewebstudio/captcha     
 3. Zizaco/Entrust
 4. Laravel yajra datatables => https://github.com/yajra/laravel-datatables  => composer create-project laravel/laravel laravel-yajra-datatables --prefer-dist
 5. Admin LTE + datatables   => https://github.com/jeroennoten/Laravel-AdminLTE
 6. Crud Generator           => https://github.com/mehradsadeghi/laravel-crud-generator/blob/master/README.md
 7. LaraAppointments         => https://github.com/LaravelDaily/LaraAppointments-QuickAdminPanel
 8. Voyager Admin Panel
 9. Socialite
 10. Spatie Laravel Permission => https://spatie.be/docs/laravel-permission/v4/introduction
 11. Laravel Intervention (not package, just using Intervention Library in Laravel )
 12. Passport Api
 
 #Pending: Passport, Avored, Aimeos, appzcoder/crud-generator, Zofe_Rapyd


  /*
  |--------------------------------------------------------------------------
  | when user clicks NEXT button
  |--------------------------------------------------------------------------
  |
  |
  */