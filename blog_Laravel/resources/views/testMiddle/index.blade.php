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
                        <h1>Test for Middle <i class="fa fa-briefcase" style="font-size:36px"></i></h1>
		            </div>	
				    
					
					<!-- Just info, may delete later -->
				    <div class="col-sm-12 col-xs-12 alert alert-info small font-italic text-danger  shadowX">
					    </br> Some notes here.....
						</br> Test for middle, just like the one implemented in Yii2
				    </div>
					
					
					
					<!-- If user is already logged -->
					@if (!Auth::guest())
						<div class="col-sm-12 col-xs-12">
						    <p>Hello, {{ auth()->user()->name }}. You are currently logged.</p>
					        <p>In order to fully test this section, please log out </p>
						</div>
					@endif
					
					
					<!-- If user is Guest, not logged -->
					@if (Auth::guest())
					
				        <!-- Form -->
					    <div class="col-sm-12 col-xs-12">
                            <p> Give us you e-mail to figure out what to do </p>
						
						    <form class="form-horizontal" method="post" action="{{url('/checkEmail')}}">
							
                                <input type="hidden" value="{{csrf_token()}}" name="_token" /><!-- csrf-->
							
						        <!-- E-mail -->
                                <div class="form-group{{ $errors->has('user-email') ? ' has-error' : '' }}">
                                    <label for="product-name" class="col-md-4 control-label">E-mail</label>

                                    <div class="col-md-6">
                                         <input id="user-email" type="text" class="form-control" name="user-email" value="{{ old('user-email') }}" required autofocus>
                                
                                        @if ($errors->has('user-email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('user-email') }}</strong>
                                            </span>
                                        @endif 
							        </div>
                                </div>
                            
                                <!-- Submit Button --> 
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary"> Go </button>
                                    </div>
                                </div>							
							
					        </form>
				        </div>
					    <!-- End Form -->
					
					@endif
					
					
				</div> <!-- end .test-middle-x -->
				    
					
			
			
			
			
			
					
                
            </div> <!-- end .panel-default xo -->
        </div>
    </div>
</div> <!-- end . animate-bottom -->








@endsection
