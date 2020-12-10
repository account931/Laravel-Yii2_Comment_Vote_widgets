<!-- HOME PAGE -->


<!--<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel CPH</title>
-->


        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->

        <!-- Styles -->
        <style>
		     /* Below part CAUSES COLOR CRASH */
            /*
			html, body {
                background-color: #fff;
                color: black; #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            } */

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                /*color: #636b6f;*/
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
			/*.my-main {background:lavender;}*/
        </style> 
    <!-- </head> -->
    <!-- <body> -->
	
	
	@extends('layouts.app')

    @section('content')

        <div class="flex-center position-ref my-main home-wall"> <!-- .full-height -->
		{{-- @if (Route::has('login'))
                <div class="top-right links home-page-links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
					   <a href="{{ url('/showProfile') }}">My Link showProfile</a>
					   <a href="{{ url('/EloquentExample') }}">Eloquent AR</a>
					   <a href="{{ url('/EloquentExample') }}">New menu</a>
                </div>
		@endif --}}
			
			

            <div class="content">
			    
				
                <div class="title m-b-md my-title">
                   <center> <h1>Laravel CPH 2019</h1> </center> 
                </div>
				
				<div class="col-sm-12 col-xs-12">
                    <example></example> <!-- Vue Component -->
				</div>
				
                <div class="links home-page-links">
				    <div class="col-sm-4 col-xs-6">
				        <a href="#">MyWaze</a>
					</div>
					<div class="col-sm-4 col-xs-6">
                        <a href="https://laravel.com/docs">Documentation</a>
					</div>
					<div class="col-sm-4 col-xs-6">
                        <a href="https://laracasts.com">Laracasts</a>
					</div>
					<div class="col-sm-4 col-xs-6">
                        <a href="https://laravel-news.com">News</a>
					</div>
					<div class="col-sm-4 col-xs-6">
                        <a href="https://forge.laravel.com">Forge</a>
					</div>
					<div class="col-sm-4 col-xs-6">
                       <a href="https://github.com/laravel/laravel">GitHub</a>
					</div>
					<div class="col-sm-12 col-xs-12"><p>______</p></div>
                </div>
				
				<div class="col-sm-12 col-xs-12">
		            <div class="alert alert-danger"> 
					    By default this home page used no layout, now was edited to use it, particulary {resources\views\layouts\app.blade.php} 
					</div>
			           <center>
					       <img class="img-responsive my-cph" src="{{URL::to('/')}}/images/copenn2.jpg"  alt=""/> <!-- image -->
						   <img class="img-responsive my-cph" src="{{URL::to('/')}}/images/copenn.jpg"  alt=""/> <!-- image -->
						   <img class="img-responsive my-cph" src="{{URL::to('/')}}/images/cph.jpg"  alt=""/> <!-- image -->
					   </center>
				    
				</div>
			
            </div>
			
			
				
				
        </div>
		
		@endsection
		
   <!-- </body>
</html>
-->
