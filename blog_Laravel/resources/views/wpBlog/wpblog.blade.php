@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">WpBlog </div>

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
					    Aricles found: {{ $articles->count() }}
					</div>
					
					<!--<img class="img-responsive " src="{{URL::to('/')}}/images/error.png"  alt=""/>--> <!-- image -->
					
					
					
					
					<!-- If no article is found -->
					@if($articles->count() == 0)
					    {{"Nothing found"}}
					@endif
					<!-- If no article is found -->
					
					
					
					<div class="col-sm-12 col-xs-12">

					
					
		            <!-- Display WP Blogs with Blade (variant 1) -->
		            @foreach ($articles as $a)
						<p> <img class="img-wpblog" src="{{URL::to('/')}}/images/item.png"  alt=""/> </p>
					    <p> Article number {{ $loop->iteration }}  </p> <!-- {{ $loop->iteration }} is Blade equivalentof $i++ -->						
                        <p>Title: <b>  {{ $a->wpBlog_title     }}</b></p>
						
						<p class="text-truncated" title="click to expand">  {{ $a->truncateTextProcessor($a->wpBlog_text, 46)    }} </p>  <!-- truncated article text -->
						<p class="text-hidden">     {{ $a->wpBlog_text    }} </p>  <!-- hidden article text -->

						
						<p class='small font-italic'>Author:   {{ $a->authorName->name   }}</p> <!-- hasOne relations to show author name --> <!--  " $a->wpBlog_author" returns id, "authorName()" is a model hasOne function    }}</p> --> 
						
						<!-- END NOR WORKING -->
						@foreach ($a->categoryNames as $b)
						    <!--<p>Category: {{-- $b->wpCategory_name  --}}</p> --> <!-- hasMany relations to show categoty name -->
						@endforeach 
						<!-- END NOT WORKING -->
						
		
						<p class='small font-italic'>Category: {{ $a->categoryNames ->wpCategory_name }}</p> <!-- hasMany relations to show category name, "$a->wpBlog_category" returns id of category, "categoryNames" is a model hasMany function  -->
						 
						 
						<p class='small font-italic'>Status:   {{ $a->getIfPublished($a->wpBlog_status)    }}</p>   <!-- $a->wpBlog_status is DB value Enum (0/1) -->
						<p class='small font-italic'>Created:   {{ $a->wpBlog_created_at    }}</p>   <!-- Time -->

						<hr> 

                    @endforeach
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
