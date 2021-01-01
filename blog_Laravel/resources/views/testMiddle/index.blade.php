<?php
//Test for middle, just the like the one implemented in Yii2 
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
					
					
                <div class="panel-heading text-warning row">
				
				  <div class="col-sm-3 col-xs-6">
				    Test for middle <span class="small text-danger">*</span> 
				  </div>
				  
				  
				</div>





                <div class="panel-body test-middle-x">
				
				    <div class="col-sm-7 col-xs-4">
                        <h1>Test for Middle</h1>
		            </div>	
				    
					
					<!-- Just info, may delete later -->
				    <div class="col-sm-12 col-xs-12 alert alert-info small font-italic text-danger  shadowX">
					    </br> Some notes here.....
						</br> Test for middle, just like the one implemented in Yii2
				    </div>
					
				
				</div> <!-- end .test-middle-x -->
				    
					
			
			
			
			
			
					
                
            </div> <!-- end .panel-default xo -->
        </div>
    </div>
</div> <!-- end . animate-bottom -->








@endsection
