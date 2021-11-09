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
                    </h3>
                    <p><button class="btn btn-success"> Make indexing table</button></p> 
                    <p></p>                  
                </div>


                <div class="panel-body">
				    
			
           
                
				
				
				
                
				    <!--------------- Elastic Search form ------------------->
					<div class="col-sm-12 col-xs-12"></br>
					    <h3>Elastic Search</h3> 
						<form class="form-horizontal" method="get" action="{{url('elastic')}}">
						    <input type="text" placeholder="Search.." name="search">
                            <button type="submit">Submit</button>
						</form>
                        
					</div> 
                    <!------------ End Elastic  ------------------->					


                   
                    <!--------------- Elastic Search Results ----------------------->
					<div class="col-sm-12 col-xs-12">
					    
						
						@if(empty($results))
							<br>
                            <p>Data does not exist (you did not search anything)</p>
                        @else
							<br>
                            <p>Your data is here!</p>
						
						    <!-- Check if No result was found -->
						    @if(count($results) == 0)
								<div class="col-sm-12 col-xs-12 list-group-item alert alert-danger"> No search results found <div>
							@endif
							
                            <p> Found {{count($results)}} results </p>
							
						    @foreach($results as $v)
							    <div class="col-sm-12 col-xs-12 list-group-item alert alert-success">
						            <p class='list-group-item'>{{ $v->elast_title }} </p>
								    <p class='list-group-item'>{{ $v->elast_text }}  </p>
								    <p class='list-group-item alert alert-danger'> Link</p>
							    </div>
						    @endforeach

                        @endif
						
						
					</div>
					<!--------------- End Elastic Search Results ------------------->
                    
                  

					
                </div>
				
            </div>
        </div>
    </div>
</div>


<script>

</script>

@endsection
