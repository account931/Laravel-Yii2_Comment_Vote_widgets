@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">WpBlog </div>

                <div class="panel-body">
				
                    <div class="alert alert-success">
                        WpBlog
					</div>
					
					<!--<img class="img-responsive " src="{{URL::to('/')}}/images/error.png"  alt=""/>--> <!-- image -->
					
					
					
					
					
					<div class="col-sm-12 col-xs-12">

					
					
		            <!-- Display WP Blogs with Blade (variant 1) -->
		            @foreach ($articles as $a)
						<p> <img class="img-wpblog" src="{{URL::to('/')}}/images/item.png"  alt=""/> </p>
					    <p> Article number {{ $loop->iteration }}  </p> <!-- {{ $loop->iteration }} is Blade equivalentof $i++ -->						
                        <p>Title:    {{ $a->wpBlog_title     }}</p>
						<p>          {{ $a->wpBlog_text      }}</p>
						
						<p>Author:   {{ $a->authorName->name   }}</p> <!-- hasOne relations to show author name --> <!-- <p>Author:   {{ $a->wpBlog_author    }}</p> --> 
						<p>Category: {{ $a->categoryName->wpCategory_name  }}</p> <!-- hasOne relations to show categoty name -->
						<p>Status:   {{ $a->wpBlog_status    }}</p>
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
