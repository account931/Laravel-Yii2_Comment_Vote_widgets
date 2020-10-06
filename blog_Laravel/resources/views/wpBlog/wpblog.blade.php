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
						
						
						
                <div class="panel-heading text-warning">WpBlog <span class="small text-danger">(u can delete/edit only your own posts.Log in to have this option. Pagination is set  if NO $_GET, i.e if it displays all articles)</span> </div>

                <div class="panel-body">
				    
					
					<a href="{{ route('createNewWpress') }}"><button>Create new</button></a>
				
				
				    <!-- Display Categories Dropdown with Blade -->
					<div class="col-sm-12 col-xs-12"></br>
					    <div class="form-group">
					        <select class="mdb-select md-form" id="dropdownnn">
						        <option value={{ url("/wpBlogg") }}  selected="selected">All articles</option>
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
					 
								    <option value={{ url("/wpBlogg?category=$a->wpCategory_id") }}  {{$selectStatus }} > {{ $a->wpCategory_name}} </option>
					            @endforeach
						    </select>
					    </div>
					</div>
					<!-- END Display Categories Dropdown with Blade -->

					
                    <div class="alert alert-success">
					    Aricles found: {{ $countArticles->count() }}
					</div>
					
					<!--<img class="img-responsive " src="{{URL::to('/')}}/images/error.png"  alt=""/>--> <!-- image -->
					
					
					
					
					<!-- If no article is found -->
					@if($articles->count() == 0)
					    {{"Nothing found"}}
					@endif
					<!-- If no article is found -->
					
					
					
					<div class="col-sm-12 col-xs-12">

					@php
					//getting correct article number (i.e if it on page=2, must not start with 1, but 5 ,etc )
					if (isset($_GET['page'])){
					$itemNumber = ($_GET['page'] -1 ) * 4 + 1;
					} else {
						$itemNumber = 1;
					}
					@endphp
					
		            <!-- Display WP Blogs with Blade (variant 1) -->
		            @foreach ($articles as $a)
						<p> <img class="img-wpblog" src="{{URL::to('/')}}/images/item.png"  alt=""/> </p>
					    <p> Article number :{{ $loop->iteration }}  </p> <!-- {{ $loop->iteration }} is Blade equivalentof $i++ -->						
                        <p> Article number true: {{ $itemNumber++ }}  </p>
						<p>Title: <b>  {{ $a->wpBlog_title     }}</b></p>
						
						<p class="text-truncated" title="click to expand">  {{ $a->truncateTextProcessor($a->wpBlog_text, 46)    }} </p>  <!-- truncated article text -->
						<p class="text-hidden">     {{ $a->wpBlog_text    }} </p>  <!-- hidden article text -->

						
						<p class='small font-italic'>  {{ $a->authorName->name  }}   {{-- $a->authorName['name']   --}}</p> <!-- hasOne relations to show author name --> <!--  " $a->wpBlog_author" returns id, "authorName()" is a model hasOne function    }}</p> --> 
						
						<!-- END NOT WORKING -->
						
						@php
						//commented in corrupted way, caused crash
						/* 
						@foreach ($a->categoryNames as $b)
						    <!--<p>Category: {{-- $b->wpCategory_name  --}}</p> --> <!-- hasMany relations to show categoty name -->
						@endforeach  
						*/
						@endphp
						<!-- END NOT WORKING -->
						
		
						<p class='small font-italic'>Category: {{ $a->categoryNames->wpCategory_name }}</p> <!-- hasMany relations to show category name, "$a->wpBlog_category" returns id of category, "categoryNames" is a model hasMany function  -->
						 
						 
						<p class='small font-italic'>Status:   {{ $a->getIfPublished($a->wpBlog_status)    }}</p>   <!-- $a->wpBlog_status is DB value Enum (0/1) -->
						<p class='small font-italic'>Created:   {{ $a->wpBlog_created_at    }}</p>   <!-- Time -->
                        
						
						
						<!-- Displays Icon to delete/edit record (only if your are the author and logged)-->
						<!-- Delete used to work via $_GET,  but changed to S_POST due security reason-->

						@if(Auth::check())
						    @if($a->wpBlog_author == auth()->user()->id)
							  
						        <!-- Form to delete the article (via $_POST)-->
								<form method="post" action="{{ url('/delete', $a->wpBlog_id )}}">
								    {!! csrf_field() !!}
									<input type="hidden" value="{{ $a->wpBlog_id }}" name="id" />
									<button onclick="return confirm('Are you sure to delete?')" type="submit" class="">Delete /POST <img class="deletee"  src="{{URL::to("/")}}/images/delete.png"  alt="del"/></button>
								    
								</form>
                                
								<!-- Link to edit the article (via $_GET)-->
								<button><a href = 'edit/{{ $a->wpBlog_id }}'>  <span onclick="return confirm('Are you sure to edit?')">Edit it__ /GET  <img class="deletee"  src="{{URL::to("/")}}/images/edit.png"  alt="edit"/></span></a></button>
								
							  <p>	
						        <!--<button><a href = 'delete/{{ $a->wpBlog_id }}'><span onclick="return confirm('Are you sure to delete?')"> Delete  <img class="deletee" onclick="return confirm('Are you sure to delete?')" src="{{URL::to("/")}}/images/delete.png"  alt="del"/></span></a></button>-->

							  </p>
							@endif
						@endif
						<!-- End Displays Icon to delete/edit record (only if your are the author and logged)-->

						
						<hr> 

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
