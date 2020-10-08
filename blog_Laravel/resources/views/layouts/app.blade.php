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
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>   
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
					 <li class="{{ Request::is('showProfile*') ? 'active' : '' }}">     <a href="{{ url('/showProfile') }}">ShowProfile     </a></li>
					 <li class="{{ Request::is('EloquentExample*') ? 'active' : '' }}"> <a href="{{ url('/EloquentExample') }}">DB Eloquent </a></li>
					 <li><a href="{{ route('register') }}">RBAC(N/A)</a></li>
					 
					 <li><a href="api/articles {{--$_SERVER['SERVER_NAME']. '/api/articles' --}}">Rest</a></li><!-- Corrupted way for link-->
					 <li class="{{ Request::is('testRest*') ? 'active' : '' }}">  <a href="{{ url('/testRest') }}">Test Rest </a></li>
					 
					 <li><a href="{{ route('register') }}">Ajax(N/A)</a></li>
					 
					 <li class="{{ Request::is('wpBlogg*') ? 'active' : '' }}"> <a href="{{ route('wpblog') }}" > WPress </a> </li> <!-- NOTE: name vs route -->
					 
					 <li><a href="{{ route('register') }}">Gii(N/A)</a></li>
					 <li><a href="{{ route('register') }}">T()(N/A)</a></li>
					 
					 <!-- Drop Down submenu -->
					 <!--<span class="dropdown">
					 <li class=""  id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                         Drop <span class="caret"></span>
                    </li>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="#">Действие 1</a></li>
                        <li><a href="#">Действие 2</a></li>
                        <li><a href="#">Действие 3</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Действие 4</a></li>
                    </ul>
                    </span>-->
					 
					 
					 <li><a class="navbar-nav1" href="#">Drop <span class="caret"></span></a>
					     <ul class="dropdown-submenu">
						     <li><a href="#">Drop 1</span></a>
							 <li><a href="#">Drop 2</span></a>
						 </ul>
					 </li>
					 
					 
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
    <script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/my-js.js') }}"></script>
	<script src="{{ asset('js/wpress_blog.js') }}"></script> <!-- wpress_blog JS -->
	
    <!-- In layout template -->
    @if (in_array(Route::getFacadeRoot()->current()->uri(), ['testRest', 'register'])) <!--Route::getFacadeRoot()->current()->uri()  returns testRest--> 
        <script src="{{ asset('js/test-rest/test-rest.js') }}"></script>
    @endif	



</body>
</html>
