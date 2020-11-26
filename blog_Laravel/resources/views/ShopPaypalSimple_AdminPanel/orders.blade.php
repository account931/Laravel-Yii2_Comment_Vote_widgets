<?php
//Admin page to show all shop orders in table
?>

@extends('layouts.app')

@section('content')

<!-- Include js/css file for this view only -->

<link href="{{ asset('css/ShopPaypalSimple/shopSimple.css') }}" rel="stylesheet"> 
<link href="{{ asset('css/ShopPaypalSimple_AdminPanel/shopSimpleAdmin_view_orders.css') }}" rel="stylesheet"> 


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
				    <a href="{{ url('/shopAdminPanel') }}">back to admin panel </a>
                    </div>
				</div>

                <div class="panel-body shop">
				
				    <div class="col-sm-10 col-xs-10">
                        <h1>Orders</h1>
		            </div>	
				
				  
				    <!-- If no orders in DB --> 
		            @if(count($shop_orders_main) == 0)
					    <div class="col-sm-12 col-xs-12"><center><h4 class="text-danger"><i class="fa fa-calendar-check-o" style="font-size:24px"></i> No orders so far</center></h4></div>
					@else
						
		
		
					  
					<!-- Display orders -->
                    <div class="col-sm-12 col-xs-12 fit-content">
					
					<!-- THEAD -->
		            <div class="col-sm-12 col-xs-12  list-group-item">
		                <div class="col-sm-2 col-xs-6">UUID</div>
						<div class="col-sm-2 col-xs-6">Status</div>
			            <div class="col-sm-1 col-xs-6">Sum</div>
			            <div class="col-sm-1 col-xs-6">Quant</div>
						<div class="col-sm-2 col-xs-6">Items</div>
			            <div class="col-sm-1 col-xs-6">Name</div>
						<div class="col-sm-1 col-xs-6">Date</div>
						<div class="col-sm-1 col-xs-6">Paid</div>
						<div class="col-sm-1 col-xs-6">User</div>
		            </div>
		            <!-- End THEAD -->
							
					<?php  //dd($itemsInOrder[5][0]->item_price); //dd(($v->orderDetail)->count()); ?>
					<?php $i = 0; ?>
					@foreach($shop_orders_main as $v)
					  <div class="col-sm-12 col-xs-12  list-group-item">
						<div class="col-sm-2 col-xs-12 "><i class="fa fa-calendar-check-o" style="font-size:24px"></i> {{ $v-> ord_uuid}}</div>
						<!-- Status: proceeded/not-proceeded -->
						<div class="col-sm-2 col-xs-12 ">{!! ($v->ord_status=='not-proceeded')? "<span class='text-danger'>Not proceeded</span>" : "<span class='text-success'>Pproceeded</span>" !!}</div><!-- Blade without escaping htmlentities()  -->
						<div class="col-sm-1 col-xs-12 "><span class="visible-inline-xs">Sum:   </span> {{ $v-> ord_sum}} ₴ </div>       <!-- .visible-xs visible in mobile only, .visible-inline-xs is used to display in same line not next -->
						<div class="col-sm-1 col-xs-12 "><span class="visible-inline-xs">Items: </span> {{ $v-> items_in_order}}</div>  <!-- .visible-xs visible in mobile only, .visible-inline-xs is used to display in same line not next -->
						
						
						
						
						
						<!-- hasMany. Order details from table {shop_order_item} i.e  HP notebook 2 pcs * 35.31 ₴-->
						
						<div class="col-sm-2 col-xs-12" style="font-size:0.8em;"> 
    
							
                            <!-- Start hasMany via ass. Working!!! Currently commented in view and reassigned to hasMany -->							
							<?php
							//php opening tag is used here only to comment the whole block of Blade
							/*
							@for($k = 0; $k < count($itemsInOrder[$i]); $k++)
							    @if($itemsInOrder[$i][$k]->item_price && $itemsInOrder[$i][$k]->item_price !== null) 
									<div class="border">
									  <p><i class="fa fa-paperclip"></i> {{$itemsInOrder[$i][$k]->productName->shop_title}} </p> 
									  <p>{{$itemsInOrder[$i][$k]->items_quantity}}  * {{$itemsInOrder[$i][$k]->item_price}}$  </p> {{-- quantity * price   --}}
								    </div>
								@else
									<p> Not found </p>
								@endif
							    
							@endfor
						   */
						   ?>
						   <!-- End hasMany via ass. Working!!! Currently commented in view and reassigned to hasMany -->
						   
						   
						   
						   
						    <!-- additionall check (in case u saved order to table {shop_orders_main} but saving to table {shop_order_item} failed and therefore table {shop_order_item} does not have related/corresponded column to  {shop_orders_main}) -->
						    @if( $v->orderDetail->isEmpty() )
								 corrupted data
							@else
						   
						       <!-- hasMany realtionShip, Working!!!!. Mega Error: hasMany must be inside second foreach -->
						       @foreach ($v->orderDetail as $x)
						       <div class="border">
							
							     <p><i class="fa fa-paperclip"></i> {{$x->productName->shop_title}} </p> 
							     <p> {{$x->items_quantity}} pcs  * {{$x->item_price}} ₴ = {{ $x->items_quantity * $x->item_price }} ₴ </p> {{-- quantity * price = sum  --}}
							   </div>		  
						       @endforeach
						       <!-- hasMany realtionShip, Working!!!! -->
						   
						   @endif
			 
						   
						</div>  <!-- hasMany. Order details from table {shop_order_item}-->
						
                       <?php $i++; ?>
						
						
						
						<!-- Buyer details, address, phone, etc -->
						<div class="col-sm-1 col-xs-12 "> {{ $v-> ord_name }}</br> {{ $v-> ord_address }}</br> {{ $v-> ord_email }} </div>
					    <!-- Date, teime when order was placed -->
						<div class="col-sm-1 col-xs-12 "> {{ $v-> ord_placed}}</div>
						<div class="col-sm-1 col-xs-12 "> {!! ($v-> if_paid==0)? "<span class='text-danger'>Not paid</span>" : "<span class='text-success'>Paid</span>" !!}</div> <!-- Blade without escaping htmlentities()  -->
					    <div class="col-sm-1 col-xs-12 "> <span class="visible-inline-xs">UserID: </span> {{ $v->ord_user_id }}</div> <!-- .visible-xs visible in mobile only, .visible-inline-xs is used to display in same line not next -->
					  </div>
					@endforeach
					</div>
					
					
					
					<!-- Pagination -->
					<div class="col-sm-12 col-xs-12 ">
					{{ $shop_orders_main->links() }}
					</div>
					<!-- Pagination -->
					
					@endif
                    
					
					
					
					
					
					
				
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					


                    					
				</div> <!-- end .shop -->
				    
					
			
					
                
            </div> <!-- end .panel-default xo -->
        </div>
    </div>
</div> <!-- end . animate-bottom -->

<script>

</script>

@endsection