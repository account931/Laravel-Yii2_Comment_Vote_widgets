@extends('layouts.app')

@section('content')
<!-- Include js/css file for this view only + SEE ONE JS AT THE BOTTOM -->
<link href="{{ asset('css/Captcha_2022/img_captcha_2022.css') }}" rel="stylesheet"> <!-- Css -->

<!-- Sweet Alerts -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> <!-- Sweet Alert CSS -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'></script>     <!--Sweet Alert JS-->
<!-- Include js file for this view only -->

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
                        <i class="fa fa-gift" style="font-size:36px"></i>  
                        Image captcha with images<span class="small text-danger">*</span>
						<p style="border:1px solid black; padding:0.5em;">
						    <b> Custom made </b>
						</p>
                    </h3>
                    <p><a href="{{ route('elastic-indexing') }}">   <button class="btn btn-success"> Delete me <i class="fa fa-refresh" style="font-size:26px"></i></button></a></p> 
                    
					<p></p>                  
                </div>


                <div class="panel-body">
				    
			
           
                
				
				
				
                
				   


                   
                    <!--------------- Image captcha 2022 ----------------------->
					<div class="col-sm-12 col-xs-12">
					    <hr> <i class="fa fa-retweet" style="font-size:36px"></i> <hr>
						
						<!-- just show arry images -->
						<div class="col-sm-4 col-xs-4">
                        @foreach($allImages as $one)
						    @foreach($one as $oneImage)
						        {{ $oneImage }}
						    @endforeach
						@endforeach
						</div>
						
						
						
						
						<!-- Build captcha based on 9 random images -->
						<div class="col-sm-12 col-xs-12">
						    <div class="col-sm-8 col-xs-12">
							
						    <h3 class="captcha-header"> Select all images containing <b> {{ $checkCategory }} </b></h3>
						    <?php $i = 0; ?>
						    @foreach($randomNine as $randomOne)
						        <div class="col-sm-4 col-xs-4 captcha-img">
								    <center>
							        <img src="{{URL::to("/")}}/images/Captcha_2022/{{$randomOne}}"  class="img-responsive my-cph" alt="a"/>
                                    <i class="fa fa-check watermark" style="font-size:44px; color:black;"></i>									
									</center>
							    </div>
								
								
								    
								
								
						        <?php $i++; ?>
						    @endforeach
							</div>
						</div>
						<!-- End Build captcha based on 9 random images -->
						
						
					</div>
					<!--------------- End Image captcha 2022 ------------------->
					
					
					
					
					
					<!---------- Form ---------->
					<div class="col-sm-12 col-xs-12 form">
					    
					    <form class="form-horizontal" method="post" action="{{url('#' )}}" enctype="multipart/form-data">
						    
							<!-- Post Titel, product name -->
                            <div class="form-group{{ $errors->has('product-name') ? ' has-error' : '' }}">
                                <label for="product-name" class="col-md-4 control-label">Product name</label>

                                <div class="col-md-6">
                                    <input id="product-name" type="text" class="form-control" name="product-name" value="{{old('product-name')}}" required autofocus>
                                                                                       
                                    @if ($errors->has('product-name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('product-name') }}</strong>
                                    </span>
                                    @endif 
							    </div>
                            </div>

								
                            <!-- Submit Button --> 
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary"> Edit + Elastic re-index</button>
                                </div>
                            </div>
								
					    </form>
					</div>
					<!---------- End Form ---------->
					
					
					



                </div>
				
            </div>
        </div>
    </div>
</div>


<script>
</script>

<!-- Include js/css file for this view only -->
 <script src="{{ asset('js/Captcha_2022/img_captcha_2022.js') }}"></script> <!--  JS to view an uploaded form image -->
@endsection
