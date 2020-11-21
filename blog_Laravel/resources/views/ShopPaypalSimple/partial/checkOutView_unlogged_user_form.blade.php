<!------------ For for unlogged user (in checkout view) --------->
<!-- It is display:none by default, hidden by Bootstrap class .collapse, in order to appear a user should click "Proceed with <button class="btn"><a href="#">one-click buy </a></button>) -->

<!-- Form with user's details, i.e address, cell, etc -->
	  <div class="col-sm-12 col-xs-12 shadowX collapse" id="unloggedUserForm"> <!-- hidden by Bootstrap class .collapse -->
	  <h4> Your Order ID is <b> {{$uuid}} </b> </h4>
	     <h2> Shipping details </h2>
	      <form class="form-horizontal" method="post" class="form-assign" action="{{url('/payPage1')}}">
		      <input type="hidden" value="{{csrf_token()}}" name="_token"/>
			  
			  <!-- Name --> 
               <div class="form-group{{ $errors->has('u_name') ? ' has-error' : '' }}">
                   <label for="u_name" class="col-md-4 control-label">Name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="u_name" value="{{ old('u_name')  }}" placeholder="Your name" required /> 
                        @if ($errors->has('u_name'))
                            <span class="help-block"> <strong>{{ $errors->first('u_name') }}</strong> </span>
                        @endif 
					</div>
               </div>			
              
			    <!-- Email --> 
               <div class="form-group{{ $errors->has('u_email') ? ' has-error' : '' }}">
                   <label for="u_email" class="col-md-4 control-label">E-mail</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="u_email" value="{{ old('u_email')  }}" placeholder="Your email" required />       
                        @if ($errors->has('u_email'))
                            <span class="help-block"> <strong>{{ $errors->first('u_email') }}</strong> </span>
                        @endif 
					</div>
               </div>
			   
			   
			   <!-- Address --> 
               <div class="form-group{{ $errors->has('u_address') ? ' has-error' : '' }}">
                   <label for="u_address" class="col-md-4 control-label">Address</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="u_address" value="{{ old('u_address') }}" placeholder="Your address" required />       
                        @if ($errors->has('u_address'))
                            <span class="help-block"> <strong>{{ $errors->first('u_address') }}</strong> </span>
                        @endif 
					</div>
               </div>
			   
			   <!-- u_phone --> 
               <div class="form-group{{ $errors->has('u_phone') ? ' has-error' : '' }}">
                   <label for="u_phone" class="col-md-4 control-label">Phone</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="u_phone" value="{{ old('u_phone') }}" placeholder="Your phone" required />       
                        @if ($errors->has('u_phone'))
                            <span class="help-block"> <strong>{{ $errors->first('u_phone') }}</strong> </span>
                        @endif 
					</div>
               </div>
			   
         
		        <input type="hidden" name="u_uuid" value="{{ $uuid }}"  /> <!-- UUID-->
				
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                         <button type="submit" class="btn btn-primary shadowX submitX rounded"> Done </button>
			        </div>
				</div>
		      

		  </form><hr>
	  </div>
	  <!-- End Form with user's details, i.e address, cell, etc -->
	  
	  
	  
<!-------- END For for unlogged user (in checkout view)   --------->
		