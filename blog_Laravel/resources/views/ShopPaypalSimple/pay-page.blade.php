<?php
//show pay page. Show submitted on prev page Shipping form (address, phone etc ) & buttons to Pay.
?>

@extends('layouts.app')
<?php
//uses $_SESSION['cart_dimmm931_1604938863'] to store and retrieve user's cart; Format is { [8]=> int(3) [1]=> int(2) [4]=> int(1) }
?>

@section('content')

<!-- Include js/css file for this view only -->
<link href="{{ asset('css/ShopPaypalSimple/shopSimple.css') }}" rel="stylesheet"> 


<!-- Sweet Alerts -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> <!-- Sweet Alert CSS -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'></script> <!--Sweet Alert JS-->
<!-- Include js file for thisview only -->


<div id="allPrev" class="container animate-bottomPrev">
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
				    Pay your order <span class="small text-danger">*</span> 
					<!-- Link to go back -->
				    <div>
				    &nbsp;<i class="fa fa-hand-o-left" style="font-size:24px"></i>
				    <a href="{{ url('/shopSimple') }}">back to shop </a>
                    </div>
				</div>

                <div class="panel-body shop">
				
				    <div class="col-sm-10 col-xs-10">
                    <h1>Pay your order</h1>
		            </div>	
				
				    <!-------- Cart icon with badge ----------->
		            <?php 
		            //get the car quantity
		            if (isset($_SESSION['cart_dimmm931_1604938863'])) { 
		                $c = count($_SESSION['cart_dimmm931_1604938863']); 
		            } else { 
			           $c = 0; 
		             } ?>
		
		            <div class="col-sm-2 col-xs-2 badge1 bb" data-badge="<?php echo $c; ?> ">
					  <a href="{{ route('cart') }}"> <i class="fa fa-cart-plus fa-4x" aria-hidden="true"></i> </a>
                    </div>
                    <!-------- Cart icon with badge ----------->
		
		
		
		
				    <!-------------------- Progress Status Icons by component ----------------->
	                <!--display shop timeline progress via Helper => Progress Status Icons-->
					<div class="col-sm-12 col-xs-12">
	                {!! \App\Http\MyHelpers\ShopSimple\ShopTimelineProgress2::showProgress2("Payment") !!}
					</div>
	                <!--------------  END  Progress Status Icons by component ----------------->
					  
					

                    
					
					
					@if (!isset($_SESSION['cart_dimmm931_1604938863']) || (count($_SESSION['cart_dimmm931_1604938863']) == 0) )
		               <div class="col-sm-12 col-xs-12"> <br><br><br><center>
				       <h2> So far there is nothing to pay for  </h2>
		               <i class='fa fa-question-circle-o' style='font-size:58px;color:red'></i></center>
					   </div>
	                @else 
						
					 
					

					    <!------------  CART Products List ------------->
                        <div class="row shop-items"><hr>
	                        <div class="col-sm-12 col-xs-12 shadowX"><h3>You have <?=count($_SESSION['cart_dimmm931_1604938863']);?> items to Check-out</h3></div>
		 
		                    <!-- THEAD -->
		                    <div class="col-sm-12 col-xs-12  list-group-item shadowX">
		                        <div class="col-sm-4 col-xs-3">Name</div>
			                    <div class="col-sm-2 hidden-xs">Image</div> <!-- hidden in mobile -->
			                    <div class="col-sm-2 col-xs-4">Price</div>
			                    <div class="col-sm-2 col-xs-2">Quant</div>
			                    <div class="col-sm-2 col-xs-3">Sum</div>
		                    </div>
		                    <!-- End THEAD -->
	      
		                    <!-------------------------------------- Foreach $_SESSION['cart'] to dispaly all cart products --------------------------------------------->
		                    <?php
				            $startSec = time(); //seconds 
				            $startMicroSec = microtime(true); //microseconds
		                    $i = 0;	
                            $totalSum = 0;

				            var_dump($_SESSION['cart_dimmm931_1604938863']); 
				            echo "</br>";
				            //var_dump($inCartItems); 
				            ?>
				 
		                    @foreach($_SESSION['cart_dimmm931_1604938863'] as $key => $value)
		                      <?php
				              $i++;
			                  echo "<p>key " . $key . "</p>";
			                  //find in $inCartItems index the product by id. MEGA FIX => use array_search(($key-1),... instead of array_search($key-1, ...
			                  //$find =(int)$key - 1; echo "find " . $find; 
				 
				              //MEGA FIX, should find by column iD 'shop_id'
				              $keyN = array_search($key, array_column($inCartItems, 'shop_id')); //returns 3
				              //$keyN = array_search($find, array_keys($inCartItems)); //find in $inCartItems index the product by id
				 
				              //$keyN = $keyN - 1; //???? WTFFFF
				              echo "<p>found keyN " . $keyN . "</p>";
				              ?>						    						

			                  <!-- Start Display product -->
		                      <div id="{{$inCartItems[$keyN]['shop_id'] }}" class="col-sm-12 col-xs-12  list-group-item bg-success cursorX" data-toggle="modal" data-target="#myModal{{$i}}"> <!--  //data-toggle="modal" data-target="#myModal' . $i .   for modal -->
			                  
							  <!-- Display product name ( + in mobile shows image) --> 
				              <div class="col-sm-4 col-xs-3"> {{$inCartItems[$keyN]['shop_title'] }} 
				                  <!-- image visible for mobile only -->
				                  <div class="visible-xs"><img class="my-one" src="{{URL::to("/")}}/images/ShopSimple/{{$inCartItems[$keyN]['shop_image'] }} "  alt="a" /></div>
				              </div> <!--name-->
			     
				              <!--Dispalay image--> <!-- hidden in mobile -->
				              <div class="col-sm-2 hidden-xs"> <!-- hidden in mobile -->
				                  <img class="my-one" src="{{URL::to("/")}}/images/ShopSimple/{{$inCartItems[$keyN]['shop_image'] }} "  alt="a" />
                              </div>
				 
				              <!-- Display Price -->
			                  <div class="col-sm-2 col-xs-4 word-breakX font-mobile"> <span class="priceX">{{$inCartItems[$keyN]['shop_price']}} </span>  {{$inCartItems[$keyN]['shop_currency']}} </div>
				 
				     <!--Display quantity -->
		             <div class="col-sm-2 col-xs-2"> <!-- // . $_SESSION['cart_dimmm931_1604938863'][$keyN]; //quantity-->
				          <?php
				          $quantityX = $_SESSION['cart_dimmm931_1604938863'][$key]; //gets the quantity
				          ?>
					      {{$quantityX}} <!-- Quantity -->
				     </div>   <!--quantity-->	
				     {{--END quantity div => contains Yii2 ActiveForm --}}
				
				
				     {{--Sum for one product--}}
			         <div class="col-sm-2 col-xs-3 one-pr-sum font-mobile">{{ ($_SESSION['cart_dimmm931_1604938863'][$key]*$inCartItems[$keyN]['shop_price']) }} {{$inCartItems[$keyN]['shop_currency']}}</div>   {{--total sum for this product, price*quantity--}}
				     
		         </div>
				 
			     <?php
			     $totalSum+= $_SESSION['cart_dimmm931_1604938863'][$key]*$inCartItems[$keyN]['shop_price']; //Total sum for this one product (2x16.64=N)
		         ?>
		        @endforeach
		 
		 
		 
		 
		 <?php
		 $endSec = time();
		 $endtMicroSec = microtime(true);
		 echo "<p>BenchMark Session(Real Host)=> " . ($endSec - $startSec) . " sec vs " . ($endtMicroSec - $startMicroSec) . " microsec.</p>" ;
		 ?>
	  </div> <!-- row shop-items -->
	  
	  
	  <!-- Total sum for all products -->
	  <div class="col-sm-12 col-xs-12 shadowX">
	      <h3>Total: </h3>
		  <h2 id="finalSum"> {{ $totalSum }}  {{$inCartItems[$keyN]['shop_currency']}}</h2><hr> <!-- ₴ -->
	  </div>
  
     <?php //dd($input); ?>
      <div class="col-sm-12 col-xs-12 shadowX">
	  <hr>
	      <p> Order Id <i class="fa fa-check-square-o"></i>  {{ $input['u_uuid']   }}   </p>
	      <h3> Shipping details </h3> 
		  
		  <p> <i class="fa fa-address-card-o"></i>  {{ $input['u_name']    }}   </p>
		  <p> <i class="fa fa-archive"></i>         {{ $input['u_email']   }}   </p>
		  <p> <i class="fa fa-arrows"></i>          {{ $input['u_address'] }}   </p>
		  <p> <i class="fa fa-bell-o"></i>          {{ $input['u_phone']   }}   </p>
		  
		 
	  </div>
	  
	  
	  
  
       <!------- New form (with button "Pay with PayPal") -------->
	   <form method="post" class="form-assign" action="{{url('/addToCart')}}">
	       <input type="hidden" value="{{csrf_token()}}" name="_token"/></br>
	       <!--<input type="submit" class="btn btn-primary shadowX submitX rounded" value='Pay with PayPal <i style="font-size:24px" class="fa">&#xf1f4;</i> '/>-->
	       <button class="btn btn-primary" style="font-size:18px">Pay with PayPal <i class="fa fa-cc-paypal"></i></button>
	   </form>
	   
	   <!-- end New form (with button "Pay with PayPal")) -------->
				
		

       <!------- New form (with button "Pay with LiqPay") -------->
	   <form method="post" class="form-assign" action="{{url('/addToCart')}}">
	       <input type="hidden" value="{{csrf_token()}}" name="_token"/></br>
	       <!--<input type="submit" class="btn btn-primary shadowX submitX rounded" value="Pay with LiqPay f1f1; >"/>-->
	       <button class="btn btn-success" style="font-size:18px">Pay with LiqPay <i class="fa fa-cc-mastercard"></i></button>
	   </form>
	   <!-- end New form with button "Pay with LiqPay") ) -------->		
			

			
       <div class="col-sm-12 col-xs-12"> <!-- just Spacing -->
	       <hr>
	   </div>
  
  
  
  
  
  
  
  
  
  
  
  

                    
	@endif
					
					
					
					
					
				
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					


                    					
				</div> <!-- end .shop -->
				    
					
			
					
                
            </div> <!-- end .panel-default xo -->
        </div>
    </div>
</div> <!-- end . animate-bottom -->

<script>

</script>

@endsection