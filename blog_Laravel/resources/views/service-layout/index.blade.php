@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-xs-12 col-md-12 "> 
            <div class="panel-heading"><h3>Service Layout </h3></div>
            <div> 
                Service Layer is a design pattern that will help you to abstract your logic. Actually, you delegate the application logic to a common service (the service layer) and have only one class to maintain.
            </div
            
			    <p><a href="{{ route('wpblog') }}"><button>Back to blogs</button></a></p>
				
				
				
				
				    <!------------------------------- FORM ----------------------------------->
					
					<div class="col-sm-12 col-xs-12">
					    
					    
						<!-- Display errors var 1 -->
				        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div><br />
                        @endif
						
						
			

						
						<!-- Flash message -->
						@if(session()->has('success'))
                            <div class="alert alert-success">
                           {{ session()->get('success') }}
                            </div>
                        @endif
						
                        
                        
					
					
					
					
					
					
					
                    </div>
            </div>
	</div>
</div>

@endsection
