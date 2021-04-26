@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-xs-12 col-md-12 "> 
            <div class="panel-heading"><h3>Service Layout </h3></div>
            <div> 
                <p>Service Layer is a design pattern that will help you to abstract your logic. Actually, you delegate the application logic to a common service (the service layer) and have only one class to maintain.</p>
                <p> <b> Controller -> Service Layout -> Repository -> Model </b></p>
            </div
            
			    <p><a href="{{ route('wpblog') }}"><button>Back to blogs</button></a></p>
				
									
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
						
                        
                        
					    <div class="col-sm-12 col-xs-12">
                            <h4 class="bg-info" style="padding:0.7em; border:1px solid black;">
                                <b>Getting users list via Repository and Service Layout</b> 
                            </h4>
                            <h5>See instruction at <b>402.8 Repository </b></h5>
                            @foreach ($users as $a)
					        <p class="list-group-item">
                                <i class="fa fa-motorcycle" style="font-size:24px"></i>
                                User  {{ $loop->iteration }} =>    <!-- {{ $loop->iteration }} is Blade equivalentof $i++ -->
                                Name: {{ $a->name }}
                            </p>
                            @endforeach
                            
                            
                            <hr/>
                            <h4 class="bg-info" style="padding:0.7em;border:1px solid black;">
                                <b>Getting one user (id:1) via Repository and Service Layout ($this->user->getUserById(1))</b> 
                            </h4>
                            <p class="list-group-item"><i class="fa fa-meh-o" style="font-size:24px"></i> {{$oneUser->name}}</p>
                            <p class="list-group-item"><i class="fa fa-meh-o" style="font-size:24px"></i> {{$oneUser->email}}</p>
                            <p class="list-group-item"><i class="fa fa-meh-o" style="font-size:24px"></i> {{$oneUser->id}}</p>
                        </div>
					
					
					
					
					
					
                    </div>
            </div>
	</div>
</div>

@endsection
