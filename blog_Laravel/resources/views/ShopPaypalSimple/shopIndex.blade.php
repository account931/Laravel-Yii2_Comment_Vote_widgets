@extends('layouts.app')

<?php
//uses $_SESSION['cart_dimmm931_1604938863'] to store and retrieve user's cart;
?>

@section('content')

<!-- Include js/css file for this view only -->
<script src="{{ asset('js/ShopPaypalSimple/shopSimple_Loader.js')}}"></script> <!-- CSS Loader -->
<script src="{{ asset('js/ShopPaypalSimple/shopSimple.js')}}"></script>   
<!--<script src="{{ asset('js/ShopPaypalSimple/LazyLoad/jquery.lazyload.js')}}"></script>--> <!--Lazy Load lib JS-->
<link href="{{ asset('css/ShopPaypalSimple/shopSimple.css') }}" rel="stylesheet">
<link href="{{ asset('css/ShopPaypalSimple/shopSimple_Loader.css') }}" rel="stylesheet">

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
				    Shop PayPal <span class="small text-danger">*</span> 
				</div>

                <div class="panel-body shop">
				
				    <div class="col-sm-10 col-xs-10">
                    <h1>Shop PayPal</h1>
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
	                {!! \App\Http\MyHelpers\ShopSimple\ShopTimelineProgress2::showProgress2("Shop") !!}
					</div>
	                <!--------------  END  Progress Status Icons by component ----------------->
					  
					








                   
                    				   
					
					<?php
					/*
					$allDBProducts = array(); // array to store formatted results from DB (from controller)
  
                    //getting results from DB to array in format => [ ['id'=>0, 'name'=> 'canon'], [], ]
                    //We get from DB an array of object {$allDBProducts} and here convert to array of arrays[$allDBProducts]. It is just another variation, we could use direct referring to array of object {$allDBProducts} like {$allDBProducts->l_name}, but in this case we have to rewrite the code below, as it was originally designed for array of arrays[$allDBProducts] (as firstly I created artificial hardcoded array of arrays[$allDBProducts]) 
                    foreach($allDBProducts as $a){ 
	                  $tempo = array();
	                  $tempo['id'] = $a->shop_id;
	                  $tempo['name'] =  $a->shop_title  ;//$a->l_name;//  ShopSimple::getLabel();
	                  $tempo['price'] = $a->shop_price;
					  $tempo['currency'] = $a->shop_currency;
	                  $tempo['image'] = $a->shop_image;
	                  $tempo['description'] = $a->shop_descr;
	  
	                  array_push($allDBProducts, $tempo ); //adds to final array
                    }
  
                    //var_dump($allDBProducts);
                    $_SESSION['productCatalogue'] = $allDBProducts; //all products from DB to session
					*/
                    ?>
  
  
  
                    <div class="row shop-items">
	                
					
					@if(count($allDBProducts) == 0)
						<center><br><br><p> No products in DB </p></center>
					@endif
	               
				   
		            <!--generate shop products, Loop ---------------------------------------------------------->
					@for ($i = 0; $i < count($allDBProducts); $i++)
			   	
			        <div id="{{$allDBProducts[$i]['id']}}" class="col-sm-5 col-xs-12  list-group-item bg-success cursorX shadowX modal-trigger" data-toggle="modal" data-target="#myModal{{$i}}"> <!--data-toggle="modal" data-target="#myModal' . $i .   for modal -->
			          <div class="col-sm-4 col-xs-3"> {{$allDBProducts[$i]['shop_title']}} </div>
				      <div class="col-sm-2 col-xs-2 word-breakX"> {{$allDBProducts[$i]['shop_price']}}   {{$allDBProducts[$i]['shop_currency']}}</div>
				      <div class="col-sm-2 col-xs-3">             {{$model->truncateTextProcessor($allDBProducts[$i]['shop_descr'], 8) }}  </div>  	
				      <div class="col-sm-4 col-xs-4">
                        <!--  
					        //LightBox variant, need downloading spec css/js libraries, see https://github.com/account931/portal_v2/blob/master/assets/AppAsset.php
					        /*"<a href= " . Yii::$app->getUrlManager()->getBaseUrl(). '/images/shopLiqPay_Simple/'. $allDBProducts[$i]['image']  . "  data-lightbox='image-1' data-title='My caption'>" .
					       '<img data-src=' .  Yii::$app->getUrlManager()->getBaseUrl(). '/images/shopLiqPay_Simple/'. $allDBProducts[$i]['image']  . ' class="my-one lightboxed">'. //LazyLoad
						    "</a>" .*/
					    -->
						
						   <!--lazyLoad-->
						<!--<img class="lazy my-one" data-original="' . Yii::$app->getUrlManager()->getBaseUrl(). '/images/shopLiqPay_Simple/'. $allDBProducts[$i]['image'] . '" >-->
					    <img class="my-one" src="{{URL::to("/")}}/images/ShopSimple/{{$allDBProducts[$i]['shop_image'] }}"  alt="a"/>
					  </div>   
				     </div>
				 
			
			            <!--adds vertical space after 2 divs with goods-->
			            @if($i%2 != 0 )
			               <div class="col-sm-12 col-xs-12">even</div>
			            @else 
							<!--add horizontal space between 2 goods-->
				            <div class="col-sm-1 col-xs-1">s</div>
			            @endif
						
		                


		
		             <!--------- Hidden Modal ---------->
                     <div class="modal fade" id="myModal{{$i}}" role="dialog">
                       <div class="modal-dialog modal-lg">
                         <div class="modal-content">
                           <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                             <h4 class="modal-title"><i class="fa fa-delicious" style="font-size:3em; color: navy;"></i> <b> Product</b> </h4>
						   <?php
						    //checks if this product already in the cart
						    if (isset($_SESSION['cart_dimmm931_1604938863']) && isset($_SESSION['cart_dimmm931_1604938863'][$allDBProducts[$i]['shop_id']])){
								echo "<p class='text-danger'>Already " . $_SESSION['cart_dimmm931_1604938863'][$allDBProducts[$i]['shop_id']] . " items was added to the cart.</p>";
							} else {
							}
						   ?>
                       </div>
					   
                      <div class="modal-body">
                          <p><b> {{$allDBProducts[$i]['shop_title']}} </b></p>
						  
						  <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Price</div>
						      <div class="col-sm-4 col-xs-9"><span class="price-x"> {{$allDBProducts[$i]['shop_price']}} </span> {{$allDBProducts[$i]['shop_currency']}}  </div> 
						  </div>
						  
						  <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Info</div>
						      <div class="col-sm-4 col-xs-9"> {{$allDBProducts[$i]['shop_descr']}} </div> 
						  </div>
						  
						  <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Category</div>
						      <div class="col-sm-4 col-xs-9"> {{$allDBProducts[$i]->categoryName->categ_name}} </div>  
						  </div>
						  
						  <!--- Total product sum calculation (2x16.64=N) -->
						   <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Total</div>
						      <div class="col-sm-9 col-xs-9 shadowX"><span class="sum"></span></div> 
						  </div>
						  
						  
						  <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Image</div>
						      <div class="col-sm-8 col-xs-9"><img class="my-one-modal" src="{{URL::to("/")}}/images/ShopSimple/{{$allDBProducts[$i]['shop_image']}}"  alt="a"/></div>
						  </div>  
					 
                     </div>
					 
					 <!--- Dublicate: Total product sum calculation (2x16.64=N) -->
					  <!--<div class="col-sm-12 col-xs-12">
					      <div class="col-sm-5 col-xs-2 shadowX"></div> 
						  
					      <div class="col-sm-3 col-xs-6 list-group-item ">
						      <span class="sum"></span>
						  </div>
					  </div>-->
						 
						 
						 
					 <!---------- Section ++button /form input/--button ------->
					 <div class="row">
					 
					     <!--- Empty div to keep distance -->
					     <div class="col-sm-4 col-xs-2"> 
						 </div>
					    
						
						<!--- Plus button -->
					     <div class="col-sm-1 col-xs-2"> 
						     <button type="button" class="btn btn-primary button-plus" data-currX="{{$allDBProducts[$i]['shop_currency']}}" data-priceX="{{$allDBProducts[$i]['shop_price']}}">+</button>
						 </div>
						 
						 
						
						 <!-- form with input -->
						 <div class="col-sm-2 col-xs-3">
					         <?php 
							 
							 //check if product already in cart, if Yes-> get its quantity, if no-. sets to 1
							 if (isset($_SESSION['cart_dimmm931_1604938863']) && isset($_SESSION['cart_dimmm931_1604938863'][$allDBProducts[$i]['shop_id']])){
							     $quantityX = $_SESSION['cart_dimmm931_1604938863'][$allDBProducts[$i]['shop_id']]; //gets the quantity from cart
							 } else {
								 $quantityX = 1;
		                     }
							
							 
							 //Form with quantity input
							 /*
					         $form = ActiveForm::begin(['action' => ['shop-liqpay-simple/add-to-cart'],'options' => ['method' => 'post', 'id' => 'formX'],]); 
                                 echo $form->field($myInputModel, 'yourInputValue')->textInput(['maxlength' => true,'value' => $quantityX, 'class' => 'item-quantity form-control'])->label(false); //product quantity input
                                 echo $form->field($myInputModel, 'productID')->hiddenInput(['value' => $allDBProducts[$i]['id'],])->label(false); //product ID hidden input
                              */
							 ?>
								
                               <!--								
 	                             <div class="form-group">
                                    <?php // echo Html::submitButton(Yii::t('app', 'Add to cart'), ['class' => 'btn btn-primary shadowX submitX rounded' , 'id'=>'']) ?>
                                 </div>
								 -->
                             <?php // ActiveForm::end(); ?>
							 
							 
							 
							 <!-- New form -->
							 <form method="post" class="form-assign" action="{{url('/assignRole')}}">
							   <input type="text" value="{{$quantityX}}" name="yourInputValue" class="item-quantity form-control" />
							   <input type="hidden" value="{{$allDBProducts[$i]['shop_id']}}" name="productID" />
							 </form>
							 <!-- end new form -->
						  </div>
						  
						  <!-- End form with input -->
						  
						  
						  <!--- Minus button -->
						  <?php
						  //getting flag, used to detect if product is already in cart
						  if (isset($_SESSION['cart_dimmm931_1604938863']) && isset($_SESSION['cart_dimmm931_1604938863'][$allDBProducts[$i]['shop_id']])){
							  $ifInCartFlag = " data-cartFlag ='true'";
						  } else {
							  $ifInCartFlag = " data-cartFlag ='false' ";
						  }
						  ?>
						  <div class="col-sm-1 col-xs-2"> 
						     <button type="button" class="btn btn-danger button-minus" data-currX="{{$allDBProducts[$i]['shop_currency']}}"  data-priceX="<?php echo $allDBProducts[$i]['shop_price'].'"'; echo $ifInCartFlag; ?>>-</button>
						 </div>
						 
                         <!--- Empty div to keep distance -->						 
						 <div class="col-sm-3 col-xs-3">
						 </div>
						  
					 </div>
					 <!---------- END Section ++button /form input/--button ------->
					 
					 
					  
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
           </div>
          <!------------ End Modal ---------------> 
		  
		  
		  @endfor
		  
	  </div> <!-- row shop-items -->
					
			
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  





















                





































				
				</div> <!-- end .shop -->
				    
					
			
					
                
            </div> <!-- end .panel-default xo -->
        </div>
    </div>
</div> <!-- end . animate-bottom -->



@endsection
