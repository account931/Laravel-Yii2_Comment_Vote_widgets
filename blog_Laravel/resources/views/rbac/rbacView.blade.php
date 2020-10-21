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
						   <a href="{{ url('/createtwoRoles') }}" title="to create roles manually, must be run by admin one time only"> Create 2 roles </a>
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
					       {{$userX->roles[0]['name']}}
                        @endif
						<!----- Blade Rbac check Var 2 ------>
						
					</div><hr>    
					
					
					 
					<!-- Table with Users for RBAC Admin Control Panel-->
					<div class="col-sm-12 col-xs-12">
					    <center><h3>RBAC Admin Control Panel</h3></center>
						@if(!\Auth::user()->hasRole('admin'))
							<p class="bg-danger"> Sorry, you can not see the Control panel</p>
						
						@else
							<table class="table table-hover table-striped">
                                <thead>
                                   <tr>
                                       <th>User</th>
                                       <th>Role</th>
									   <th>Descr</th>
                                       <th>Task </th>
                                    </tr>
                                </thead>
								
                                <tbody>
								@foreach ($allUsers as $a)
								
                                    <tr>
                                        <td>{{  $a->name }}</td>  <!-- User name, from table users -->
                                        
										
										  @php
										  if (isset($a->roles[0]['name'])) { $r = "<span class='text-danger'>" .$a->roles[0]['name'] . "</span>"; } else { $r = 'no role';} 
										  @endphp 
										<td> {!! $r !!}</td>
                                        <td>some text</td>
										<td>some form</td>
                                    </tr>
                                 @endforeach
                                </tbody>
                            </table>
						@endif
					</div>
					<!-- End Table with Users for RBAC Admin Control Panel-->

					
					
					
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
