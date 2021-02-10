<?php
//
?>

@extends('layouts.app')


@section('content')




<div  class="container ">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="panel panel-default xo">
			
			
			    <!-- Flash message if Success -->
				@if(session()->has('flashMessageX'))
                    <div class="alert alert-success">
                        {!! session()->get('flashMessageX') !!} <!--Displays content without html escaping -->
                    </div>
                @endif
				<!-- Flash message -->
				

                <!-- Flash message if Failed -->
				@if(session()->has('flashMessageFailX'))
                    <div class="alert alert-danger">
                        {!! session()->get('flashMessageFailX') !!} <!--Displays content without html escaping -->
                    </div>
                @endif
				<!-- Flash message if Failed -->				
				

                <!-- Display form validation errors var 2 -->
				@if (count($errors) > 0)
                    <div class="alert alert-danger">
                      <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                      </ul>
                    </div>
                @endif
                <!-- End Display form validation errors var 2 -->				
					
					
               

                <div class="panel-heading text-warning col-sm-12 col-xs-12">
				  <div class="col-sm-12 col-xs-12">
				    Events/Listeners <span class="small text-danger">*</span>
				  </div>
				</div>



                <div class="panel-body events-listeners-x">
				
				    <div class="col-sm-12 col-xs-12">
                        <h1> Events/Listeners <span class="small">( Events/Listeners)</span></h1>
		            </div>	
				    
					
					<!-- Just info, may delete later -->
					<div class="col-sm-12 col-xs-12 alert alert-info small font-italic text-danger shadowX">
					    <h6><span class='glyphicon glyphicon-flag' style='font-size:28px;'></span> This page is implementation of...</h6>
		                <p><b>Laravel Events and Listeners. Built on Observer OOP patern. Core app file -> app/Providers/EventServiceProvider.php See docs at .....</b></p>
		                <hr>
		                <p>Manual Triggering /app/Events/SomeEventX causes execution of Listener /app/Listeners/EventListenerX.</p>
					    <p>Other Listener /app/Listeners/WriteCredentialsToLog fires automatically on every Login (makes writting credetials to Log.</p>
					</div>
					
					
					
					
				
					
					<!----------------------- START   ----------------------------->
					
	                <div class="col-sm-12 col-xs-12 ">
	                    <a href="{{ route('runEventX') }}"> <button class="btn btn-large btn-danger"> Run an event manually (SomeEventX) </button></a>
	                    </br></br></br></br>
						<a href="https://mettle.io/blog/complete-list-of-laravel-5-events">Complete List Of Laravel Built-inCore Events</a>
					</div>
	 
	              
					
	               <!----------------------- End all    ----------------------------->
	
	
	
	
	
	
	     
				
				</div> <!-- end .events-listeners-x -->
				    
					
			
			
			
			
			
					
                
            </div> <!-- end .panel-default xo -->
        </div>
    </div>
</div> <!-- end . animate-bottom -->








@endsection
