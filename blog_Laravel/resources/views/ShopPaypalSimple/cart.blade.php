@extends('layouts.app')
<?php
//uses $_SESSION['cart_dimmm931_1604938863'] to store and retrieve user's cart;
?>

@section('content')


<!-- Include js/css file for this view only -->
<script src="{{ asset('js/ShopPaypalSimple/shopSimple_Loader.js')}}"></script> <!-- CSS Loader -->
<link href="{{ asset('css/ShopPaypalSimple/shopSimple.css') }}" rel="stylesheet">
<link href="{{ asset('css/ShopPaypalSimple/shopSimple_Loader.css') }}" rel="stylesheet">

<!-- Include js file for this view only -->


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
				    Shop Cart <span class="small text-danger">*</span> 
				</div>

                <div class="panel-body shop">
				
				    <div class="col-sm-10 col-xs-10">
                    <h1>Shop PayPal Cart</h1>
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
	                {!! \App\Http\MyHelpers\ShopSimple\ShopTimelineProgress2::showProgress2("Cart") !!}
					</div>
	                <!--------------  END  Progress Status Icons by component ----------------->
					  
					





                    
                    
					
					
					
					
				    	
					
					@if (!isset($_SESSION['cart_dimmm931_1604938863']) || (count($_SESSION['cart_dimmm931_1604938863']) == 0) )
		               <div class="col-sm-12 col-xs-12"> <br><br><br><center>
				       <h2> So far the cart is empty  <i class='fa fa-cart-arrow-down' aria-hidden='true'></i></h2>
		               <i class='fa fa-question-circle-o' style='font-size:58px;color:red'></i></center>
					   </div>
	                @else 
                    
  
   
                    <!------------  CART Products List ------------->
                    <div class="row shop-items">
	                <div class="col-sm-12 col-xs-12 shadowX"><h3>You have <?=count($_SESSION['cart_dimmm931_1604938863']);?> items in your cart </h3></div>
		 
		           <!-- THEAD -->
		           <div class="col-sm-12 col-xs-12  list-group-item shadowX">
		           <div class="col-sm-4 col-xs-2">Name</div>
			       <div class="col-sm-2 col-xs-2">Image</div>
			       <div class="col-sm-2 col-xs-2">Price</div>
			       <div class="col-sm-1 col-xs-3">Quant</div>
			       <div class="col-sm-2 col-xs-3">Sum</div>
		           </div>
		           <!-- End THEAD -->
	      
		           <!-------------------------------------- Foreach $_SESSION['cart'] to dispaly all cart products --------------------------------------------->
		          @php
				  $startSec = time(); //seconds 
				  $startMicroSec = microtime(true); //microseconds
		          $i = 0;	
                  $totalSum = 0;
		          @endphp
		  
		         <form method="post" class="form-assign" action="{{url('/checkOut')}}">
				 <input type="hidden" value="{{csrf_token()}}" name="_token"/>
		  
		         <?php 
				 var_dump($_SESSION['cart_dimmm931_1604938863']); 
				 //var_dump($_SESSION['productCatalogue']); 
				 ?>
				 
		         @foreach($_SESSION['cart_dimmm931_1604938863'] as $key => $value)
		         <?php
				 $i++;
			     echo "<p>key " . $key . "</p>";
			     //find in $_SESSION['productCatalogue'] index the product by id. MEGA FIX => use array_search(($key-1),... instead of array_search($key-1, ...
			     $find =(int)$key - 1;
				 $keyN = array_search($find, array_keys($_SESSION['productCatalogue'])); //find in $_SESSION['productCatalogue'] index the product by id
				 //$keyN = $keyN - 1; //???? WTFFFF
				 echo "<p>found keyN " . $keyN . "</p>";
				 ?>						    						

			     <!--Dispalay products-->
		         <div id="{{$_SESSION['productCatalogue'][$keyN]['shop_id'] }}" class="col-sm-12 col-xs-12  list-group-item bg-success cursorX" data-toggle="modal" data-target="#myModal{{$i}}"> <!--  //data-toggle="modal" data-target="#myModal' . $i .   for modal -->
			     <div class="col-sm-4 col-xs-2"> {{$_SESSION['productCatalogue'][$keyN]['shop_title'] }} </div> <!--name-->
			     <div class="col-sm-2 col-xs-2 word-breakX"> 
				    <img class="lazy my-one" src="{{URL::to("/")}}/images/ShopSimple/{{$_SESSION['productCatalogue'][$keyN]['shop_image'] }} "  alt="a" />
                 </div>
				 
				<!-- Price -->
			    <div class="col-sm-2 col-xs-2 word-breakX"> {{$_SESSION['productCatalogue'][$keyN]['shop_price']}} ₴</div>
				 
				<!--//quantity div => contains Yii2 ActiveForm -->
		        <div class="col-sm-1 col-xs-3"> <!-- // . $_SESSION['cart_dimmm931_1604938863'][$keyN]; //quantity-->
				   <?php
				   
				   $quantityX = $_SESSION['cart_dimmm931_1604938863'][$key]; //gets the quantity
				   //var_dump($quantityX);
				    //$form = ActiveForm::begin(['action' => ['shop-liqpay-simple/add-to-cart'],'options' => ['method' => 'post', 'id' => ''],]); 
					//echo $form->field($myInputModel, 'yourInputValue')->textInput(['maxlength' => true,'value' => $quantityX, 'class' => 'form-control'])->label(false); //product quantity input
					//ActiveForm::end();
					?>
                    <input type="hidden" value="{{$_SESSION['productCatalogue'][$keyN]['shop_id']}}" name="productID[]" />
					<input type="text"  value="{{$quantityX}}" name="yourInputValueX[]" class="form-control" />
				</div>   <!--quantity-->	
				{{--END quantity div => contains Yii2 ActiveForm --}}
				
				{{--Sum for one product--}}
			    <div class="col-sm-2 col-xs-3">{{ ($_SESSION['cart_dimmm931_1604938863'][$key]*$_SESSION['productCatalogue'][$keyN]['shop_price']) }} {{$_SESSION['productCatalogue'][$keyN]['shop_currency']}}</div>   {{--total sum for this product, price*quantity--}}
				     
		      </div>
				 
			<?php
			$totalSum+= $_SESSION['cart_dimmm931_1604938863'][$key]*$_SESSION['productCatalogue'][$keyN]['shop_price']; //Total sum for this one product (2x16.64=N)
		    ?>
		 @endforeach
		 
		 <input type="submit" class="btn btn-info btn-lg shadowX" value="Check-out">
		 </form>
		 
		 
		 <?php
		 $endSec = time();
		 $endtMicroSec = microtime(true);
		 echo "<p>BenchMark Session(Real Host)=> " . ($endSec - $startSec) . " sec vs " . ($endtMicroSec - $startMicroSec) . " microsec.</p>" ;
		 ?>
	  </div> <!-- row shop-items -->
	  
	  
	  <!-- Total sum for all products -->
	  <div class="col-sm-12 col-xs-12 shadowX">
	      <h3>Total: </h3>
		  <h2> {{ $totalSum }} ₴</h2>
	  </div>
  
  
       <div class="col-sm-12 col-xs-12">
	     <hr>
		 <!--
	     <input type="submit" class="btn btn-info btn-lg shadowX" value="Check-out">
		 </form>
		 -->
	  </div>
  
  
  @endif
  
  
  
  
  
  
  
  




















					
				</div> <!-- end .shop -->
				    
					
			
					
                
            </div> <!-- end .panel-default xo -->
        </div>
    </div>
</div> <!-- end . animate-bottom -->


@endsection