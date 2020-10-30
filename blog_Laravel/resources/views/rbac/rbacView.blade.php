@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
                        <li>{{ $error }}</li>
                      @endforeach
                      </ul>
                    </div>
                @endif
                <!-- End Display form validation errors var 2 -->				
					
					
                <div class="panel-heading text-warning">RBAC <span class="small text-danger">*</span> </div>

                  <div class="panel-body">
				    
					
				
				    <!--  -->
					<div class="col-sm-12 col-xs-12"></br>
					    <div>
						   <a href="{{ url('/createtwoRoles') }}" title="to create roles manually, must be run by admin one time only"> Create 2 roles manually (test) </a>
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
                                       <th>Assign </th>
                                    </tr>
                                </thead>
								
                                <tbody>
								@foreach ($allUsers as $a)
								
                                    <tr>
									    <!-- User name, from table users -->
                                        <td>{{  $a->name }}</td>  
                                       
										<!-- Displays List of user's rbac roles. Uses Helper method displayUserRoles($a)  --> 
										<td class="user-roles-list"> {!! \App\Http\MyHelpers\Rbac\Helper_Rbac::displayUserRoles($a) !!}</td> <!-- all current loop user's roles. Displays content without escaping -->
                                        
										@php
										  //getting descriptions of roles current loop user has. Can be carved to Helper method
										  if (isset($a->roles[0]['name'])) { //if $user->roles (it is hasMany relation) found any role by user
											  $descr = "";
											  //use for() loop in case user has 2 and more roles. If user could have only 1 role, we would just use {$a->roles[0]['name']}
											  for($j =0; $j < count($a->roles); $j++){
												  $descr.= "<i class='fa fa-check-circle-o'></i><span class='text-warning small'> " . $a->roles[$j]['description'] . "</span></br>"; 
											  }  
										  } else { 
										   $descr = 'no descr';} 
										  @endphp 
										  
										<!-- descriptions of roles current loop user has. Displays content without escaping -->
										<td> {!! $descr !!} </td> 
										
								
										
										<!-- Form with Roles dropdown select. Displays content without html escaping -->
										<td>
										    <form method="post" action="{{url('/assignRole')}}">
				
                                              <div class="form-group">
                                                <input type="hidden" value="{{csrf_token()}}" name="_token" />
												<input type="hidden" value="{{$a->id}}" name="user_id" />
                                                  <select name="role_sel">
												    <option selected disabled>select</option>
													@foreach ($allRoles as $c)
													  <option value="{{ $c['attributes']['id']}}"> {{ $c->name }}</option>
													@endforeach
                                                    </select>
                                              </div>
								              <button type="submit" class="sbmBtn" >assign role</button>
                                            </form>
										</td>
   
   
  
  
  
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
