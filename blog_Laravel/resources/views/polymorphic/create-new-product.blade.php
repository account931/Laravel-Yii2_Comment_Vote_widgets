<?php
//Admin page to create a new product
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
							 Create new  <span class="small text-danger">*</span> 
							 <br>  
						</p>
				        
						&nbsp;<i class="fa fa-arrow-circle-o-left" style="font-size:24px"></i>&nbsp;       <a href="{{ url('/polymorphic') }}">back to View all Polymorphic posts </a><br>
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
                        <h1>Create new item</h1>
		            </div>	
				
				  
		
		            
					
					
					
					
					
					
					<!-- Here displays page: edit product, edit quantity. Shown via W3school Tabs -->
				    <div class="col-sm-12 col-xs-12 admin-add-new-item">
					
					
					
					    <!-- Start W3school Full Page Tabs (uses css + js file + js <button onclick="openPage()") https://www.w3schools.com/howto/howto_js_full_page_tabs.asp  -->
					    <button class="tablink" onclick="openPage('Home', this, '#d4d4f7')" id="defaultOpen">Create new</button>
                        <button class="tablink" onclick="openPage('EditQuantity', this, '#eaeafb')">Load Stock</button>
                        <button class="tablink" onclick="openPage('About', this, 'orange')">Info</button>


                        <!--------  1st tab div (with edit product form) --------------> 
                        <div id="Home" class="tabcontent">
						
                            <!--------- Form to a add new item   --------------->
				            <form class="form-horizontal" method="post" action="{{url('create-new-polym-post')}}" enctype="multipart/form-data">
			                
							<!--<input name="_method" type="hidden" value="PUT">-->  <!--{!!  method_field('PUT') !!} --> <!-- Fix for PUT -->
                            
                            <input type="hidden" value="{{csrf_token()}}" name="_token" /><!-- csrf-->

 
                            <!-- Post Titel, product name -->
                            <div class="form-group{{ $errors->has('product-name') ? ' has-error' : '' }}">
                                <label for="product-name" class="col-md-4 control-label">Product name</label>

                                <div class="col-md-6">
                                    <input id="product-name" type="text" class="form-control" name="product-name" value="{{old('product-name')}}" required autofocus>
                                                                                       
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
                                    <textarea cols="5" rows="5" id="product-desr"  class="form-control" name="product-desr" required> {{old('product-desr')}} </textarea>
                                                                                                                                    
                                    @if ($errors->has('product-desr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('product-desr') }}</strong>
                                    </span>
                                    @endif 
							     </div>
                            </div>	 
							
							
							<!-- product price -->
							<!--
                            <div class="form-group{{ $errors->has('product-price') ? ' has-error' : '' }}">
                                <label for="product-price" class="col-md-4 control-label">Price</label>

                                <div class="col-md-6">
                                    <input id="product-price" type="number" step="0.01" class="form-control" name="product-price" value="{{ old('product-price') }}" required>
                                
                                    @if ($errors->has('product-price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('product-price') }}</strong>
                                    </span>
                                    @endif 
							     </div>
                            </div>	--> 
							
							
							
							<!-- Author Select dropdown  -->
                            <div class="form-group{{ $errors->has('article-author') ? ' has-error' : '' }}">
                                <label for="article-author" class="col-md-4 control-label">Author</label>

                                <div class="col-md-6">

                                    <select name="article-author" class="mdb-select md-form">
						                <option  disabled="disabled"  selected="selected">Choose author</option>
		                              
									    @foreach ($authorsAll as $a) <!-- hasOne Relat -->
										    @if(old('article-author') == $a->id ) <!-- to keep old input if validation fails -->
                                                <option value="{{ $a->id }}" selected>{{ $a->user_name }}</option>
                                            @else
                                                <option value={{ $a->id }} > {{ $a->user_name}} </option> <!-- if no old input -->
                                            @endif
					                    @endforeach 
						            </select>

									
                                    @if ($errors->has('article-author'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('article-author') }}</strong>
                                    </span>
                                    @endif 
							     </div>
                            </div>	
							
							
					
							<!-- Checkbox "Do not update image" --> 
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="larger"  name="remember" {{ old('remember') ? 'checked' : '' }}> <span class="ch-text">Create post without image/Image is not required </span>
                                    </label><p></p>
                                </div>
                            </div>

							
							
							
							<!----- Image  ------->
					        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <label for="image" class="col-md-4 control-label">Image <span class='small font-italic text-danger'> (must be .jpeg, .png, .jpg, .gif, .svg file. Max 2048)</span></label>

                                <div class="col-md-6">

                                    <input type="file" name="image" class="form-control my-img-input-x">

                                    @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif 
							     </div>
                            </div>	
							
				
				
				
				            <!----- Display an image of edited post (if any was prev loaded) + new uploaded img will appear in this div ---->
							<div class="col-md-6" id="imagePreview">
				                
		                    </div>
							<!----- Display an image of edited post (if any was prev loaded) ---->

							


							
							
							<!-- Submit Button --> 
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary"> Create </button>
                                </div>
                            </div>

								
                                
                            </form>
						<!--------- End Form to a add new item   --------------->    
                        </div>
                        <!------------------ End 1st tab div (with edit product form) -------------->
                    
					
					
					
					
					
					
					
					
					
					
					
					
					     <!-------------------- 2nd tab div (with edit quantity form) ---------------------------------->
                        <div id="EditQuantity" class="tabcontent">
					        <h3>Info 2</h3>
							<p> Here you can create a new post with connected polymorphic relation image.</p>
							<p> <i class='fa fa-flask' style='font-size:39px'></i></p>
					     </div>
						<!-------- End 3rd tab div ------->
  
  
  
  
  
  
  
                        <!-------- 3rd tab div ------->
                        <div id="About" class="tabcontent">
                            <h3>Info</h3>
                            <p>Here you can create a new post with connected polymorphic relation image.</p>
                        </div>
						<!-------- End 3rd tab div ------->
						
						
						

                        <!-- End W3school Full Page Tabs https://www.w3schools.com/howto/howto_js_full_page_tabs.asp  -->






		
					  
					
			
			
					</div>  <!-- end .admin-add-new-item -->
					<!--------- End  Here displays page: edit product, edit quantity. Shown via Tabs -->
	
                       
					
					
				
					
					
					
					
					
					
				
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					


                    					
				</div> <!-- end .shop -->
				    
					
			
					
                
            </div> <!-- end .panel-default xo -->
        </div>
    </div>
</div> <!-- end . animate-bottom -->

<!-- Include js/css file for this view only -->
 <script src="{{ asset('js/Polymorphic/product_tabs.js') }}">     </script> <!--  JS for W3school Full Page Tabs (uses css + js) https://www.w3schools.com/howto/howto_js_full_page_tabs.asp  -->
 <script src="{{ asset('js/Polymorphic/preview_form_image.js') }}"></script> <!--  JS to view an uploaded form image -->

<!-- Include js/css file for this view only -->

@endsection