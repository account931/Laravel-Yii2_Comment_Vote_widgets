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
                    <div class="col-sm-12 col-xs-12" style="width:80em;overflow-x: scroll;">
					
					<!-- THEAD -->
		            <div class="col-sm-12 col-xs-12  list-group-item">
		                <div class="col-sm-2 col-xs-6">UUID</div>
						<div class="col-sm-2 col-xs-6">Status</div>
			            <div class="col-sm-1 col-xs-6">Sum</div>
			            <div class="col-sm-1 col-xs-6">Quant</div>
						<div class="col-sm-2 col-xs-6">Items</div>
			            <div class="col-sm-2 col-xs-6">Name</div>
						<div class="col-sm-1 col-xs-6">Date</div>
						<div class="col-sm-1 col-xs-12">Paid</div>
		            </div>
		            <!-- End THEAD -->
							
					<?php  //dd($itemsInOrder[5][0]->item_price); //dd(($v->orderDetail)->count()); ?>
					<?php $i = 0; ?>
					@foreach($shop_orders_main as $v)
					  <div class="col-sm-12 col-xs-12  list-group-item">
						<div class="col-sm-2 col-xs-12 "><i class="fa fa-calendar-check-o" style="font-size:24px"></i> {{ $v-> ord_uuid}}</div>
						<div class="col-sm-2 col-xs-12 ">{{ $v-> ord_status}}</div>
						<div class="col-sm-1 col-xs-12 ">{{ $v-> ord_sum}}</div>
						<div class="col-sm-1 col-xs-12 ">{{ $v-> items_in_order}}</div>
						
						<!-- via ass -->
						<!-- hasMany. Order details from table {shop_order_item}-->
						<div class="col-sm-2 col-xs-6" style="font-size:0.8em;"> 
                           <?php  
						     //dd($v->orderDetail); //dd(($v->orderDetail)->count()); 
							 ?>
							@for($k = 0; $k < count($itemsInOrder[$i]); $k++)
							    @if($itemsInOrder[$i][$k]->item_price && $itemsInOrder[$i][$k]->item_price !== null) 
									
									<p><i class="fa fa-paperclip"></i> {{$itemsInOrder[$i][$k]->productName->shop_title}} </p> <!-- hasOne relation -->
									<p>{{$itemsInOrder[$i][$k]->item_price}}$ * {{$itemsInOrder[$i][$k]->items_quantity}}  </p> <!-- price  * quantity -->
								@else
									<p> Not found </p>
								@endif
							    
							@endfor
							
						   {{--$v->orderDetail->items_quantity--}}
						</div>  <!-- hasMany. Order details from table {shop_order_item}-->
						
                       <?php $i++; ?>
						
						<div class="col-sm-2 col-xs-12 ">{{ $v-> ord_name }} {{ $v-> ord_address }} {{ $v-> ord_email }}</div>
					    <div class="col-sm-1 col-xs-12 ">{{ $v-> ord_placed}}</div>
						<div class="col-sm-1 col-xs-12 ">{{ ($v-> if_paid==0)? "Not paid" : "Paid"}}</div>
					  </div>
					@endforeach
					</div>
					
					<!-- Pagination -->
					<div class="col-sm-12 col-xs-12 ">
					{{-- $shop_orders_main->links() --}}
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