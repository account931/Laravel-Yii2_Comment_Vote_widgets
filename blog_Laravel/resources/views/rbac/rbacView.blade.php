@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
			
			
			    <!-- Flash message -->
				@if(session()->has('flashMessage'))
                    <div class="alert alert-danger">
                        {{ session()->get('flashMessage') }}
                    </div>
                @endif
						
						
						
                <div class="panel-heading text-warning">RBAC <span class="small text-danger">*</span> </div>

                  <div class="panel-body">
				    
					
				
				
				    <!--  -->
					<div class="col-sm-12 col-xs-12"></br>
					    <div>
						   <a href="{{ url('/createtwoRoles') }}"> Create 2 roles </a>
						</div></hr>
						
						@php
						$st = ($status == false) ? "panel-danger" : "panel-success" ;
						@endphp
						<div class="panel {{$st}}">
                            <div class="panel-heading">Your Rbac status =></div>
	                        <div class="panel-heading">{{$rbacStatus}}</div>
                        </div>
						
					</div>    
					
					
					 
					
					
					
					
					
					
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
