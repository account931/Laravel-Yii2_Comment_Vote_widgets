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
						</div><hr>
						
						@php
						//decide what bootstrap class to use. $status, $rbacStatus are passed from Controller
						$st = ($status == false) ? "panel-danger" : "panel-success" ;
						@endphp
						<div>Check via Controller</div>
						<div class="panel {{$st}}">
                            <div class="panel-heading"><i class="fa fa-exclamation" style="font-size:24px"></i>
							    &nbsp; Your Rbac status:
							</div>
	                        <div class="panel-heading">{{$rbacStatus}}</div>
                        </div>
						<hr>
						
						<!----- Blade Rbac check Var 1 ------>
						<div>Check in Blade</div>
						@if(\Auth::user()->hasRole('admin'))
							<div class="panel panel-success">
                               <div class="panel-body"><i class="fa fa-check-square-o" style="font-size:24px"></i> Your status  :</div>
                               <div class="panel-heading">You have rights!!!</div>
                            </div>
							
						@else
							<div class="panel panel-danger">
                               <div class="panel-body"><i class="fa fa-close" style="font-size:24px;color:red"></i> Your status  :</div>
                               <div class="panel-heading">You have no rights</div>
                            </div>
						@endif
						<!----- End Blade Rbac check Var 1 ------>
						
						
						
						
						<!----- Blade Rbac check Var 2, $userX is passed from Controller ------>
						@if ($userX->hasRole('admin'))
                           <div class="bg-success">You have Admin Rights</div>
                        @endif
						<!----- Blade Rbac check Var 2 ------>
						
					</div>    
					
					
					 
					
					
					
					
					
					
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
