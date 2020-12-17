<?php
//Admin page to show all shop products
?>

@extends('layouts.app')

@section('content')

<!-- Include js/css file for this view only -->
<link href="{{ asset('css/ShopPaypalSimple/shopSimple.css') }}" rel="stylesheet"> 
<!-- End Include js/css file for this view only -->


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
					
					
					
					
					
					
                <div class="panel-heading text-warning col-sm-12 col-xs-12">
				     

					<!-- Link to go back -->
				    <div class="col-sm-8 col-xs-6">
					    <p>  
						     <i class="fa fa-address-card-o border shadowX" style="font-size:46px; margin-right: 0.5em;"></i>  
							 All shop products <span class="small text-danger">*</span> 
							 <br>  
						</p>
				        &nbsp;<i class="fa fa-hand-o-left" style="font-size:24px"></i>
				        <a href="{{ url('/shopAdminPanel') }}">back to admin panel </a>
                    </div>
					
					
					
					
					<!--- Start of Dropdown to switch between shop categories i.e "desktop/mobile". Built on SQL query to table {shop_categories} . Works on Bootstrap dropdown   -->
					<div class="col-sm-4 col-xs-6">
					
					    <div class="dropdown">
                             <i class="fa fa-chevron-down dropdown-toggle" data-toggle="dropdown"></i>   
                             Category
							 
                            <div class="dropdown-menu ">                                        
	                          <ul>
							      <li> <a class="dropdown-item" href={{ url("/admin-orders") }}>  All stuff  {!! (!isset($_GET['admin-product-category']))  ? ' <span class="text-danger">&hearts;</span>' : ' ' !!} </a></li> <!-- html unescapped tags / without escapping-->


							      @foreach($allCategories as $category)
								   <li> <a class="dropdown-item" href={{ url("/admin-orders") }}>  {{ $category->categ_name}}  {!! (isset($_GET['admin-product-category']) && $_GET['admin-product-category'] == $category->categ_name )  ? ' <span class="text-danger">&hearts;</span>' : ' ' !!} </a></li> <!-- html unescapped tags / without escapping-->
								  @endforeach
								  
                              </ul>
                            </div>
                        </div>
						
					</div>
					<!--- End Dropdown to select between "proceeded"/"non-proceeded" -->
				
				
					
				</div>
				
				
				<!-- Just info, may delete later -->
				<div class="col-sm-12 col-xs-12 alert alert-danger small font-italic text-danger  shadowX">
					</br> Some notes here.....
				</div>
				
				

                <div class="panel-body shop">
				
				    <div class="col-sm-10 col-xs-10">
                        <h1>All shop stuff</h1>
						
						<!-- Add new button -->
						<div class='col-sm-2 col-xs-4 subfolder shadowX'>
					       <a href="{{ route('admin-add-product') }}">  
						     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus-square-o" style="font-size:46px"></i> 
							 <p> &nbsp;&nbsp;Add new</p><br>  
						   </a>
		                 </div>
						 
		            </div>	
				
				  
				    <!-- If no orders in DB --> 
		            @if(count($allProducts) == 0)
					    <div class="col-sm-12 col-xs-12"><center><h4 class="text-danger"><i class="fa fa-calendar-check-o" style="font-size:24px"></i> 
							No products so far</center></h4>
						</div>
					@else
						
		
		
					  
					<!--------- Display products  --------------->
                    <div class="col-sm-12 col-xs-12 admin-orders">
					    @foreach($allProducts as $oneProduct)
						    <div class="col-sm-12 col-xs-12  list-group-item bg-success cursorX shadowX">
							
							    <div class="col-sm-3 col-xs-12">
							       {{ $oneProduct->shop_title }} <!-- product Name --> 
							    </div>
								
								<div class="col-sm-3 col-xs-12">
							       {{ $oneProduct->categoryName->categ_name }} <!-- Category. hasMany relation --> 
							    </div>
								
								<div class="col-sm-3 col-xs-12">
							       {{ $oneProduct->shop_price  }} {{ $oneProduct->shop_currency  }}  <!-- 1121 $ --> 
							    </div>
								
								<div class="col-sm-3 col-xs-12"><!-- Edit Button --> 
							       <button><a href = 'edit/{{ $oneProduct->shop_id }}'>  <span onclick="return confirm('Are you sure to edit?')">Edit via/GET  <img class="deletee"  src="{{URL::to("/")}}/images/edit.png"  alt="edit"/></span></a></button>  
							    </div>
							
							</div>
						@endforeach
					
			
					</div>  <!-- end .admin-orders-->
					<!--------- End Display products  --------------->	
                       
					
					
					
					<!-- Pagination -->
					<div class="col-sm-12 col-xs-12 ">
					{{ $allProducts->links() }}
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