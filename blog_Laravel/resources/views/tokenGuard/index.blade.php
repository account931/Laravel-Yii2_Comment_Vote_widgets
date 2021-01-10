<?php
//Rest Api with access by token only
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
				    TokenGuard<span class="small text-danger">*</span> 
				  </div>
				</div>





                <div class="panel-body test-middle-x">
				
				    <div class="col-sm-7 col-xs-4">
                        <h1>TokenGuard</h1>
		            </div>	
				    
					
					<!-- Just info, may delete later -->
				    <div class="col-sm-12 col-xs-12 alert alert-info small font-italic text-danger  shadowX">
					    <h5><span class='glyphicon glyphicon-flag' style='font-size:38px;'></span> This page is implementation of One view</h5>
		                </br> Some notes here.....
						</br> Bearer authentication (also called token authentication) is an HTTP authentication scheme that involves security tokens called bearer tokens.
				        </br> Rest Api with access by token only
		                <hr>
		                <p>Some more text.</p>
					</div>
					
					
					
					<!-- Go back link -->
					<div class="col-sm-12 col-xs-12">
					    <a href="{{ url('wpBlogg') }}"><i class="fa fa-angle-double-left" style="font-size:49px"></i>    <span style="position:relative; bottom:0.7em;">back to list </span></a><br>
					</div>
					<!-- Go back link -->
					
				
				</div> <!-- end .test-middle-x -->
				    
					
			
			
			
			
			
					
                
            </div> <!-- end .panel-default xo -->
        </div>
    </div>
</div> <!-- end . animate-bottom -->








@endsection
