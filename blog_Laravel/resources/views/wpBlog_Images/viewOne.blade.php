<?php
//View one article by id
?>

@extends('layouts.app')


@section('content')

<!-- Include js file for this view only -->



<div  class="container ">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="panel panel-default xo">
			
			
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
					
					
                <div class="panel-heading text-warning col-sm-12 col-xs-12">
				
				  <div class="col-sm-12 col-xs-12">
				    View one article<span class="small text-danger">*</span> 
				  </div>
				  
				  
				</div>





                <div class="panel-body test-middle-x">
				
				    <div class="col-sm-7 col-xs-4">
                        <h1>One article</h1>
		            </div>	
				    
					
					<!-- Just info, may delete later -->
				    <div class="col-sm-12 col-xs-12 alert alert-info small font-italic text-danger  shadowX">
					    <h5><span class='glyphicon glyphicon-flag' style='font-size:38px;'></span> This page is implementation of One Article view for WPres-Images, uses LightBox</h5>
		                <!--<p><b>See docs at .....</b></p>-->
		                <hr>
		                <!--<p>Some more text.</p>-->
					</div>
					
					<!-- Go back link -->
					<div class="col-sm-12 col-xs-12">
					    <a href="{{ url('wpBlogImages') }}"><i class="fa fa-angle-double-left" style="font-size:49px"></i>    <span style="position:relative; bottom:0.7em;">back to list </span></a><br>
					</div>
					<!-- Go back link -->
					
					
					
					
					<!----------- Dispaly one article ---------------->
					<div class="col-sm-12 col-xs-12 borderX">
						<p> <img class="img-wpblog" src="{{URL::to('/')}}/images/item.png"  alt=""/> </p>
                        
						
						
						<!-- hasMany Relation, Displays 1st Photo as main. Images from table {wpressimage_imagesstock}. -->
						<p> Main Image </p>
						<?php $i = 0; ?>
						{{-- Check if relation Does not exist --}}
						@if( $articleOne[0]->getImages->isEmpty() )
					        <p><img class="image-main" src="{{URL::to("/")}}/images/no-image-found.png"  alt="a"/><p>
						
						{{-- Check if relation exists, if True, foreach it --}}
						@else
                      							
					        @foreach ($articleOne[0]->getImages as $x) {{--hasMany must be inside second foreach--}}
						        {{-- If it is first image --}}
								@if($i == 0)
									
									<!-- Image with LightBox -->
						            <a href="{{URL::to("/")}}/images/wpressImages/{{$x->wpImStock_name}}"  title="" data-lightbox="roadtrip{{$x->wpBlog_id}}"> <!-- roadtrip + currentID, to create a unique data-lightbox name, so in modal LightBox will show images related to this article only, not all -->
								        <img class="image-main" src="{{URL::to("/")}}/images/wpressImages/{{$x->wpImStock_name}}"  alt="img"/>
									</a>
									<!-- End Image with LightBox -->
									
						        @endif
						        <?php $i++; ?>
	                       @endforeach
						@endif
                        <!-- End hasMany Relation, Displays 1st Photo as main. Images from table {wpressimage_imagesstock}. -->
						
						
						
                        <p><b>Article id: {{ $articleOne[0]->wpBlog_id    }}</b></p>
						<p><b>Title:      {{ $articleOne[0]->wpBlog_title }}</b></p>
						
						<p title="full text">  {{ $articleOne[0]->wpBlog_text }} </p>  

                        
						<!-- hasMany Relation. Displays all the rest images, except for the 1st Photo. Images from table {wpressimage_imagesstock}. -->
						<p> Others minor images </p>
						<?php $i = 0; ?>
						{{-- Check if relation Does not exist --}}
						@if( $articleOne[0]->getImages->isEmpty() )
					        <!--<p><img class="image-main" src="{{URL::to("/")}}/images/no-image-found.png"  alt="a"/><p>-->
						
						{{-- Check if relation exists, if True, foreach it --}}
						@else
                      							
					        @foreach ($articleOne[0]->getImages as $x) {{--hasMany must be inside second foreach--}}
						        {{-- If it is first image --}}
								@if($i > 0)
									
								    <!-- Image with LightBox -->
						            <a href="{{URL::to("/")}}/images/wpressImages/{{$x->wpImStock_name}}"  title="" data-lightbox="roadtrip{{$x->wpBlog_id}}"> <!-- roadtrip + currentID, to create a unique data-lightbox name, so in modal LightBox will show images related to this article only, not all -->
								        <img class="image-others" src="{{URL::to("/")}}/images/wpressImages/{{$x->wpImStock_name}}"  alt="img"/>
									</a>
									<!-- End Image with LightBox -->
									
						        @endif
		                   
						        <?php $i++; ?>
	                       @endforeach
						@endif
						<!-- End hasMany Relation. Displays all the rest images, except for the 1st Photo. Images from table {wpressimage_imagesstock}. -->
						
						
						
						<!-- Blog info: category, author, status-->
						<hr class="hrX">
						<p class='smallX font-italic'> Author: {{ $articleOne[0]->authorName->name  }}   {{-- $a->authorName['name']   --}}</p> <!-- hasOne relations to show author name --> <!--  " $a->wpBlog_author" returns id, "authorName()" is a model hasOne function    }}</p> --> 
						
						<p class='smallX font-italic'>Category: {{ $articleOne[0]->categoryNames->wpCategory_name }}</p> <!-- hasMany relations to show category name, "$a->wpBlog_category" returns id of category, "categoryNames" is a model hasMany function  -->
						 
						 
						<p class='smallX'>Status:   {{ $articleOne[0]->getIfPublished($articleOne[0]->wpBlog_status)    }}</p>   <!-- $a->wpBlog_status is DB value Enum (0/1) -->
						<p class='smallX'>Created:   {{ $articleOne[0]->wpBlog_created_at    }}</p>   <!-- Time -->

						
						
						<!-- Displays Icon to delete/edit record (only if your are the author and logged)-->
						<!-- Delete used to work via $_GET,  but changed to S_POST due security reason-->

						@if(Auth::check())
						    @if($articleOne[0]->wpBlog_author == auth()->user()->id)
							  
						        <!-- Form to delete the article (via $_POST)-->
								<div class="row"> <!-- row-no-gutters remove the gutters from a row and its columns -->
								<div class="col-sm-4 col-xs-6" style="text-align:right;">
								    <form method="post" action="{{ url('/delete', $articleOne[0]->wpBlog_id )}}">
								        {!! csrf_field() !!}
									    <input type="hidden" value="{{ $articleOne[0]->wpBlog_id }}" name="id" />
									    <button onclick="return confirm('Are you sure to delete?')" type="submit" class="">Delete via /POST <img class="deletee"  src="{{URL::to("/")}}/images/delete.png"  alt="del"/></button>
								    </form>
								</div>
                                
								<!-- Link to edit the article (via $_GET)-->
								<div class="col-sm-4 col-xs-6">
								    <button><a href="{{ url('/edit')}}/{{$articleOne[0]->wpBlog_id }}" >   <span onclick="return confirm('Are you sure to edit?')">Edit via/GET  <img class="deletee"  src="{{URL::to("/")}}/images/edit.png"  alt="edit"/></span></a></button>
								</div>
								
							  
								</div><!-- end .row-->
							  <p>	

							  </p>
							@endif
						@endif
						<!-- End Displays Icon to delete/edit record (only if your are the author and logged)-->

						
						<hr> 
                      </div>
				      <!-- End Dispaly one article -->
					
				
				</div> <!-- end .test-middle-x -->
				    
					
			
			
			
			
			
					
                
            </div> <!-- end .panel-default xo -->
        </div>
    </div>
</div> <!-- end . animate-bottom -->








@endsection
