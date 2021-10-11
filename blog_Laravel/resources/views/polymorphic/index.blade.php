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
                        Polymorphic Relations + Gii Crud<span class="small text-danger">*</span>
                    </h3>
                    <p></p> 
                    <p></p>                  
                </div>


                <div class="panel-body">
				    
			
           
                
				
				
				
                
				    <!--------------- Polymorphic relation, display one post ------------------->
					<div class="col-sm-12 col-xs-12"></br>
					    <h3>Polymorphic</h3> 
						
                        <p>One To One (Polymorphic) A one-to-one polymorphic relation is similar to a typical one-to-one relation; however, the child model can belong to more than one type of model using a single association.</p>						
                        <p>Has 3 tables => {polymorphic_posts}, {polymorphic_users}, {polymorphic_images}. Single table of unique images {polymorphic_images} that is associated with posts and users.</p>
						<p> {{ $testMessage }} </p>
						
						<hr/>
						
						<h3>Display One Post Polymorphic</h3>
						<!-- Check class instance --> 
						@if ($postOne instanceof App\models\Polymorphic\Polymorphic_Posts) 
						   	<p> You requested Posts model </p>
						@endif
						
						@if ($postOne instanceof App\models\Polymorphic\Polymorphic_Users)
							<p> You requested Users model </p>
						@endif
						<!-- End Check class instance --> 

						
						<p> <b> Post name: </b>  {{ $postOne->post_name }} </p>
						<p> <b> Post text: </b>  {{ $postOne->post_text }} </p>
						
						
						<!-- User info, hasOne relation --> 
						@if( $postOne->authorName )  
						   	<p> <b> Author:  </b>  {{ $postOne->authorName->user_name }} </p>
						@else
							<p> <b> Sorry, no hasOne relation is set for this model. U requested  {{ get_class($postOne) }} </b> </p>	
						@endif
						<!-- End User info, hasOne --> 
						
						
						
						<!-- Image, Polymorphic relation --> 
						@if( $postOne->imageZ->exists())  
						   <p> {{ $postOne->imageZ->url }} </p>
					       <img class="img-responsive my-cph" src="{{URL::to("/")}}/{{ $postOne->imageZ->url }}"  alt="a"/>
	
						@else
							<p> Sorry, no polymorph image </p>
							
						@endif
						<!-- End Image, Polymorphic relation -->
					</div> 
                    <!------------ End Polymorphic ------------------->					






                    <!--------------- Polymorphic relation, display all posts ------------------->
                    <div class="col-sm-12 col-xs-12"></br>
					    <h3>Display All Posts Polymorphic</h3>
						
                            @foreach ($allPosts as $x) 
		                        <div>
                                    <p> Title:             {{ $x->post_name }} </p>
                                    <p> Text:              {{ $x->post_text }} </p>
                                    <p> Author:            {{ $x->authorName->user_name }} </p>	<!-- hasOne relation -->
                                    
									@if ($x->imageZ)  <!-- $x->imageZ->exists() DOES NOT WORK -->
										<p> Image(polymorph):  {{ $x->imageZ['url'] }} </p>	            <!-- Polymorphic relation -->									
									    <img style="width:16%;" class="small-img" src="{{URL::to("/")}}/{{ $x->imageZ['url'] }}"  alt="a"/>

										<p> Type is:           {{gettype($x->imageZ)}}
									@else
										No polymorph image is attached to this post record
									@endif
									
								<div><hr/>
	                        @endforeach						
                    
                    </div> 
                    <!------------ End Polymorphic relation, display all posts  ------------------->	





                     <!--------------- Gii CRUD ------------------->
					<div class="col-sm-12 col-xs-12"></br>
					    <h3>Gii CRUD</h3>  
                        
                    </div> 
                    <!------------ End Gii CRUD ------------------->	



					
                </div>
				
            </div>
        </div>
    </div>
</div>


<script>

</script>

@endsection
