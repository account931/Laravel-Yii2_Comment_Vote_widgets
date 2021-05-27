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
                        Create XML YML <span class="small text-danger">*</span>
                    </h3> 
                </div>


                <div class="panel-body">
				    
					<p><a href="{{ route('createSQL') }}">
                        <button class="btn btn-large btn-success">Save & Output new XML from DB</button>
                    </a></p>
                    
                    <p><a href="{{ route('createSQL') }}">
                        <button class="btn btn-large btn-info">Save & Output new XML from Excel</button>
                    </a></p>
				    read Excel files with SimpleXLSX Lib
				
				    <!--  -->
					<div class="col-sm-12 col-xs-12"></br>
					   
					</div>
					<!--  -->



					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
