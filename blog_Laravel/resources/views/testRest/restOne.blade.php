<?php
//Rest Api Uses separated Rest Wpress model for table {wpress_blog_post} => /models/rest/WpressRest.php. (Model isstrictly for REST Api requests)  !!!!!!!!!
?>
@extends('layouts.app')


@section('page-script')   	
@stop
	
@section('content')

<!-- Include js file for this view only -->
<script src="{{ asset('js/test-rest/test-rest.js') }}"></script>
<!-- Include js file for this view only -->

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Test Rest API</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
					
					
					<!-- Just info, may delete later -->
				    <div class="col-sm-12 col-xs-12 alert alert-info small font-italic text-danger  shadowX">
					    </br> Some notes here.....
						</br> Here you can test REST API, via showOne article (/GET HTTP REQUEST), create (/POST HTTP REQUEST), update (/PUT HTTP REQUEST), delete (/DELETE HTTP REQUEST).
				        </br> 
					</div>
					
					
					
					<!---- DropDown select with article to choose to be fetched by ajax-->
					<div class="form-group">
					       </form>
                                   <select id="category_select" name="category_sel" class="mdb-select md-form">
						              <option  disabled="disabled"  selected="selected">Choose article</option>
		                              @foreach ($articles as $a)
									      <option value={{ $a->wpBlog_id }} >  {{ $loop->iteration }} => {{ $a->wpBlog_id}} {{ $a->truncateTextProcessor($a->wpBlog_text, 12)    }} </option>
					                  @endforeach
									  
									      <!-- Test for not-existing id -->
									      <option value="999999999" >  Test => Not-existing ID     </option>
						            </select>
									
									 
									 <button type="submit" id="showOne" class="btn btn-primary">Show</button>
									 <button type="button" id="createOne" class="btn btn-primary" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Create new</button>
									 <button type="button" id="updateOne" class="btn btn-success">Edit/Update</button>
								     <button type="button" id="deleteOne" class="btn btn-danger">Delete</button>
									 <button type="button" id="clear" class="btn btn-primary">Clear</button>

                             </form>	
                     </div>
					 <!---- DropDown seelect -->
					 
					 
					 
					 <!---- Rest Api response goes here, html()-ed by ajax -->
					 <div class="col-sm-12 col-xs-12" id="result">
					     <h3>Expect Rest API Response here... </h3> 
					 </div>
					 <!---- END Rest Api response goes here, html()-ed by ajax -->
					 
					 
					

					
					 
					 <!---- Hidden/collapsed Div with Form to create a new record(by Bootstrap) -->
					 <div class="collapse" id="collapseExample">
                        <div class="card card-body">
						    <hr>
						    <h4 style="padding-top:4em;"> Create a new article via Rest Api /POST HTTP REQUEST</h4> 
							  
							<!-- Form -->
						    <form class="form-horizontal" method="post" id="createNew">
			
                            <input type="hidden" value="{{csrf_token()}}" name="_token" /><!-- csrf-->
 
                            <!-- product name -->
                            <div class="form-group{{ $errors->has('product-name') ? ' has-error' : '' }}">
                                <label for="product-name" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <input id="product-name" type="text" class="form-control" name="product-name" value="{{ old('product-name') }}" required autofocus>
                                
                                    @if ($errors->has('product-name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('product-name') }}</strong>
                                    </span>
                                    @endif 
							     </div>
                            </div>	
                            
                            
                            <!-- article textarea description -->
                            <div class="form-group{{ $errors->has('product-desr') ? ' has-error' : '' }}">
                                <label for="product-desr" class="col-md-4 control-label">Text</label>

                                <div class="col-md-6">
                                    <textarea cols="5" rows="5" id="product-desr" class="form-control" name="product-desr"  required> {{ old('product-desr') }} </textarea>
                                
                                    @if ($errors->has('product-desr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('product-desr') }}</strong>
                                    </span>
                                    @endif 
							     </div>
                            </div>	 
							

							
                            <!-- article category Select dropdown  -->
                            <div class="form-group{{ $errors->has('product-category') ? ' has-error' : '' }}">
                                <label for="product-category" class="col-md-4 control-label">Category</label>

                                <div class="col-md-6">

                                    <select name="product-category" class="mdb-select md-form" id="categgg">
						              <option  disabled="disabled"  selected="selected">Choose category</option>
		                              @foreach ($categories as $b)
									      <option value={{ $b->wpCategory_id }} {{ old('product-category')!=null && old('product-category') == $b->wpCategory_id  ?  ' selected="selected"' : '' }} > {{ $b->wpCategory_name}} </option>
					                  @endforeach
						            </select>

									
                                    @if ($errors->has('product-category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('product-category') }}</strong>
                                    </span>
                                    @endif 
							     </div>
                            </div>	

                            			
							<!-- Create Button --> 
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="button" id="createArticle" class="btn btn-primary"> Create </button>
                                </div>
                            </div>

								
                                
                        </form>							
							
							<!-- End Form -->
							
                        </div>
                    </div>
					<!---- End Hidden/collapsed Div with Form to create a new record(by Bootstrap)
					
					
                    
					
					
					
					
					
					
					
					
					<!-----------------------  Edit/UPDATE Form  /PUT HTTP  --------------->
					<!---- Hidden Div with Form to edit/update a record(hidden by css, shown by JS click in '/js/test-rest.js') -->
					 <div class="" id="edit-update-div" style="display:none;">
                        <div class="card card-body">
						    <hr>
						    <h4 style="padding-top:4em;"> Edit/update an article via Rest Api /PUT HTTP REQUEST)</h4> 
							  
							<!-- Form -->
						    <form class="form-horizontal" id="upgardeArticle">
			
                            <input type="hidden" value="{{csrf_token()}}" name="_token" /><!-- csrf-->
							
							<input type="hidden" value="" id="articleID" /><!-- ArticleID-->
 
                            <!-- product name -->
                            <div class="form-group{{ $errors->has('product-name') ? ' has-error' : '' }}">
                                <label for="product-name" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <input id="productNameUpdate" type="text" class="form-control" name="product-name" value="{{ old('product-name') }}" required autofocus>
                                
                                    @if ($errors->has('product-name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('product-name') }}</strong>
                                    </span>
                                    @endif 
							     </div>
                            </div>	
                            
                            
                            <!-- article textarea description -->
                            <div class="form-group{{ $errors->has('product-desr') ? ' has-error' : '' }}">
                                <label for="product-desr" class="col-md-4 control-label">Text</label>

                                <div class="col-md-6">
                                    <textarea cols="5" rows="5" id="productDesrUpdate" class="form-control" name="product-desr"  required> {{ old('product-desr') }} </textarea>
                                
                                    @if ($errors->has('product-desr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('product-desr') }}</strong>
                                    </span>
                                    @endif 
							     </div>
                            </div>	 
							

							
                            <!-- article category Select dropdown  -->
                            <div class="form-group{{ $errors->has('product-category') ? ' has-error' : '' }}">
                                <label for="product-category" class="col-md-4 control-label">Category</label>

                                <div class="col-md-6">

                                    <select name="product-category" class="mdb-select md-form" id="productCategUpdate">
						              <option  disabled="disabled"  selected="selected">Choose category</option>
		                              @foreach ($categories as $b)
									      <option value={{ $b->wpCategory_id }} {{ old('product-category')!=null && old('product-category') == $b->wpCategory_id  ?  ' selected="selected"' : '' }} > {{ $b->wpCategory_name}} </option>
					                  @endforeach
						            </select>

									
                                    @if ($errors->has('product-category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('product-category') }}</strong>
                                    </span>
                                    @endif 
							     </div>
                            </div>	

                            			
							<!-- Update Button --> 
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="button" id="updateArticle" class="btn btn-primary"> Update </button>
                                </div>
                            </div>

								
                                
                        </form>							
							
							<!-- End Form -->
							
                        </div>
                    </div>
					<!---- End Hidden/collapsed Div with Form to create a new record(by Bootstrap)
					
					
					
					
					
					
					
					
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

