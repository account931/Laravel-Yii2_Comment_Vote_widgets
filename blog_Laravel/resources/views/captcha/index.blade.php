@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
			
			
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
                            <li> {{ $error }} </li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                <!-- End Display form validation errors var 2 -->		
                
						
						
						
                <div class="panel-heading text-warning">
                    <h3>
                        <i class="fa fa-recycle" style="font-size:36px"></i>  
                        Captcha, reCaptcha, Laravel Notify package<span class="small text-danger">*</span>
                    </h3>
                    <p>Notify      = > https://github.com/mckenziearts/laravel-notify</p> 
                    <p>Mews\Captcha => https://github.com/mewebstudio/captcha  </p>                  
                </div>


                <div class="panel-body">
				    
					<p><a href="{{ route('handcaptcha') }}">
                        <button class="btn btn-large btn-success">Send notification(N/A)</button>
                    </a></p>
                    
                    <!-- Laravel notify message. Div is not required by documentation, but a fix not to hide notify message by menu bar -->
                    <!-- Can modify at /config/notify.php -->
                    <div style="position:relative;z-index:99999999999999999;">
				        @include('notify::messages')
				    </div>
                
                
                
				    <!------------ Hand made captcha via Session ------------------->
					<div class="col-sm-12 col-xs-12"></br>
					    <h3>Hand made captcha</h3>  
                        
                        <form class="form-horizontal" method="post" action="{{url('/handcaptcha')}}" enctype="multipart/form-data">
                            <input type="hidden" value="{{csrf_token()}}" name="_token" /><!-- csrf-->  
                                
                                <!-- product name -->
                                <div class="form-group{{ $errors->has('product-name') ? ' has-error' : '' }}">
                                    <label for="product-name" class="col-md-4 control-label">Product name</label>

                                    <div class="col-md-6">
                                        <input id="product-name" type="text" class="form-control" name="product-name" value="{{ old('product-name') }}" required autofocus>
                                
                                        @if ($errors->has('product-name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('product-name') }}</strong>
                                        </span>
                                        @endif 
							        </div>
                                </div>	
                                
                                <!-- Display Hand-made generated Captcha (both html and image)  -->
                                <div class="form-group">
                                    <label for="product-name" class="col-md-4 control-label">Captcha</label>
                                    <div class="col-md-6">
                                        <p style="padding:0.5em; border:1px solid black;border-radius:15px; width:40%;">
                                            Captcha html
                                        </p>
                                        <p class="" style="background:red; padding:2em 1em; border:1px solid black;font-size:1.3em;"> 
                                            {{ $UUID }}  <!-- generated captcha as html text -->
                                        </p>
                                        
                                        <p style="padding:0.5em; border:1px solid black;border-radius:15px;width:40%;">
                                            Captcha text to Image via GD
                                        </p>
                                        <p><img src="captcha-image.png" alt=""/></p> <!-- generated captcha as GD image -->
                                    </div>
                                </div>
                                
                                
                                <!-- Hand made Capcha to repeat -->
                                <div class="form-group{{ $errors->has('hand-captcha') ? ' has-error' : '' }}">
                                    <label for="product-name" class="col-md-4 control-label">Captcha</label>

                                    <div class="col-md-6">
                                        <input id="hand-captcha" type="text" class="form-control" name="hand-captcha" placeholder="enter captcha" value="{{ old('hand-captcha') }}" required>
                                
                                        @if ($errors->has('hand-captcha'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('hand-captcha') }}</strong>
                                        </span>
                                        @endif 
							        </div>
                                </div>
                            
                            	<!-- Submit Button --> 
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary"> Send</button>
                                    </div>
                                </div>

                        </form> 
                            
					</div>
					<!-- End Hand made captcha via Session  -->

                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                     <!-- Captcha package mews/captcha -->
					<div class="col-sm-12 col-xs-12"></br>
					    <h3>Captcha package "mews/captcha"</h3>
                        <form class="form-horizontal" method="post" action="{{url('/package-captcha')}}" enctype="multipart/form-data">
                            <input type="hidden" value="{{csrf_token()}}" name="_token" /><!-- csrf-->  
                                
                                <!-- product name -->
                                <div class="form-group{{ $errors->has('product-name') ? ' has-error' : '' }}">
                                    <label for="product-name" class="col-md-4 control-label">Product name</label>

                                    <div class="col-md-6">
                                        <input id="product-name" type="text" class="form-control" name="product-name" value="{{ old('product-name') }}" required autofocus>
                                
                                        @if ($errors->has('product-name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('product-name') }}</strong>
                                        </span>
                                        @endif 
							        </div>
                                </div>	
                                
                                
                                <!-- Display "mews/captcha" Captcha  -->
                                <div class="form-group">
                                    <label for="product-name" class="col-md-4 control-label">Captcha</label>
                                    <div class="col-md-6">
                                         <p> {{ captcha_img() }}</p> <!-- return html -->
                                    </div>
                                </div>
                                
                                <!-- Hand made Capcha to repeat -->
                                <div class="form-group{{ $errors->has('hand-captcha') ? ' has-error' : '' }}">
                                    <label for="product-name" class="col-md-4 control-label">Captcha</label>

                                    <div class="col-md-6">
                                        <input id="captcha" type="text" class="form-control" name="captcha" placeholder="enter captcha" value="{{ old('hand-captcha') }}" required>
                                
                                        @if ($errors->has('hand-captcha'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('hand-captcha') }}</strong>
                                        </span>
                                        @endif 
							        </div>
                                </div>
                            
                            	<!-- Submit Button --> 
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary"> Send</button>
                                    </div>
                                </div>

                        </form>                         
					</div>
					<!-- End Captcha package mews/captcha -->










					
                </div>
            </div>
        </div>
    </div>
</div>


<script>

</script>

@endsection
