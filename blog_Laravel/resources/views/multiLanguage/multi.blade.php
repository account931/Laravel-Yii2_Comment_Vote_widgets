
@extends('layouts.app')

	
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Multilanguage</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
					
					
				
					 
					 
					 
					 <!---- -->
					 <div class="col-sm-12 col-xs-12" id="result">
					     <h3>Select your language.. </h3> 
						 <p>currently used languge => <span class="text-danger"> <b>{{$lang}} </b><span> </p>
						 
						 
						 <!-- Dropdown with languages, now available: 'ru-RU', 'en-US', 'my-Lang', 'dk-DK' -->
                         <!-- Checks what current language is to put check icon there -->
                         <div class="dropdown">
                             <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Change Language
                             <span class="caret"></span></button>
                             <ul class="dropdown-menu">
							  
                                 <!-- English -->
								 <li><a class="small-flag" href="{{route('multilanguage', ['l' => 'en-US'])}}"> 
								    <img src="{{URL::to('/')}}/images/flags/en-US.svg"  alt=""/> English      
									@if (isset($_GET['l']) && $_GET['l'] == "en") 
										<img  src="{{URL::to('/')}}/images/checkmark.png"  alt=""/>
									@endif
								</a></li>
								 
                                 <!-- Ru -->								 
								 <li><a class="small-flag" href="{{route('multilanguage', ['l' => 'ru'])}}"> 
								    <img  src="{{URL::to('/')}}/images/flags/ru-RU.svg"  alt=""/> Ru     
									@if (isset($_GET['l']) && $_GET['l'] == "ru") 
										<img  src="{{URL::to('/')}}/images/checkmark.png"  alt=""/>
									@endif
									</a>
								 </li>
								 
								  <!-- Ua -->								 
								 <li><a class="small-flag" href="{{route('multilanguage', ['l' => 'ua'])}}"> 
								    <img  src="{{URL::to('/')}}/images/flags/ua-UA.svg"  alt=""/> ua-UA    
									@if (isset($_GET['l']) && $_GET['l'] == "ua") 
										<img  src="{{URL::to('/')}}/images/checkmark.png"  alt=""/>
									@endif
									</a>
								 </li>
								 
								  <!-- DK -->								 
								 <li><a class="small-flag" href="{{route('multilanguage', ['l' => 'dk'])}}"> 
								    <img src="{{URL::to('/')}}/images/flags/dk-DK.svg"  alt=""/> dk-DK   
									@if (isset($_GET['l']) && $_GET['l'] == "dk") 
										<img  src="{{URL::to('/')}}/images/checkmark.png"  alt=""/>
									@endif
									</a>
								 </li>
				                 
                             </ul>
                         </div> <br>
                         <!-- Dropdown with languages, now available: 'ru-RU', 'en-US', 'my-Lang', 'dk-DK' --> 
						 
						 
					 </div>
					 <!----  -->
					 

                    <!-- Translation -->
                    <div>
					    <p>{{ trans('message.welcome') }}</p>
                        <p>@lang('message.welcome') </p> <!-- same as above-->
					</div>
					<!-- Translation -->
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

