<?php
//My custom Login page. Login form is injected from /views/auth/login.blade.php. Nothing else is needed as form contains original action url  action="{{ route('login') }}">
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
                        <h1>My custom login page </h1>
						&nbsp;<i class="fa fa-arrow-circle-o-left" style="font-size:24px"></i>&nbsp;   <a href="{{ url('testMiddle') }}">back to start </a><br>
		            </div>	
				    
					
					<!-- Just info, may delete later -->
				    <div class="col-sm-12 col-xs-12 alert alert-info small font-italic text-danger  shadowX">
					    </br> Some notes here.....
						</br> Test for middle, just like the one implemented in Yii2
				    </div>
					
					
					<!-- If user is already logged -->
					@if (!Auth::guest())
						<div class="col-sm-12 col-xs-12">
						    <p>Hello, {{ auth()->user()->name }}. You are logged.</p>
					        <p>In order to fully test this section, please log out </p>
						</div>
					@endif
					
					
					<!-- If user is Guest, not logged -->
					@if (Auth::guest())
						
				        <!-- Form -->
					    <div class="panel-body">
						    <div class="col-sm-12 col-xs-12"> Login for <b> {{ $mailX }} </b><hr> </div>
							
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ $mailX }}" required >
                                
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif 
							        </div>
                                </div>	
								
								
								
						        <!-- If u want to Login with username instead of Email -->
						        <!--
						        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
						            <label for="name" class="col-md-4 control-label">name</label>
						            <div class="col-md-6">
								        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required >
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
							        </div>
						        </div>
						        -->
						        <!-- End If u want to Login with username instead of Email -->
								
								
                            
                        

                               <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                   <label for="password" class="col-md-4 control-label">Password</label>

                                   <div class="col-md-6">
                                       <input id="password" type="password" class="form-control" name="password" required>
                                       <i class="fa fa-eye" id="togglePassword" style="cursor:pointer;"></i>
								
                                       @if ($errors->has('password'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('password') }}</strong>
                                       </span>
                                       @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="checkbox">
                                            <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Login
                                        </button>

                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                             Forgot Your Password?
                                        </a>
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





<!-- Include js file for thisview only -->
<script src="{{ asset('js/login/login.js')}}"></script>
<!-- Include js file for thisview only -->


@endsection
