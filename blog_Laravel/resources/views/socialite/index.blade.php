<?php
//Socialite Package (Facebook, Google)
?>

@extends('layouts.app')

@section('content')

<!-- Include js file for this view only -->



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
				    Socialite Package (Facebook, Google)<span class="small text-danger">*</span> 
				  </div>
				</div>





                <div class="panel-body test-middle-x">
				
				    <div class="col-sm-7 col-xs-4">
                        <h1>Socialite Package</h1>
		            </div>	
				    
					
					<!-- Just info, may delete later -->
				    <div class="col-sm-12 col-xs-12 alert alert-info small font-italic text-danger  shadowX">
					    <h5><span class='glyphicon glyphicon-flag' style='font-size:38px;'></span> This page is implementation of Socialite Package (Facebook, Google)</h5>
		                </br> Some notes here.....
						</br> Login via Socialite Facebook, Google
				        </br> 
		                <hr>
		                <p>Some more text.</p>
					</div>
					
					
					
					<!-- Go back link -->
					<div class="col-sm-12 col-xs-12">
					    <a href="{{ url('wpBlogg') }}"><i class="fa fa-angle-double-left" style="font-size:49px"></i>    <span style="position:relative; bottom:0.7em;">back to list </span></a><br>
					</div>
					<!-- Go back link -->
					
				
                    @if (!Auth::guest())
                        <div class="col-sm-12 col-xs-12 bg-danger" style="border:1px solid black; padding:0.5em;">
                            <center> You are now logged! </center>
                        </div>  
                        
                        <div class="col-sm-12 col-xs-12 bg-info" style="border:1px solid black; padding:0.5em;">
                            <center><i class='fa fa-yelp' style='font-size:24px'></i> Welcome, {{auth()->user()->name}}!</center>
                        </div>                        
                    @endif
                    
                        
                    <div class="col-sm-7 col-xs-4">
       
			            {{-- Login with Facebook --}}
                        <div class="flex items-center justify-end mt-4">
                            <a class="btn" href="{{ url('auth/facebook') }}"
                              style="background: #3B5499; color: #ffffff; padding: 10px; width: 100%; text-align: center; display: block; border-radius:3px; margin-top:2em;">
                               <i class='fa fa-facebook-square' style='font-size:24px'></i> 
                               Login with Facebook <span style="font-size:0.4em;">(hide it, when logged)</span>
                            </a>
                        </div>
                    </div>
                    
                    
                    
                    
				</div> <!-- end .test-middle-x -->
				    
					
      
		
					
                
            </div> <!-- end .panel-default xo -->
        </div>
    </div>
</div> <!-- end . animate-bottom -->








@endsection
