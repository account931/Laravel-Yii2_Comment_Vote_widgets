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
