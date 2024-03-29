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
						<p>Db table <b> {polymorphic_images} </b> contains images either for table <b> {polymorphic_posts} </b> or <b> {polymorphic_users }</b>. Table <b>{polymorphic_images}</b> has a column that contains model belonging to image</p>
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
						
						
						<h3 class="underlined">Display One Post (Polymorphic rel)</h3>
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
						@if( $postOne->imageZ->exists())  <!-- If this Post record has image connected via Polymorphic relation --> 
						   
						    @if(file_exists(public_path(  $postOne->imageZ['url'] ))) <!-- check if file is physically available in folder(e.g was in folder but was accidentally deleted) --> 

						        <p> {{ $postOne->imageZ->url }} </p>                                                             <!-- Polymorphic relation, just display the path -->
					            <img class="img-responsive my-cph" src="{{URL::to("/")}}/{{ $postOne->imageZ->url }}"  alt="a"/> <!-- Polymorphic relation -->
	                        
							@else <!-- if Post has image connected via Polymorphic relation but physically IS NOT available in folder --> 
								<p> 
								    <i class="fa fa-exclamation-circle" style="font-size:20px;color:red"></i>
									Image corrupted 
								</p>
									
							@endif		
									
						@else
							<p> Sorry, no polymorph image </p>
							
						@endif
						<!-- End Image, Polymorphic relation -->
					</div> 
                    <!------------ End Polymorphic ------------------->					



                    
					
				



                    <!--------------- Polymorphic relation, display all posts ------------------->
                    <div class="col-sm-12 col-xs-12"></br>
					    <h3 class="underlined">Display All Polymorphic Posts (Polymorphic rel)</h3>
						<?php $i = 0; ?>
						
                            @foreach ($allPosts as $x)
                                <?php $i++; ?>							
		                        <div class="col-sm-5 col-xs-12 shadowX posts-grid">
                                    <p>                   Title:             {{ $x->post_name }}             </p>
                                    <p>                   Text:              {{ $x->post_text }}             </p>
                                    <p>                   Author:            {{ $x->authorName->user_name }} </p>	<!-- hasOne relation -->
                                    <p class="timestamp"> Created:           {{ $x->created_at }}             </p>
									<p class="timestamp"> Updated:           {{ $x->updated_at ? $x->updated_at : "never updated" }} </p>
									
									@if ($x->imageZ)  <!-- If this Post record has image connected via Polymorphic relation --> <!-- $x->imageZ->exists() DOES NOT WORK -->
									
									    @if(file_exists(public_path(  $x->imageZ['url'] ))) <!-- check if file is physically available in folder(e.g was in folder but was not accidentally deleted) --> 
											
										    <p> Image(polymorph):  {{ $x->imageZ['url'] }} </p>	                              <!-- Polymorphic relation -->									
									        <img  class="small-img" src="{{URL::to("/")}}/{{ $x->imageZ['url'] }}"  alt="a"/> <!-- Polymorphic relation -->

										    <p> Type is:           {{gettype($x->imageZ)}}
											
										@else <!-- if Post has image connected via Polymorphic relation but physically IS NOT available in folder --> 
										    <p class="timestamp"> 
											    <i class="fa fa-exclamation-circle" style="font-size:20px;color:red"></i>
											    Seems like polymorph image is corrupted/missing in folder 
											</p>
										@endif
										
									@else <!-- If Post has no image connected via Polymorphic relation -->
										<p>No polymorph image is attached to this post record</p>
									    <img class="small-img" src="{{URL::to("/")}}/images/no-image-found.png"  alt="a"/>
										<p> Type is:  No type </p>
									@endif
									
								</div>
								<!-- add a horizontal row after 2 posts -->
								<?php if($i%2 == 0){ echo "<div class='col-sm-12 col-xs-12'>v</div><hr/>"; } ?>	
	                        @endforeach						
                    
                    </div> 
                    <!------------ End Polymorphic relation, display all posts  ------------------->	









                    <!--------------- Gii CRUD for table polymorphic_posts------------------->
					<div class="col-sm-12 col-xs-12"></br>
					    <h3 class="underlined">Gii CRUD for table <b> polymorphic_posts </b></h3> 
                        
						<!-- Button "Create new" -->
                        <button class="btn btn-info">
						    <a href = 'gii-create-new-post'>  
							<span class="link-text" onclick="return confirm('Are you sure to create new?')">Create new/POST  </span></a> <!--<img class="deletee"  src="{{URL::to("/")}}/images/edit.png"  alt="edit"/> --> 
						</button> 						
					</div>	
						   
						   
					<div class="col-sm-12 col-xs-12  list-group-item shadowX head-name">
							
						<div class="col-sm-2 col-xs-12"> <!-- hidden-xs -->
							Post id
					    </div>
							
						<div class="col-sm-2 col-xs-12">
							Post name
					    </div>
							
					    <div class="col-sm-2 col-xs-12">
							Post title
						</div>
							
						<div class="col-sm-2 col-xs-12">
							Author
						</div>
							
					    <div class="col-sm-2 col-xs-12">
							Image
					    </div>
								
						<div class="col-sm-2 col-xs-12">
							Buttons
					    </div>
									
					</div>
							
                            
							
				
					<!-- display all posts for Gii admin table -->		
				    @foreach ($allPosts as $x)
					    <div class="col-sm-12 col-xs-12 list-group-item bg-success cursorX shadowX crud-div"> <!-- class="row gii-content" -->
                            
							<div class="col-sm-2 col-xs-12">
							    {{ $x->id }}
							</div>
                                    
                            <div class="col-sm-2 col-xs-12">
							    {{ $x->post_name }}
							</div>

                            <div class="col-sm-2 col-xs-12">
							    {{ $x->post_text }}
							</div>
                                    
                            <div class="col-sm-2 col-xs-12">
							    {{ $x->authorName->user_name }}
							</div>

                            <div class="col-sm-2 col-xs-12">
								<!-- Show polymorphic relation image -->
							    @if ($x->imageZ)  <!-- If this Post record has image connected via Polymorphic relation -->   <!-- $x->imageZ->exists() DOES NOT WORK -->
								    
									@if(file_exists(public_path(  $x->imageZ['url'] ))) <!-- check if file is physically available in folder(e.g was in folder but was accidentally deleted) --> 

									    <img  class="gii-img" src="{{URL::to("/")}}/{{ $x->imageZ['url'] }}"  alt="a"/>  <!-- Polymorphic relation -->
                                    
									@else <!-- if Post has image connected via Polymorphic relation but physically IS NOT available in folder --> 
										    <p class="timestamp"> 
												<i class="fa fa-exclamation-circle" style="font-size:20px;color:red"></i>
												Image corrupted 
											</p>
									
									@endif										

							    @else
								    <!-- No image -->
									<img class="gii-img" src="{{URL::to("/")}}/images/no-image-found.png"  alt="a"/>
							    @endif
							</div>
									
							<div class="col-sm-2 col-xs-12">
							    <p class="hidden-sm"></p> <!-- hidden in desktop-->
							    <button class="btn btn-info">
								    <a href = 'gii-edit-post/{{ $x->id }}'>  
								        <span class="link-text" onclick="return confirm('Are you sure to edit?')">Edit via /PUT  </span></a> <!--<img class="deletee"  src="{{URL::to("/")}}/images/edit.png"  alt="edit"/> --> 
								</button>  
								
								<button class="btn btn-danger" onclick="return confirm('Are you sure to delete post {{$x->id}}  ?')"> Delete (N/A) </button>
							</div>
						</div>	
					@endforeach	
					
							
							
							
                    <!------------ End Gii CRUD ------------------->	








					
                </div>
				
            </div>
        </div>
    </div>
</div>


<script>

</script>

@endsection
