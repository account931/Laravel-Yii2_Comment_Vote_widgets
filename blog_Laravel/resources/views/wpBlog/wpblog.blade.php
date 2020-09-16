@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">WpBlog </div>

                <div class="panel-body">
				    
					<button>Create new</button>
				
				
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
                        <p>Title:    {{ $a->wpBlog_title     }}</p>
						<p>          {{ $a->wpBlog_text      }}</p>
						
						<p>Author:   {{ $a->authorName->name   }}</p> <!-- hasOne relations to show author name --> <!-- <p>Author:   {{ $a->wpBlog_author    }}</p> --> 
						
						<!-- END NOR WORKING -->
						@foreach ($a->categoryNames as $b)
						    <!--<p>Category: {{-- $b->wpCategory_name  --}}</p> --> <!-- hasMany relations to show categoty name -->
						@endforeach 
						<!-- END NOT WORKING -->
						
						 <p>Category: {{ $a->categoryNames ->wpCategory_name }}</p> <!-- hasMany relations to show categoty name -->
						 
						 
						<p>Status:   {{ $a->test($a->wpBlog_status)    }}</p>
						<hr>

                    @endforeach
				    <!-- End Display WP Blogs with Blade (variant 1) -->

					
					
				   <!-- Display  WP Blogs with pure Php (variant 2) -->
		           <?php
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
		           ?>
				   
		          </div>
					
					
					
					
					
					 
					
					
					
					
					
					
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
