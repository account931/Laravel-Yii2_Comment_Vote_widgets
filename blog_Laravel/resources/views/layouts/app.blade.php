<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSS Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/my_css.css') }}" rel="stylesheet"> <!-- My CSS Styles -->
	
	
	<!-- Bootsrap -->
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> -->  
	<!-- Bootsrap -->
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	
	<!-- Fa Library -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right black">
					
					
					 <!-- Common links (make link highlighted )-->
					 <!--<li><a href="{{ route('register') }}">Gii</a></li>-->
					 <li class="{{ Request::is('showProfile*') ? 'active' : '' }}">     <a href="{{ url('/showProfile') }}"> MyProfile </a></li>
					 <li class="{{ Request::is('EloquentExample*') ? 'active' : '' }}"> <a href="{{ url('/EloquentExample') }}">All users ORM </a></li>
					 
					 <li><a href="api/articles {{--$_SERVER['SERVER_NAME']. '/api/articles' --}}">Rest</a></li><!-- Corrupted way for link-->
					 <li class="{{ Request::is('testRest*') ? 'active' : '' }}">  <a href="{{ url('/testRest') }}">Test Rest </a></li>
					 
					 <li><a href="{{ route('register') }}">Ajax(N/A)</a></li>
					 
					 <li class="{{ Request::is('wpBlogg*') ? 'active' : '' }}"> <a href="{{ route('wpblog') }}" > WPress </a> </li> <!-- NOTE: name vs route -->
					 
					 <li><a href="{{ route('register') }}">Gii(N/A)</a></li>
					 
					 
					 
					 
					 <!-- DropDown manual. NOT USED FOR LINKS -->
					 <li><a class="navbar-nav1" href="#">Drop <span class="caret"></span></a>
					     <ul class="dropdown-submenu">
						     <li><a href="#">Drop 1</span></a>
							 <li><a href="#">Drop 2</span></a>
						 </ul>
					 </li>
					 <!-- END DropDown manual -->
					 
					 
					 
					<!---------- Submenu DropDown!!!! (Bootsrap) ------------------>
					<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Submenu<span class="caret"></span>
                        </a>
						
                        <ul class="dropdown-menu" role="menu">
                            <li class="{{ Request::is('multilanguage*') ? 'active' : '' }}"> <a href="{{ route('multilanguage') }}">MultiLanguage</a></li>
                            <li class="{{ Request::is('rbac*') ? 'active' : '' }}">      <a href="{{ route('rbac') }}"> RBAC </a></li>
                            <li class="{{ Request::is('shopSimple*') ? 'active' : '' }}"> <a href="{{ route('shopSimple') }}">E-shop</a></li>
							<li class="{{ Request::is('shopAdminPanel*') ? 'active' : '' }}"><a href="{{ route('shopAdminPanel') }}">E-shop AdminP</a></li>
							 
							<li class="{{ Request::is('testMiddle*') ? 'active' : '' }}"><a href="{{ route('testMiddle') }}"> Test Middle</a></li>
                            <li class="{{ Request::is('tokenGuard*') ? 'active' : '' }}"><a href="{{ route('tokenGuard') }}"> Rest Api TokenGuard</a></li>

                            <li class="{{ Request::is('appointment*') ? 'active' : '' }}">     <a href="{{ route('appointment') }}">    Appointment Vue.js  </a></li>
                            <li class="{{ Request::is('adminlte*') ? 'active' : '' }}">        <a href="{{ route('adminlte') }}">       Admin LT3/Yajra DataTables Snowy </a></li>
                            <li class="{{ Request::is('eventListenersX*') ? 'active' : '' }}"> <a href="{{ route('eventListenersX')}}"> Events/Listeners           </a></li>
                             
							<!-- WPressImages -->
							<li class="{{ Request::is('wpBlogImages*') ? 'active' : '' }}"> <a href="{{ route('wpBlogImages') }}" > WPress-Images      </a> </li> <!-- NOTE: name vs route -->
                            <li class="{{ Request::is('wpBlogImages*') ? 'active' : '' }}"> <a href="{{ route('wpBlogImages') }}" > WPress-Images Admin(N/A) </a> </li> <!-- NOTE: name vs route -->

                            <!-- WPress on Vue Framework -->
							<li class="{{ Request::is('wpBlogVueFrameWork*') ? 'active' : '' }}"> <a href="{{ route('wpBlogVueFrameWork') }}" > WPress Vue.js + Vuex Store     </a> </li> <!-- NOTE: name vs route -->

							<li><a href="{{ route('register') }}">Booking(N/A)</a></li>
							<li><a href="{{ route('register') }}">Passport Api(N/A)</a></li>
							<li><a href="{{ route('register') }}">Vue JS(N/A)</a></li>
                            <li class="{{ Request::is('service-layout*') ? 'active' : '' }}">    <a href="{{ route('service-layout') }}">     Service Layout           </a></li>
						    <li class="{{ Request::is('socialite*') ? 'active' : '' }}">         <a href="{{ route('socialite') }}">          Facebook Socialite       </a></li>
                            <li class="{{ Request::is('rozetk*') ? 'active' : '' }}">            <a href="{{ route('rozetk') }}">             Rozetk XML/YML           </a></li>
                            <li class="{{ Request::is('captcha*') ? 'active' : '' }}">           <a href="{{ route('captcha') }}">            Capcha+Notify            </a></li>
                            <li class="{{ Request::is('polymorphic*') ? 'active' : '' }}">       <a href="{{ route('polymorphic') }}">        Polymorphic Rel + Gii    </a></li>
                            <li class="{{ Request::is('elastic*') ? 'active' : '' }}">           <a href="{{ route('elastic') }}">            Elastic serach           </a></li>
                            <li class="{{ Request::is('where_having*') ? 'active' : '' }}">      <a href="{{ route('where_having') }}">       SQL Where vs Having      </a></li>
							<li class="{{ Request::is('img-captcha_2022*') ? 'active' : '' }}">  <a href="{{ route('img-captcha_2022') }}">   Image Capcha_2022        </a></li> <!-- Self made image captcha -->
                            <li class="{{ Request::is('img-captcha_22_vue*') ? 'active' : '' }}"><a href="{{ route('img-captcha_22_vue') }}"> Image Capcha_2022 on Vue </a></li> <!-- Self made image captcha on Vue Framework-->
                            <li class="{{ Request::is('testing-2024*') ? 'active' : '' }}"><a href="{{ route('testing-2024') }}"> Some testing 2024 </a></li> <!-- some testing in 2024-->

						</ul>
                    </li>
					 <!-- END Submenu DropDown!!!! (Bootsrap) -->
					 
					 
					 
					 <li class="{{ Request::is('formSubmit*') ? 'active' : '' }}">      <a href="{{ url('/formSubmit') }}"> FormSubmit  </a></li> <!-- test for form submit-->

					
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li class="{{ Request::is('login*') ? 'active' : '' }}">  <a href="{{ route('login') }}">Login </a> </li>
                            <li class="{{ Request::is('register*') ? 'active' : '' }}">  <a href="{{ route('register') }}">Register </a></li>
							
							
                        @else
							
						
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

								
					
								
								
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
						
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> <!-- Mega Fix (collapsed main menu won't open)-->
	<script src="{{ asset('js/my-js.js') }}"></script>
	
	
	<!-- To register JS file for specific view only (In layout template) (for home '/' only. Loads JS for home Vue component <example>. If is loaded globally will inerfere with Appointmant vue-->
    @if (in_array(Route::getFacadeRoot()->current()->uri(), ['/'])) <!--Route::getFacadeRoot()->current()->uri()  returns testRest--> 
         <script src="{{ asset('js/app.js') }}"></script> <!-- as included always -->
    @endif
	
	
	<!-- To register JS file for specific view only (In layout template) (for Wpress asset only) -->
    @if (in_array(Route::getFacadeRoot()->current()->uri(), ['wpBlogg'])) <!--Route::getFacadeRoot()->current()->uri()  returns testRest--> 
        <script src="{{ asset('js/wpress_blog.js') }}"></script> <!-- wpress_blog JS -->
    @endif
	
	<!-- To register JS file for specific view only (In layout template) (for WpressImage asset only) -->
    @if (in_array(Route::getFacadeRoot()->current()->uri(), ['wpBlogImages', 'wpBlogImagesOne/{id}', 'createNewWpressImg'])) <!--Route::getFacadeRoot()->current()->uri()  returns testRest--> 
        <link  href="{{ asset('css/Wpress_Images/wpImages_css.css') }}" rel="stylesheet">
		<script src="{{ asset('js/Wpress_ImagesBlog/wpress_blog.js') }}"></script> <!-- wpress_blog JS -->
		
		<script src="{{ asset('js/Wpress_ImagesBlog/LightBox/lightbox.js') }}"></script>       <!-- LightBox Lib JS  -->
        <link  href="{{ asset('css/Wpress_Images/LightBox/lightbox.css') }}" rel="stylesheet"> <!-- LightBox Lib CSS -->
    @endif
	
	
	<!-- (for Wpress Vue.js + Vuex Framework asset only -->
	<!-- To register JS file for specific view only (In layout template) (for Wpress Vue.js + Vuex Framework asset only) -->
    @if (in_array(Route::getFacadeRoot()->current()->uri(), ['wpBlogVueFrameWork'])) <!--Route::getFacadeRoot()->current()->uri()  returns testRest--> 
        <link  href="{{ asset('css/Wpress_Vue_JS/wpVue_css.css') }}" rel="stylesheet">
		<script src="{{ asset('js/Wpress_Vue_JS/wpblog-vue-start.js') }}"></script> <!-- wpress Vue JS -->
		
		
		<script src="{{ asset('js/Wpress_ImagesBlog/LightBox/lightbox.js') }}"></script>       <!-- LightBox Lib JS  -->
        <link  href="{{ asset('css/Wpress_Images/LightBox/lightbox.css') }}" rel="stylesheet"> <!-- LightBox Lib CSS -->
        
        <link  href="{{ asset('css/Wpress_Vue_JS/Element_UI/theme-chalk/index.css') }}" rel="stylesheet"> <!-- Elememt-UI icons (fix)  -->
         	 
	@endif
	 
	
	
	
    <!-- To register JS file for specific view only (In layout template) -->
    @if (in_array(Route::getFacadeRoot()->current()->uri(), ['testRest', 'register'])) <!--Route::getFacadeRoot()->current()->uri()  returns testRest--> 
        <script src="{{ asset('js/test-rest/test-rest.js') }}"></script>
    @endif	


    <!-- To register JS file for specific view only (In layout template) -->
    @if (in_array(Route::getFacadeRoot()->current()->uri(), ['EloquentExample'])) <!--Route::getFacadeRoot()->current()->uri()  returns testRest--> 
        <script src='https://code.jquery.com/ui/1.12.1/jquery-ui.js'></script> <!--autocomplete JS-->
		<link rel="stylesheet" href='//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'> <!--autocomplete CSS -->
		<script src="{{ asset('js/all-users-eloquent/autocomplete.js') }}"></script>
    @endif
	
	<!-- To register JS/CSS for specific view only (for RBAC asset only) -->
    @if (in_array(Route::getFacadeRoot()->current()->uri(), ['rbac'])) <!--Route::getFacadeRoot()->current()->uri()  returns testRest--> 
        <link href="{{ asset('css/rbac/rbac.css') }}" rel="stylesheet">
		<script src="{{ asset('js/rbac/my-rbac.js') }}"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> <!-- Sweet Alert CSS -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'></script> <!--Sweet Alert JS-->
	@endif
	
	
	<!-- To register JS/CSS for specific view only (for ShopSimple asset only) + Some JS/CSS are included in View itself -->
    @if (in_array(Route::getFacadeRoot()->current()->uri(), ['shopSimple', 'admin-products'])) <!--Route::getFacadeRoot()->current()->uri()  returns testRest--> 
	    <!-- Autocomplete -->
        <script src='https://code.jquery.com/ui/1.12.1/jquery-ui.js'></script> <!--autocomplete JS-->
        <link rel="stylesheet" href='//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'> <!--autocomplete CSS -->
        <script src="{{ asset('js/ShopPaypalSimple/autocomplete.js') }}"></script><!--autocomplete itself -->
		
		<script src="{{ asset('js/ShopPaypalSimple/LazyLoad/jquery.lazyload.js')}}"></script> <!--Lazy Load lib JS-->
    @endif
	
	
	<!-- To register JS/CSS for specific view only (for showOneProduct(page result from SearchBar) asset only) + Some JS/CSS are included in View itself -->
    @if (in_array(Route::getFacadeRoot()->current()->uri(), ['showOneProduct/{id}'])) <!--Route::getFacadeRoot()->current()->uri()  returns testRest--> 
		<script src="{{ asset('js/ShopPaypalSimple/LazyLoad/jquery.lazyload.js')}}"></script> <!--Lazy Load lib JS-->
    @endif

    <!-- To register JS/CSS for specific view only (for appointment(page) asset only). Vue rejects and won't work if u  added JS in view. Some CSS are included in View itself -->
    @if (in_array(Route::getFacadeRoot()->current()->uri(), ['appointment'])) <!--Route::getFacadeRoot()->current()->uri()  returns testRest--> 
            <script src="{{ asset('js/Appointment/appoint-vue-start.js')}}"></script> <!-- Vue core -->
    @endif
    
	<!-- To register JS/CSS for specific view only (for adminlte asset only). -->
    @if (in_array(Route::getFacadeRoot()->current()->uri(), ['adminlte'])) <!--Route::getFacadeRoot()->current()->uri()  returns testRest--> 
        <script type="text/javascript" src="https://unpkg.com/jquery-snowfall@1.7.4/dist/snowfall.jquery.min.js"></script>  <!--Snow lib JS-->
		<script src="{{ asset('js/AdminLTE/my-snow.js')}}"></script> <!--My code to start snow-->
	@endif
	
    <!-- To register JS/CSS for specific view only (for captcha only) -->
    @if (in_array(Route::getFacadeRoot()->current()->uri(), ['captcha'])) <!--Route::getFacadeRoot()->current()->uri()  returns testRest--> 
	    @notifyCss <!-- add Notification CSS --> <!--  <link rel="stylesheet" type="text/css" href="http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/vendor/mckenziearts/laravel-notify/css/notify.css"/><script>-->
        @notifyJs  <!--  <script type="text/javascript" src="http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/vendor/mckenziearts/laravel-notify/js/notify.js"></script></script>-->
    @endif
	
	
	 <!-- To register JS/CSS for specific view only (for Polymorphic only). Additional JS and CSS are connected in views (create-new-product.blade + edit-product.blade.php) -->
    @if (in_array(Route::getFacadeRoot()->current()->uri(), ['polymorphic', 'gii-edit-post/{id}', 'gii-create-new-post'])) 
		<link href="{{ asset('css/Polymorphic/polymorphic.css') }}" rel="stylesheet">
    @endif
	
	<!-- ALL OTHER/SOME OTHER CSS/JS SCRIPT ARE LOADED IN EVERY SPECIFIC VIEW (before {endsection}) -->

</body>
</html>
