@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
			
			
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
                            <li> {{ $error }} </li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                <!-- End Display form validation errors var 2 -->		
                
						
						
						
                <div class="panel-heading text-warning">
                    <h3>
                        <i class="fa fa-recycle" style="font-size:36px"></i>  
                        Elastic Search on DB Table {elastic_search}<span class="small text-danger">*</span>
						<p style="border:1px solid black; padding:0.5em;">
						    <b> 
						    So far, works only simple SQL Search + ElasticSearch on Cloud, Elastic search on localhost does not work as failed to install Elastic server 9200 (via zip, msi, as Java not compatible (version conflict).)
						   </b>
						</p>
                    </h3>
                    <p><a href="{{ route('elastic-indexing') }}"><button class="btn btn-success"> Make Elastic indexing. Index the whole table(elastic_search), if index exists, it got updated &nbsp;&nbsp; <i class="fa fa-refresh" style="font-size:26px"></i></button></a></p> 
                    <p><a href="{{ route('elast-show-engines') }}"><button class="btn btn-info"> Show my Elastic Cloud engines</button></a></p> 

					<p></p>                  
                </div>


                <div class="panel-body">
				    
			
           
                
				
				
				
                
				    <!--------------- Simple Search form (just to compare )------------------->
					<div class="col-sm-6 col-xs-12 {{ (isset($_GET['simpleSearch'])) ? 'bg-danger':''}}"></br>
					    <h4>Simple Search on table {elastic_search}</h4> 
						<form class="form-horizontal" method="get" action="{{url('elastic')}}">
						    <input type="text" placeholder="Search.." name="simpleSearch">
                            <button type="submit">Submit</button>
						</form>
						<p></p>
                        
					</div> 
                    <!------------ End Simple Search form (just to compare ) ------------------->




                    <!--------------- Elastic Search form ------------------->
					<div class="col-sm-6 col-xs-12 {{ (isset($_GET['elastic-search'])) ? 'bg-danger':''}}"></br>    
					    <h4>Elastic Search on table{elastic_search} <i class="fa fa-search-plus" style="font-size:26px"></i></h4> 
						<form class="form-horizontal" method="get" action="{{url('elastic')}}">
						    <input type="text" placeholder="See SQL table what to search, e.g Evelyn Lebsack" name="elastic-search">
                            <button type="submit">Elastic Search(OK) <i class="fa fa-search-plus" style="font-size:16px"></i></button>
						</form>
						<p style="font-size:0.6em;">Before search DB must be indexed at least once</p>
                        <p></p>
					</div> 
                    <!------------ End Elastic Search form -------------------> 					



                   
                    <!--------------- Simple Search Results ----------------------->
					<div class="col-sm-12 col-xs-12">
					    <hr> <i class="fa fa-retweet" style="font-size:36px"></i> <hr>

						
						@if(empty($results))
							<br>
                            <p>Data does not exist (you did not search anything)</p>
                        @else
							<br>
                            <p>Your data is here! Benchmark: it took <b> {{$benchmarkTime}} microseconds </b> to get result</p>
						
						    <!-- Check if No result was found -->
						    @if(count($results) == 0)
								<div class="col-sm-12 col-xs-12 list-group-item alert alert-danger"> No search results found <div>
							@endif
							
                            <p> Found {{count($results)}} results </p>
							
						    @foreach($results as $v)
							    <div class="col-sm-12 col-xs-12 list-group-item alert alert-success">
						            <p class='list-group-item'>{{ $v->elast_title }} </p>
								    <p class='list-group-item'>{{ $v->elast_text }}  </p>
								    <p class='list-group-item alert alert-danger'> Link (N/A)</p>
							    </div>
						    @endforeach

                        @endif
						
						
					</div>
					<!--------------- End Simple Search Results ------------------->
					
					
					
					
					
					
					
					
					<!--------------- Elastic Search Results ----------------------->
					<div class="col-sm-12 col-xs-12">
					    <hr> <i class="fa fa-retweet" style="font-size:36px"></i> <hr>

						<!-- If NO Elastic results come at all -->
						@if(empty($elasticResults))
							<br>
                            <p>Elastic Data does not exist (you did not search anything)</p>
						
                        <!----  If any Elastic results come ----->						
                        @else
							
						
							
							
							<!-- If Elastic results contains no Error, show the results -->
							@if(empty($elasticResults->error))
								
							    <p>Your Elastic data is here! You searched for <b><i> {{ $_GET['elastic-search']}} </i></b>. Found <b> {{count($elasticResults->results)}} result </b>. Benchmark: it took <b> {{$benchmarkTime}} microseconds </b> to get result</p>
							    <br>
							
							    @if(count($elasticResults->results) <= 0)
								   <h3> Nothing found </h3>
							    @endif
							
							
							    <p> Request ID:<b> {{ $elasticResults->meta->request_id }} </b></p> <!-- Elastic request ID (generated by Elastic -->  <!-- For single post(without loop) was =>  $elasticResults->meta->request_id -->
                            
							
							    @foreach($elasticResults->results as $res) <!-- $results ia an array -->
							    <!-- Display the data, to see what path/structure to use, decomment dd($elasticResults) in Controer -->
                                <div class="col-sm-12 col-xs-12 list-group-item alert alert-success">
						            <p class="list-group-item"> Engine name:        <b> {{ $res->_meta->engine}}    </b></p>  <!-- What Elastic engine was used (created by you)-->     <!-- For single post(without loop) was =>  $elasticResults->results[0]->_meta->engine -->							   
							        <p class="list-group-item">Doc found:           <b> {{ $res->id->raw }}         </b></p> <!-- Elastic Document ID , i.e doc-619cc (generated by Elastic while indexing) --> <!-- For single post(without loop) was => $elasticResults->results[0]->id->raw -->
							        <p class="list-group-item"> SQL ID(for link):   <b> {{ $res->id->raw }}    </b></p> <!--SQL table column id to make a href -->                  <!-- For single post(without loop) was => $elasticResults->results[0]->shop_id->raw} -->	
							        <p class="list-group-item"> <a href="{{route('elas-one-product', ['id' => $res->id->raw])}}">View One</a> </p> <!-- Link to view this one result -->
								    <p class="list-group-item"> Product:            <b> {{ $res->elast_title->raw }} </b></p> <!--SQL table column shop_title  -->                        <!-- For single post(without loop) was => $elasticResults->results[0]->shop_title->raw} -->
							 
						        <?php //var_dump($elasticResults); ?> 
								</div>
							    @endforeach
							@endif
							
							<!-- If Elastic results contains ERROR. show the error -->
							@if(!empty($elasticResults->error))
								<h4 class="alert alert-danger"> 
							        <i class="fa fa-exclamation-triangle" style="font-size:38px;color:red"></i>
							        Elastic Search Api Error:  <b>{{ $elasticResults->error }} </b> 
								</h4>
							@endif
	
							
                        @endif
						
						
						
					</div>
					<!--------------- End Elastic Search Results  ------------------->
                    
                  
				  
				  
				  
				  
				  
				  
                    
					
					
					
                    <!--------------- Gii CRUD Panel fot table {elastic_search} (to trigger and test Observer indexing new entry on save/edeit/delete)------------------->
					<div class="col-sm-12 col-xs-12">
					    <hr><hr><hr><hr><hr><hr>
					    <h4 class="alert alert-success">Gii CRUD Panel for table {elastic_search} (to trigger and test Observer indexing new entry on save/edeit/delete)<i class="fa fa-search-plus" style="font-size:26px"></i></h4> 
				        <p class="alert alert-success"> Observer malworks, so reindexing is done via model method </p>
						<!-- Button "Create new" -->
                        <button class="btn btn-info">
						    <a href="#"> <!--<a href = 'gii-create-new-post'> --> 
							<span class="link-text" onclick="return confirm('Are you sure to create new?')">Create new/POST(N/A)  </span></a> <!--<img class="deletee"  src="{{URL::to("/")}}/images/edit.png"  alt="edit"/> --> 
						</button> 
						
						
						<div class="col-sm-12 col-xs-12  list-group-item shadowX head-name">
							
						<div class="col-sm-2 col-xs-12"> <!-- hidden-xs -->
							Post id
					    </div>
							
						<div class="col-sm-2 col-xs-12">
							Post name
					    </div>
							
					    <div class="col-sm-2 col-xs-12">
							Post title
						</div>
							
						<div class="col-sm-2 col-xs-12">
							Author
						</div>
						
								
						<div class="col-sm-2 col-xs-12">
							Buttons
					    </div>
									
					</div>
							
                            
							
				
					<!-- display all posts for Gii table -->		
				    @foreach ($allTableResults as $x)
					    <div class="col-sm-12 col-xs-12 list-group-item bg-success cursorX shadowX crud-div"> <!-- class="row gii-content" -->
                            
							<div class="col-sm-2 col-xs-12">
							    {{ $x->elast_id }}
							</div>
                                    
                            <div class="col-sm-2 col-xs-12">
							    {{ $x->elast_title }}
							</div>

                            <div class="col-sm-2 col-xs-12">
							    {{ substr($x->elast_text, 0, 12) }}
							</div>
                                    
                            <div class="col-sm-2 col-xs-12">
							    {{ $x->elast_created_at}}
							</div>

                         
									
							<div class="col-sm-2 col-xs-12">
							    <p class="hidden-sm"></p> <!-- hidden in desktop-->
							    <button class="btn btn-info">
								    <a href = 'elast-gii-edit-post/{{ $x->elast_id  }}'>  
								        <span class="link-text" onclick="return confirm('Are you sure to edit?')">Edit via /PUT  </span></a> <!--<img class="deletee"  src="{{URL::to("/")}}/images/edit.png"  alt="edit"/> --> 
								</button>  
								
								<button class="btn btn-danger" onclick="return confirm('Are you sure to delete post {{$x->id}}  ?')"> Delete (N/A) </button>
							</div>
						</div>	
					@endforeach	
					
					</div>
					{{ $allTableResults->links() }} <!-- Pagination links -->
					<!--------------- END Gii CRUD Panel fot table {elastic_search} (to trigger and test Observer indexing new entry on save/edeit/delete)----------------------->








                </div>
				
            </div>
        </div>
    </div>
</div>


<script>

</script>

@endsection
