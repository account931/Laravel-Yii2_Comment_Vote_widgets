<?php
//Appointment
?>

@extends('layouts.app')


@section('content')


<!-- Include js/css file for this view only -->
<link href="{{ asset('css/Appointment/appoint.css') }}" rel="stylesheet">






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
				    Appointment <span class="small text-danger">*</span>
				  </div>
				</div>



                <div class="panel-body appointment-x">
				
				    <div class="col-sm-12 col-xs-12">
                        <h1>Appointment</h1>
		            </div>	
				    
					
					<!-- Just info, may delete later -->
					<div class="col-sm-12 col-xs-12 alert alert-info small font-italic text-danger shadowX">
					    <h6><span class='glyphicon glyphicon-flag' style='font-size:28px;'></span> This page is implementation of...</h6>
		                <p><b>Endpoint for making appointment, e.g visit to hairdresser, notary, dentist, etc. See docs at .....</b></p>
		                <hr>
		                <p>Some more text.</p>
					</div>
					
					
					
					
					
					<div class="col-sm-12 col-xs-12">
					   <h3><?php echo "Today: " . date('j-M-D-Y');  // today day ?></h3><hr>
					</div>
					
					
					<!----------------------- START all Rooms  ----------------------------->
	                <div class="col-sm-12 col-xs-12 rooms">
	                <?php
		            $rooms = 6;
		            for($i = 0; $i < $rooms; $i++){ 
		                $roomID = $i + 1;
					    //$name = $dirs[$i]; //returns  images/corps_many_folder/Spring_19
						$folderName = "Room " . ($i + 1); //explode("/", $name)[2];
						$folderImage = '<img class="my-img" src="' .URL::to('/'). '/images/item.png"  alt=""/>';
						
				        echo "<div class='subfolder shadowX' id='" . $roomID  ."'>" . 
						    '<a href="#"> ' .  $folderImage . '<p>' . $folderName . '</p><br>  </a>' .
						 "</div>";
                   }
		           ?>
	                </div>
	 
	                <div class="row">
	                    <div class="col-sm-2 col-xs-3"></div>
	                    <div class="col-sm-7 col-xs-6 shadowX" id="selectedRoom"><span id="roomNumber"></span></div>
		                <div class="col-sm-3 col-xs-3"></div>
	                </div>
	               <!----------------------- End all Rooms   ----------------------------->
	
	
	
	
	
	
	                <!-- Vue Component (just ajax test comonent) -->
					<div class="col-sm-12 col-xs-12" id="appZ">
                       <test-ajax-component></test-ajax-component> <!-- Vue Component -->
				    </div>
					
					
					
					<!-- Vue Component (shows the list of rooms) -->
					<div class="col-sm-12 col-xs-12" id="appZ1">
                       <list-of-rooms></list-of-rooms> <!-- Vue Component -->
				    </div>
					
					
					
					
					
					<!-- render partial, SQL template scheme -->
					@include('Appointment.partial.SQL-template');
				
				</div> <!-- end .appointment-x -->
				    
					
			
			
			
			
			
					
                
            </div> <!-- end .panel-default xo -->
        </div>
    </div>
</div> <!-- end . animate-bottom -->








@endsection
