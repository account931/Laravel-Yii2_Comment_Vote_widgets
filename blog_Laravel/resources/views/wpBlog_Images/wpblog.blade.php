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
						
						
						
                <div class="panel-heading text-warning borderX" style="border:1px solid black;">
				    <button style="font-size:24px">Wpress <i class="fa fa-book"></i></button><br>
				    WpBlog with Images <span class="small text-danger">(It is very much like Wpress, but utilizes blog article with one or more images. 
					Images are LightBox-ed. This Wpress Image Blog uses it's own 3-table DB. Pagination is set by $_GET['page'], i.e if there is NO $_GET['page'] in URL, it displays first n articles)</span> 
			    </div>

                <div class="panel-body">
				    
					
					<p><a href="{{ route('createNewWpressImg') }}"><button class="btn btn-large btn-success">Create new</button></a></p>
				
				
				    <!-- Display Categories Dropdown with Blade -->
					<div class="col-sm-12 col-xs-12"></br>
					    <div class="form-group">
					        <select class="mdb-select md-form" id="dropdownnn">
						        <option value={{ url("/wpBlogImages") }}  selected="selected">All articles</option>
		                        @foreach ($categories as $a)
								
								    @php
								    //gets to know what select <option> to make selected according to $_GET['']
			                        if(isset($_GET['category']) && $_GET['category'] == $a->wpCategory_id){
				                        $selectStatus = 'selected="selected"';
			                         } else {
					                     $selectStatus = '';
								     }
									 //$a->wpCategory_id
								     @endphp
					 
								    <option value={{ url("/wpBlogImages?category=$a->wpCategory_id") }}  {{$selectStatus }} > {{ $a->wpCategory_name}} </option>
					            @endforeach
						    </select>
					    </div>
					</div>
					<!-- END Display Categories Dropdown with Blade -->

					
                    <div class="alert alert-info borderX">
					    Aricles found: {{ $countArticles->count() }}
					</div>
					
					<!--<img class="img-responsive " src="{{URL::to('/')}}/images/error.png"  alt=""/>--> <!-- image -->
					
					
					
					
					<!-- If no article is found -->
					@if($articles->count() == 0)
					    {{"Nothing found"}}
					@endif
					<!-- If no article is found -->
					
					
					
					<div class="col-sm-12 col-xs-12">

					<?php
					//getting correct article number (i.e if it on page=2, must not start with 1, but 5 ,etc )
					if (isset($_GET['page'])){
					$itemNumber = ($_GET['page'] -1 ) * 4 + 1;
					} else {
						$itemNumber = 1;
					}
					?>
					
		            <!-- Display WP Blogs with Blade (variant 1) -->
		            @foreach ($articles as $a)
					   <div class="col-sm-12 col-xs-12 borderX shadowX">
						<!--<p> <img class="img-wpblog" src="{{URL::to('/')}}/images/traff.jpg"  alt="check"/> </p>-->
						
						
						
						
						<!-- hasMany Relation, Displays 1st Photo as main. Images from table {wpressimage_imagesstock}. -->
						<p> Main Image </p>
						<?php $i = 0; ?>
						{{-- Check if relation Does not exist (i.e no images) --}}
						@if( $a->getImages->isEmpty() )
					        <p><img class="image-main" src="{{URL::to("/")}}/images/no-image-found.png"  alt="a"/><p>
						
						{{-- Check if relation exists (i.e images exist), if True, foreach it --}}
						@else
                      							
					        @foreach ($a->getImages as $x) {{--hasMany must be inside second foreach--}}
						        {{-- If it is first image --}}
								@if($i == 0)
									
								    @if(!file_exists(public_path('images/wpressImages/' . $x->wpImStock_name))){{-- check if image exists --}}
								    
									   {!! "<span class='small'>image was likely deleted or missing</span>" !!} {{-- with html unescapped tags --}}
									@else 
									
									    <!-- Image with LightBox -->
						                <a href="{{URL::to("/")}}/images/wpressImages/{{$x->wpImStock_name}}"  title="" data-lightbox="roadtrip{{$a->wpBlog_id}}"> <!-- roadtrip + currentID, to create a unique data-lightbox name, so in modal LightBox will show images related to this article only, not all -->
				                            <img class="image-main" src="{{URL::to("/")}}/images/wpressImages/{{$x->wpImStock_name}}"  alt="img"/>
									    </a>
									    <!-- End Image with LightBox -->
									@endif 
									
								@endif
						        <?php $i++; ?>
	                       @endforeach
						@endif
                        <!-- End hasMany Relation, Displays 1st Photo as main. Images from table {wpressimage_imagesstock}. -->
						
						
						
					    <p> Article number :{{ $loop->iteration }}  </p> <!-- {{ $loop->iteration }} is Blade equivalentof $i++ -->						
                        <p> <i class="fa fa-book"></i>              <b> Article number true: {{ $itemNumber++ }}  </b></p>
						<p> <i class="fa fa-calendar-check-o"></i>  <b> Title:   {{ $a->wpBlog_title     }}</b></p>
						
						<p class="text-truncated" title="click to expand">  {{ $a->truncateTextProcessor($a->wpBlog_text, 86)    }} </p>  <!-- truncated article text -->
						<p class="text-hidden">     {{ $a->wpBlog_text    }} </p>  <!-- hidden article text -->
                        
						
						
						
						
						<!-- hasMany Relation. Displays all the rest images, except for the 1st Photo. Images from table {wpressimage_imagesstock}. -->
						<p> Others minor images </p>
						<?php $i = 0; ?>
						{{-- Check if relation Does not exist --}}
						@if( $a->getImages->isEmpty() )
					        <!--<p><img class="image-main" src="{{URL::to("/")}}/images/no-image-found.png"  alt="a"/><p>-->
						
						{{-- Check if relation exists, if True, foreach it --}}
						@else
                      		
						    						
					        @foreach ($a->getImages as $x) {{--hasMany must be inside second foreach--}}
						        {{-- If it is first image --}}
								@if($i > 0)
							        
	                                <!-- Image with LightBox -->
						            <a href="{{URL::to("/")}}/images/wpressImages/{{$x->wpImStock_name}}"  title="" data-lightbox="roadtrip{{$a->wpBlog_id}}"> <!-- roadtrip + currentID, to create a unique data-lightbox name, so in modal LightBox will show images related to this article only, not all -->
								        <img class="image-others" src="{{URL::to("/")}}/images/wpressImages/{{$x->wpImStock_name}}"  alt="img"/>
									</a>
									<!-- End Image with LightBox -->
									
						        @endif
		                   
						        <?php $i++; ?>
	                       @endforeach
						   
						   
						@endif
						<!-- End hasMany Relation. Displays all the rest images, except for the 1st Photo. Images from table {wpressimage_imagesstock}. -->
						
						   
						
						
						
						<!-- Blog info: category, author, status, read full article -->
						<hr class="hrX">
						<p class='smallX font-italic'>  <i class="fa fa-address-card-o"></i> Author:   {{ $a->authorName->name  }}   {{-- $a->authorName['name']   --}}</p> <!-- hasOne relations to show author name --> <!--  " $a->wpBlog_author" returns id, "authorName()" is a model hasOne function    }}</p> --> 
						<p class='smallX font-italic'>  <i class="fa fa-archive"></i>        Category: {{ $a->categoryNames->wpCategory_name }}</p> <!-- hasMany relations to show category name, "$a->wpBlog_category" returns id of category, "categoryNames" is a model hasMany function  -->
						<p class='smallX'>              <i class="fa fa-bank"></i>           Status:   {{ $a->getIfPublished($a->wpBlog_status)    }}</p>   <!-- $a->wpBlog_status is DB value Enum (0/1) -->
						<p class='smallX'>Created:   {{ $a->wpBlog_created_at    }}</p>   <!-- Time -->
                        <p class='smallX'><a href="{{route('wpBlogImagesOne', ['id' => $a->wpBlog_id])}}">read full article...</a></p>   <!-- link to one article page -->
                        <!-- End Blog info: category, author, status, read full article -->

 


						
						
						
						<hr> 
                      </div>
                    @endforeach
					
					<!-- Display pagination (only if NO $_GET, i.e display all articles) -->
					@if(!isset($_GET['category']))
					    {{ $articles->links() }}
					@endif
					
				    <!-- End Display WP Blogs with Blade (variant 1) -->

					
					
				   <!-- Display  WP Blogs with pure Php (variant 2) -->
		           <?php
				   /*
				   $i = 1;
		           foreach ($articles as $a){
			           echo "<div class='list-group-item col-sm-12 col-xs-12'>" .
					          //'<img class="img-responsive my-cph" src="{{URL::to("/")}}/images/cph.jpg"  alt="a"/>'.
                               "<p> Article " . $i . "</p>" .							  
					           "<p>" . $a->wpBlog_title . "</p>" .
						       "<p>" . $a->wpBlog_text  . "</p>" .
						    "</div>";
					$i++;
		            }
					*/
		           ?>
				   
		          </div>
					
					
					
					
					
					 
					
					
					
					
					
					
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
