
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
					 @php
					 $found = array_search($lang, array_column($listOfLanguages, 'langName')); //returns 3
					 $keys = array_keys($listOfLanguages);
					 $imageX = $listOfLanguages[$keys[$found]]['langFlagImg'];
					 @endphp
					 
					 <div class="col-sm-12 col-xs-12" id="result">
					     <h3>Select your language.. </h3> 
						 <p>currently used languge => </p>
						     <span class="text-danger"> 
						     <img class="flag" src="{{URL::to('/')}}/images/flags/{{ $imageX }}"  alt=""/> <span> 
						     <b> {{$lang}} </b>
						</p>
						 
						 
						 <!-- Dropdown with languages, now available: 'ru-RU', 'en-US', 'my-Lang', 'dk-DK' -->
                         <!-- Checks what current language is to put check icon there -->
                         <div class="dropdown">
                             <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Change Language
                             <span class="caret"></span></button>
                             <ul class="dropdown-menu">
							     
								 
                                 <!-- English -->
								 <!--<li><a class="small-flag" href="{{route('multilanguage', ['l' => 'en-US'])}}"> 
								    <img src="{{URL::to('/')}}/images/flags/en-US.svg"  alt=""/> English      
									@if (isset($_GET['l']) && $_GET['l'] == "en") 
										<img  src="{{URL::to('/')}}/images/checkmark.png"  alt=""/>
									@endif
								</a></li>-->
								 
                                 <!-- Ru -->								 
								 <!--<li><a class="small-flag" href="{{route('multilanguage', ['l' => 'ru'])}}"> 
								    <img  src="{{URL::to('/')}}/images/flags/ru-RU.svg"  alt=""/> Ru     
									@if (isset($_GET['l']) && $_GET['l'] == "ru") 
										<img  src="{{URL::to('/')}}/images/checkmark.png"  alt=""/>
									@endif
									</a>
								 </li>-->
								 
								  <!-- Ua -->								 
								 <!--<li><a class="small-flag" href="{{route('multilanguage', ['l' => 'ua'])}}"> 
								    <img  src="{{URL::to('/')}}/images/flags/ua-UA.svg"  alt=""/> ua-UA    
									@if (isset($_GET['l']) && $_GET['l'] == "ua") 
										<img  src="{{URL::to('/')}}/images/checkmark.png"  alt=""/>
									@endif
									</a>
								 </li>-->
								 
								  <!-- DK -->								 
								 <!--<li><a class="small-flag" href="{{route('multilanguage', ['l' => 'dk'])}}"> 
								    <img src="{{URL::to('/')}}/images/flags/dk-DK.svg"  alt=""/> dk-DK   
									@if (isset($_GET['l']) && $_GET['l'] == "dk") 
										<img  src="{{URL::to('/')}}/images/checkmark.png"  alt=""/>
									@endif
									</a>
								 </li>-->
								 
								 
								 
								 <!-- dynamically build/generate dropdown with language based on $listOfLanguages from Controller -->
								 @foreach ($listOfLanguages as $a)
                                    @php
                                    // find the value of array. must be within pure php directive or it will malfunction								
									$key = array_search ($a, $listOfLanguages); //e.g returns English
                                    @endphp									
					                <li><a class="small-flag" href="{{route('multilanguage', ['l' =>  $a['langName']  ] ) }} "> 
								    <img src="{{URL::to('/')}}/images/flags/{{ $a['langFlagImg'] }}"  alt=""/> {{ $key }}  
									@if (isset($_GET['l']) && $_GET['l'] == $a['langName'] ) 
										<img  src="{{URL::to('/')}}/images/checkmark.png"  alt=""/>
									@endif
									</a>
								 </li>
                                 @endforeach
				                 <!-- END generate dropdown with language based on $listOfLanguages -->

 
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

