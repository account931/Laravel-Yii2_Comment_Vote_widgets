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
				    Shop PayPal <span class="small text-danger">*</span> 
				</div>

                <div class="panel-body shop">
				
				    <div class="col-sm-10 col-xs-10">
                    <h1>Shop PayPal</h1>
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
		
		
		
		
				    <!-------------------- Progress Status Icons by component ----------------->
	                <!--display shop timeline progress via Helper => Progress Status Icons-->
					<div class="col-sm-12 col-xs-12">
	                {!! \App\Http\MyHelpers\ShopSimple\ShopTimelineProgress2::showProgress2("Shop") !!}
					</div>
	                <!--------------  END  Progress Status Icons by component ----------------->
					  
					








                    
					
					
					
					
					
					
					<?php
					
					 $productsX = array(); // array to store formatted results from DB (from controller)
  
  //getting results from DB to array in format => [ ['id'=>0, 'name'=> 'canon'], [], ]
  //We get from DB an array of object {$allDBProducts} and here convert to array of arrays[$productsX]. It is just another variation, we could use direct referring to array of object {$allDBProducts} like {$allDBProducts->l_name}, but in this case we have to rewrite the code below, as it was originally designed for array of arrays[$productsX] (as firstly I created artificial hardcoded array of arrays[$productsX]) 
  foreach($allDBProducts as $a){ 
	  $tempo = array();
	  $tempo['id'] = $a->l_id;
	  $tempo['name'] = $a->getCustomer($a->l_name);//$a->l_name;//  ShopSimple::getLabel();
	  $tempo['price'] = $a->l_price;
	  $tempo['image'] = $a->l_image;
	  $tempo['description'] = $a->l_descript;
	 // array_push($tempo['description'], $a->l_descript);
	  
	  array_push($productsX, $tempo ); //adds to final array
  }
  
  //var_dump($productsX);
  
  $_SESSION['productCatalogue'] = $productsX; //all products from DB to session
  
  ?>
  
  
  
      <div class="row shop-items">
	      <?php
	
		  
		  
		  //generate shop products, Loop ----------------------------------------------------------
	      for($i = 0; $i < count($productsX); $i++){
          
		       
			
		       
			   	
			echo '<div id="' . $productsX[$i]['id'] . '" class="col-sm-5 col-xs-12  list-group-item bg-success cursorX shadowX modal-trigger" data-toggle="modal" data-target="#myModal' . $i . '">' .  //data-toggle="modal" data-target="#myModal' . $i .   for modal
			       '<div class="col-sm-4 col-xs-3">' . $productsX[$i]['name'] . '</div>' . 
				   '<div class="col-sm-2 col-xs-2 word-breakX">' . $productsX[$i]['price']. '₴</div>' .
				   '<div class="col-sm-2 col-xs-3">' . $myInputModel->truncateTextProcessor($productsX[$i]['description'], 8) .  '</div>' .  	
				   '<div class="col-sm-4 col-xs-4">' . 
				       //Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/shopLiqPay_Simple/' . $productsX[$i]['image'] , $options = ["id"=>"","margin-left"=>"","class"=>"my-one lazy", "data-original" => '', "width"=>"","title"=>"product"]).
                       
					   //LightBox variant, need downloading spec css/js libraries, see https://github.com/account931/portal_v2/blob/master/assets/AppAsset.php
					   /*"<a href= " . Yii::$app->getUrlManager()->getBaseUrl(). '/images/shopLiqPay_Simple/'. $productsX[$i]['image']  . "  data-lightbox='image-1' data-title='My caption'>" .
					       '<img data-src=' .  Yii::$app->getUrlManager()->getBaseUrl(). '/images/shopLiqPay_Simple/'. $productsX[$i]['image']  . ' class="my-one lightboxed">'. //LazyLoad
						"</a>" .*/
						
						//lazyLoad
						'<img class="lazy my-one" data-original="' . Yii::$app->getUrlManager()->getBaseUrl(). '/images/shopLiqPay_Simple/'. $productsX[$i]['image'] . '" >' .
						
				   '</div>' .   
				 '</div>';
				 
			
			//adds vertical space after 2 divs with goods
			if($i%2 != 0 ){ 
			    echo '<div class="col-sm-12 col-xs-12">even</div>';
			} else { //add horizontal space between 2 goods
				echo '<div class="col-sm-1 col-xs-1">s</div>';
			}
		    ?>


		
		 <!--------- Hidden Modal ---------->
           <div class="modal fade" id="myModal<?php echo $i;?>" role="dialog">
               <div class="modal-dialog modal-lg">
                   <div class="modal-content">
                       <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                           <h4 class="modal-title"><i class="fa fa-delicious" style="font-size:3em; color: navy;"></i> <b> Product</b> </h4>
						   <?php
						    //checks if this product already in the cart
						    if (isset($_SESSION['cart-simple-931t']) && isset($_SESSION['cart-simple-931t'][$productsX[$i]['id']])){
								echo "<p class='text-danger'>Already " . $_SESSION['cart-simple-931t'][$productsX[$i]['id']] . " items was added to the cart.</p>";
							} else {
							}
						   ?>
                       </div>
					   
                      <div class="modal-body">
                          <p><b> <?=$productsX[$i]['name'];?></b></p>
						  
						  <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Price</div>
						      <div class="col-sm-4 col-xs-9"><span class="price-x"><?=$productsX[$i]['price'];?></span> ₴</div> 
						  </div>
						  
						  <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Info</div>
						      <div class="col-sm-4 col-xs-9"><?=$productsX[$i]['description'];?></div> 
						  </div>
						  
						  <!--- Total product sum calculation (2x16.64=N) -->
						   <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Total</div>
						      <div class="col-sm-9 col-xs-9 shadowX"><span class="sum"></span></div> 
						  </div>
						  
						  
						  <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Image</div>
						      <div class="col-sm-8 col-xs-9"><?=Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/shopLiqPay_Simple/' . $productsX[$i]['image'] , $options = ["id"=>"","margin-left"=>"","class"=>"my-one-modal","width"=>"","title"=>"product"]);?></div>
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
						     <button type="button" class="btn btn-primary button-plus" data-priceX="<?=$productsX[$i]['price'];?>">+</button>
						 </div>
						 
						 
						
						 <!-- form with input -->
						 <div class="col-sm-2 col-xs-3">
					         <?php 
							 
							 //check if product already in cart, if Yes-> get its quantity, if no-. sets to 1
							 if (isset($_SESSION['cart-simple-931t']) && isset($_SESSION['cart-simple-931t'][$productsX[$i]['id']])){
							     $quantityX = $_SESSION['cart-simple-931t'][$productsX[$i]['id']]; //gets the quantity from cart
							 } else {
								 $quantityX = 1;
		                     }
							 
							 //Form with quantity input
					         $form = ActiveForm::begin(['action' => ['shop-liqpay-simple/add-to-cart'],'options' => ['method' => 'post', 'id' => 'formX'],]); 
                                 echo $form->field($myInputModel, 'yourInputValue')->textInput(['maxlength' => true,'value' => $quantityX, 'class' => 'item-quantity form-control'])->label(false); //product quantity input
                                 echo $form->field($myInputModel, 'productID')->hiddenInput(['value' => $productsX[$i]['id'],])->label(false); //product ID hidden input

							 ?>
								 
 	                             <div class="form-group">
                                    <?= Html::submitButton(Yii::t('app', 'Add to cart'), ['class' => 'btn btn-primary shadowX submitX rounded' , 'id'=>'']) ?>
                                 </div>
                             <?php ActiveForm::end(); ?>
						  </div>
						  
						  <!-- End form with input -->
						  
						  
						  <!--- Minus button -->
						  <?php
						  //getting flag, used to detect if product is already in cart
						  if (isset($_SESSION['cart-simple-931t']) && isset($_SESSION['cart-simple-931t'][$productsX[$i]['id']])){
							  $ifInCartFlag = " data-cartFlag ='true'";
						  } else {
							  $ifInCartFlag = " data-cartFlag ='false' ";
						  }
						  ?>
						  <div class="col-sm-1 col-xs-2"> 
						     <button type="button" class="btn btn-danger button-minus" data-priceX="<?php echo $productsX[$i]['price'].'"'; echo $ifInCartFlag; ?>>-</button>
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
		  
		  <?php
		  }
		  ?>
	  </div> <!-- row shop-items -->
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  





















                





































				
				</div> <!-- end .shop -->
				    
					
			
					
                
            </div> <!-- end .panel-default xo -->
        </div>
    </div>
</div> <!-- end . animate-bottom -->

<!-- Include js/css file for this view only -->
<script src="{{ asset('js/ShopPaypalSimple/shopSimple_Loader.js')}}"></script> <!-- CSS Loader -->
<script src="{{ asset('js/ShopPaypalSimple/shopSimple.js')}}"></script> 
<link href="{{ asset('css/ShopPaypalSimple/shopSimple.css') }}" rel="stylesheet">
<link href="{{ asset('css/ShopPaypalSimple/shopSimple_Loader.css') }}" rel="stylesheet">
<!-- Include js file for thisview only -->


@endsection
