<?php
//shows 1 product 
?>

@extends('layouts.app')
<?php
//uses $_SESSION['cart_dimmm931_1604938863'] to store and retrieve user's cart; Format is { [8]=> int(3) [1]=> int(2) [4]=> int(1) }
?>

@section('content')
<!-- Lazy load is loaded in views/app.blade.php, otherwise it wont work!!!!!!!! -->

<script src="{{ asset('js/ShopPaypalSimple/shopSimple.js')}}"></script> 
<script src="{{ asset('js/ShopPaypalSimple/my_LazyLoad_Shop_Simple.js')}}"></script>  <!--implement LazyLoad --> 
 

<!-- Include js/css file for this view only -->
<script src="{{ asset('js/ShopPaypalSimple/shopSimple_Loader.js')}}"></script> <!-- CSS Loader -->
<link href="{{ asset('css/ShopPaypalSimple/shopSimple.css') }}" rel="stylesheet">
<link href="{{ asset('css/ShopPaypalSimple/shopSimple_Loader.css') }}" rel="stylesheet">

<!-- Sweet Alerts -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> <!-- Sweet Alert CSS -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'></script> <!--Sweet Alert JS-->
<!-- Include js file for thisview only -->


<div id="all" class="container animate-bottom">
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
				    One product <span class="small text-danger">*</span> 
					<!-- Link to go back -->
				    <div>
				    &nbsp;<i class="fa fa-hand-o-left" style="font-size:24px"></i>
				    <a href="{{ url('/elastic') }}">back to Elastic Search </a>
                    </div>
				</div>

                <div class="panel-body shop">
				
				    <div class="col-sm-10 col-xs-10">
                        <h1> One product </h1>
						<p>Display One product from table {elast_search}</p>
						<p>Uses Modified for Elastic view /views/ShopPaypalSimple/partial/oneProduct_with_hiddenModal.blade.php</p>
		            </div>	
				
				   
		
		
		
		
				    <!-------------------- Progress Status Icons by component ----------------->
	                <!--display shop timeline progress via Helper => Progress Status Icons-->
					<div class="col-sm-12 col-xs-12">
	                {!! \App\Http\MyHelpers\ShopSimple\ShopTimelineProgress2::showProgress2("Shop") !!}
					</div>
	                <!--------------  END  Progress Status Icons by component ----------------->
					  
					

                    
					
					
					
					
					
					
					
					
					<!-- Show One product with hidden modal (by Render Partial) -->
					    <?php 
						//@include('ShopPaypalSimple.partial.oneProduct_with_hiddenModal', ['i' => 0, 'allDBProducts' => $productOne ]) <?php //arg[0] - is an iterator (to use in loop or for single, arg[1] - is an object with data ) 
					    ?>
					<!-- Shows One product with hidden modal (by Render Partial) -->
					
					<!--- Start ----->
					
					
					
					<div class="col-sm-12 col-xs-12 list-group-item alert alert-success">
					    <p class="list-group-item"> {{$productOne[0]->elast_title}}</p>
						<p class="list-group-item"> {{$productOne[0]->elast_text}}</p> 
						<p class="list-group-item"> {{$productOne[0]->elast_created_at}}</p> 
						<!--<p class="list-group-item"> <img class=" my-one" src="{{URL::to("/")}}/images/ShopSimple/{{$productOne[0]['shop_image'] }}"  alt="a" /></p>-->
					</div>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					


                    					
				</div> <!-- end .shop -->
				    
					
			
					
                
            </div> <!-- end .panel-default xo -->
        </div>
    </div>
</div> <!-- end . animate-bottom -->

<script>

</script>

@endsection