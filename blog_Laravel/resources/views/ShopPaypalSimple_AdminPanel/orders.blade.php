<?php
//show.....
?>

@extends('layouts.app')

@section('content')

<!-- Include js/css file for this view only -->
<link href="{{ asset('css/ShopPaypalSimple/shopSimple.css') }}" rel="stylesheet"> 


<!-- Sweet Alerts -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> <!-- Sweet Alert CSS -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'></script> <!--Sweet Alert JS-->
<!-- Include js file for thisview only -->


<div class="container">
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
					
					
                <div class="panel-heading text-warning">
				    Admin Orders <span class="small text-danger">*</span> 
					<!-- Link to go back -->
				    <div>
				    &nbsp;<i class="fa fa-hand-o-left" style="font-size:24px"></i>
				    <a href="{{ url('/shopSimple') }}">back to shop </a>
                    </div>
				</div>

                <div class="panel-body shop">
				
				    <div class="col-sm-10 col-xs-10">
                    <h1>Orders</h1>
		            </div>	
				
				  
		
		
		
					  
					<!-- Display orders -->
                    <div class="col-sm-12 col-xs-12">
					
					<!-- THEAD -->
		            <div class="col-sm-12 col-xs-12  list-group-item">
		                <div class="col-sm-2 col-xs-6">UUID</div>
						<div class="col-sm-2 col-xs-6">Status</div>
			            <div class="col-sm-1 col-xs-6">Sum</div>
			            <div class="col-sm-1 col-xs-6">Quant</div>
			            <div class="col-sm-2 col-xs-6">Name</div>
						<div class="col-sm-2 col-xs-6">Date</div>
						<div class="col-sm-2 col-xs-12">Paid</div>
		            </div>
		            <!-- End THEAD -->
							
							
					@foreach($orderedItem as $v)
					  <div class="col-sm-12 col-xs-12  list-group-item">
						<div class="col-sm-2 col-xs-12 ">{{ $v-> ord_uuid}}</div>
						<div class="col-sm-2 col-xs-12 ">{{ $v-> ord_status}}</div>
						<div class="col-sm-1 col-xs-12 ">{{ $v-> ord_sum}}</div>
						<div class="col-sm-1 col-xs-12 ">{{ $v-> items_in_order}}</div>
						<div class="col-sm-2 col-xs-12 ">{{ $v-> ord_name }} {{ $v-> ord_address }} {{ $v-> ord_address }}</div>
					    <div class="col-sm-2 col-xs-12 ">{{ $v-> ord_placed}}</div>
						<div class="col-sm-2 col-xs-12 ">{{ ($v-> if_paid==0)? "Not paid" : "Paid"}}</div>
					  </div>
					@endforeach
					</div>
					
					
                    
					
					
					
					
					
					
				
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					


                    					
				</div> <!-- end .shop -->
				    
					
			
					
                
            </div> <!-- end .panel-default xo -->
        </div>
    </div>
</div> <!-- end . animate-bottom -->

<script>

</script>

@endsection