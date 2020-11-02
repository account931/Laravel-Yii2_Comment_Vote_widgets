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
							
						 
	                        <!-- START c to add new RBAC role to auth_items-->
                            <hr>
					        <div class="col-sm-12 col-xs-12 ">
	   
	                          <button data-toggle="collapse" data-target="#rbacAdd">Add a new RBAC role to auth_items</button><p></p>
	                          
							  <div id="rbacAdd" class="collapse"><br> <!--collapsed content goes here -->
	   
	                            <!----------------- Right Block. All roles list------------->
                                <div class="col-sm-4 col-xs-12 ">
                                  <p>Currently existing roles</p>
							      @foreach($allRoles as $rr)
							        <p> {{ $loop->iteration }} <i class='fa fa-check-circle-o'></i> {{ $rr->name }} </p>
							      @endforeach
							    </div>
								<!----------------- End Right Block. All roles list------------->
							
							
							
							    <!----------------- FORM to add RBAC role to table {roles, auth_items(Yii2)} Left Block------------->
							    <div class="col-sm-8 col-xs-12">
							      
								  <form class="form-horizontal" method="POST" action="{{ route('/addNewRole') }}">
                                  {{ csrf_field() }}

                                  <!---- Role name field -->
                                  <div class="form-group{{ $errors->has('rname') ? ' has-error' : '' }}">
                                    <label for="rname" class="col-md-4 control-label">Role name</label>
                                    <div class="col-md-6">
                                      <input id="rname" type="text" class="form-control" name="rname" value="{{ old('rname') }}" required autofocus>
                                
                                      @if ($errors->has('rname'))
                                        <span class="help-block">
                                          <strong>{{ $errors->first('rname') }}</strong>
                                        </span>
                                      @endif 
							        </div>
                                  </div>
                                  <!---- End Role name field -->
								  
								 
								  <!---- Role description field -->
                                  <div class="form-group{{ $errors->has('rDescr') ? ' has-error' : '' }}">
                                    <label for="rDescr" class="col-md-4 control-label">Descr</label>
                                    <div class="col-md-6">
                                      <input id="rDescr" type="text" class="form-control" name="rDescr" value="{{ old('rDescr') }}" required>
                                
                                      @if ($errors->has('rDescr'))
                                        <span class="help-block">
                                          <strong>{{ $errors->first('rDescr') }}</strong>
                                        </span>
                                      @endif 
							        </div>
                                  </div>
                                  <!---- End Role Role description field -->
								
								  
								  <!---- Form submit button -->
                                  <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                      <button type="submit" class="btn btn-primary">Add</button>								
								    </div>
                                  </div>
								  <!---- Form submit button -->
								  
							    </div>
							    <!----------------- END FORM to add RBAC role to table {auth_items} ---------------------->
	                        
		                      </div><hr>
						    </div>
						    
						    <!--- End  of Collapsed Block, SECTION to add new RBAC role to auth_items -->
						
						
						    <div class="col-sm-12 col-xs-12 bg-success" style="height:1em;"> </div><hr> <!-- just empty div for UI/IX -->
							<div class="col-sm-12 col-xs-12 " style="height:1em;"> </div><hr> <!-- just empty div for UI/IX -->
						 
						 
						 
		                    <!---------------- RBAC Table with Users for RBAC Admin Control Panel -------------------->
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
										<td class="user-roles-list"> {!! \App\Http\MyHelpers\Rbac\Helper_Rbac::displayUserRoles($a, true) !!}</td> <!-- all current loop user's roles. Displays content without escaping -->
                                        
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
								              <button type="submit" class="sbmBtn" data-uName="{{$a->name}}">assign role</button> <!-- data-uName to e used in JS swal -->
                                            </form>
										</td>
  
  
									</tr>
                                @endforeach
                                </tbody>
                            </table>
						@endif
					</div>
					<!-- End RBAC Table with Users for RBAC Admin Control Panel -->

					
					
					
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
