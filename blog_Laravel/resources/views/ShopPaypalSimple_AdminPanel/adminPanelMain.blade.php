@extends('layouts.app')

@section('content')
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
				    Shop PayPal Admin Panel <span class="small text-danger">*</span> 
				</div>



                <div class="panel-body shop">
				
				    <div class="col-sm-10 col-xs-10">
                    <h1>Shop PayPal Admin Panel</h1>
		            </div>	
				
				    <!-------- Cart icon with badge ----------->
		            <?php 
		            //get the car quantity
		            if (isset($_SESSION['cart-simple-931t'])) { 
		                $c = count($_SESSION['cart-simple-931t']); 
		            } else { 
			           $c = 0; 
		             } ?>
		
		            <div class="col-sm-2 col-xs-2 badge1 bb" data-badge="<?php echo $c; ?> ">
					  <a href="{{ route('cart') }}"> <i class="fa fa-cart-plus fa-4x" aria-hidden="true"></i> </a>
                    </div>
                    <!-------- Cart icon with badge ----------->
		
		
		
		
				    <!-------------------- Admin Panel Icons ----------------->
	                <!-- Admin account menu items -->
                    <div class="col-sm-12 col-xs-12 adm-icons"> <hr>
                      <center>
	   
	                  <div class="col-sm-2 col-xs-6 mobile-padding badge1 bb " data-badge=""> <!-- badge -->
                        <div class='subfolder border shadowX'>
					       <a href="{{ route('cart') }}">  
						     <i class="fa fa-address-card-o" style="font-size:96px"></i> 
							 <p>Products</p><br>  
						   </a>
		                 </div> 
                      </div>
					  
					  
					  <div class="col-sm-2 col-xs-6 mobile-padding badge1 bb " data-badge=""> <!-- badge -->
                        <div class='subfolder border shadowX'>
					       <a href="{{ route('cart') }}">  
						     <i class="fa fa-truck" style="font-size:96px"></i> 
							 <p>Orders</p><br>  
						   </a>
		                 </div> 
                      </div>
					  
					   <div class="col-sm-2 col-xs-6 mobile-padding badge1 bb " data-badge=""> <!-- badge -->
                        <div class='subfolder border shadowX'>
					       <a href="{{ route('cart') }}">  
						     <i class="fa fa-automobile" style="font-size:96px"></i> 
							 <p>Some text</p><br>  
						   </a>
		                 </div> 
                      </div>
	   
	   
	                  <div class="col-sm-2 col-xs-6 mobile-padding badge1 bb " data-badge=""> <!-- badge -->
                        <div class='subfolder border shadowX'>
					       <a href="{{ route('cart') }}">  
						     <i class="fa fa-book" style="font-size:96px"></i> 
							 <p>Some text</p><br>  
						   </a>
		                 </div> 
                      </div>
	         
			
			
                    </div><!-- class='adm-icons' -->
                    <!-- End Personal account menu items -->
	                <!--------------  END  Admin Panel Icons ----------------->
				






				
					  
				</div> <!-- end .shop -->
				    
					
			
					
                
            </div> <!-- end .panel-default xo -->
        </div>
    </div>
</div> <!-- end . animate-bottom -->

<!-- Include js/css file for this view only -->
<script src="{{ asset('js/ShopPaypalSimple/shopSimple_Loader.js')}}"></script><!-- CSS Loader -->
<link href="{{ asset('css/ShopPaypalSimple_AdminPanel/shopSimpleAdminPanel.css') }}" rel="stylesheet">
<link href="{{ asset('css/ShopPaypalSimple/shopSimple_Loader.css') }}" rel="stylesheet">
<!-- Include js file for thisview only -->


@endsection
