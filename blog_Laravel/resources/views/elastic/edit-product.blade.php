<?php
//Admin page to edit a product
?>

@extends('layouts.app')

@section('content')

<!-- Include js/css file for this view only + SEE ONE JS AT THE BOTTOM -->
<link href="{{ asset('css/Polymorphic/product_tabs.css') }}" rel="stylesheet"> <!-- Css for W3school Full Page Tabs (uses css + js) https://www.w3schools.com/howto/howto_js_full_page_tabs.asp  -->

<!-- Sweet Alerts -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> <!-- Sweet Alert CSS -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'></script> <!--Sweet Alert JS-->
<!-- Include js file for this view only -->




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
						     <i class="fa fa-paperclip border shadowX" style="font-size:46px; margin-right: 0.5em;"></i>  
							 Edit  <span class="small text-danger">*</span> 
							 <br>  
						</p>
				        
						&nbsp;<i class="fa fa-arrow-circle-o-left" style="font-size:24px"></i>&nbsp;  <a href="{{ url('/elastic') }}">back to View all Elastic Gii </a><br>
                    </div>
					
					
					
					
					<!--- Start of Dropdown to switch between shop categories i.e "desktop/mobile". Built on SQL query to table {shop_categories} . Works on Bootstrap dropdown   -->
					<div class="col-sm-4 col-xs-6">
					    Some right stuff
					</div>
					<!--- End Dropdown to select between "proceeded"/"non-proceeded" -->
				
				
					
				</div>
				
				
				<!-- Just info, may delete later -->
				<div class="col-sm-12 col-xs-12 alert alert-info small font-italic text-danger  shadowX">
					</br> Some notes here.....
				</div>
				
				

                <div class="panel-body shop">
				
				    <div class="col-sm-10 col-xs-10">
                        <h1>Edit an Elast Post item</h1>
		            </div>	
				
				  
		
		            
					
					
					
					
					
					
					<!-- Here displays page: edit product -->
				    <div class="col-sm-12 col-xs-12 admin-add-new-item">
					


                        <div class="col-sm-12 col-xs-12"">
						    <p> Apart from DB updating, this entry will reindexed on Elastic Cloud </p>
							
                            <!--------- Form to a add new item   --------------->
				            <form class="form-horizontal" method="post" action="{{url('elast-update-post/' . $productOne[0]->elast_id )}}" enctype="multipart/form-data">
			                
							    <input name="_method" type="hidden" value="PUT">  <!--{!!  method_field('PUT') !!} --> <!-- Fix for PUT -->
                            
                                <input type="hidden" value="{{csrf_token()}}" name="_token" /><!-- csrf-->
                                <input type="hidden" value="{{ $productOne[0]->elast_id }}" name="hidden-prod-id" /> <!-- product ID as hidden. NOT NECESSARY HERE, as we pass id in action route -->

 
                                <!-- Post Titel, product name -->
                                <div class="form-group{{ $errors->has('product-name') ? ' has-error' : '' }}">
                                    <label for="product-name" class="col-md-4 control-label">Product name</label>

                                    <div class="col-md-6">
                                        <input id="product-name" type="text" class="form-control" name="product-name" value="{{old('product-name', $productOne[0]->elast_title)}}" required autofocus>
                                                                                       
                                        @if ($errors->has('product-name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('product-name') }}</strong>
                                        </span>
                                        @endif 
							        </div>
                                </div>	    
                           
						   
						   
						        <!-- Post Text, product description -->
                                <div class="form-group{{ $errors->has('product-desr') ? ' has-error' : '' }}">
                                    <label for="product-desr" class="col-md-4 control-label">Description</label>

                                    <div class="col-md-6">
                                        <textarea cols="5" rows="5" id="product-desr"  class="form-control" name="product-desr" required> {{old('product-desr', $productOne[0]->elast_text)}} </textarea>
                                                                                                                                    
                                        @if ($errors->has('product-desr'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('product-desr') }}</strong>
                                        </span>
                                        @endif 
							        </div>
                                </div>	 
							
							    <!-- If looking for full example with image, dropdown, checkbox, see example at =>views/polymorphic/ -->
							
							
							    <!-- Submit Button --> 
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary"> Edit </button>
                                    </div>
                                </div>

								
                                
                            </form>
						<!--------- End Form to a add new item   --------------->    
                        </div>
                    
					
					
					
					
					
					
					
					
					
					
					
					





		
					  
					
			
			
					</div>  <!-- end .admin-add-new-item -->
					<!--------- End  Here displays page: edit product, edit quantity. Shown via Tabs -->
	
                       
					
					
				
					
					
					
					
					
					
				
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					


                    					
				</div> <!-- end .shop -->
				    
					
			
					
                
            </div> <!-- end .panel-default xo -->
        </div>
    </div>
</div> <!-- end . animate-bottom -->

<!-- Include js/css file for this view only -->
 <script src="{{ asset('js/Polymorphic/product_tabs.js') }}"></script> <!--  JS for W3school Full Page Tabs (uses css + js) https://www.w3schools.com/howto/howto_js_full_page_tabs.asp  -->
 <script src="{{ asset('js/Polymorphic/preview_form_image.js') }}"></script> <!--  JS to view an uploaded form image -->

<!-- Include js/css file for this view only -->

@endsection