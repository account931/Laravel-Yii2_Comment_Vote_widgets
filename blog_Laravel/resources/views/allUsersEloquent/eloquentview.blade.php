
@extends('layouts.app')

@section('content')
<script>
    var usersX = {!! $f->toJson() !!};
</script>

<div class="container">
    <div class="row">
	
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> All users list by Eloquent</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                
                </div>
            </div>
        </div>
		
		
		
		<!------------ Search bar --------->
		<!-- serach bar to search Users, uses autocomplete.js, Each user is wrapped to <a href="/showOneUser/$id"> Name</a> --------->
	    <div class="col-sm-12 col-xs-12" style="z-index:9999;"> <!-- z-index is a Fix, as prev was not able to type in input-->
	        <div class="search-container">
                <form action="#">
                    <input type="text"  placeholder="Search by name.." name="search" id="searchUser">
                    <button type="button"><i class="fa fa-search"></i></button>
                </form>
            </div>
	   </div>
	   <!-------- END Search bar  --------->
		
		
		<div class="col-md-12">
		   <h4>All users list by Eloquent  <i class="fa fa-free-code-camp" style="font-size:2em; color:red;" aria-hidden="true"></i></h4>
		   {{-- HTMLimage('images/cph.jpg', 'alt text', array('class' = 'css-class')) --}}
		   <img class="img-responsive my-cph" src="{{URL::to('/')}}/images/item.png"  alt=""/> <!-- image -->
           
		   
		   

		   
		   <?php
		   //display all users list with pure php. Each user is wrapped to <a href="/showOneUser/$id"> Name</a>
		   $i =0;
		    foreach ($f as $a){
				$i++;
			   echo "<div class='list-group-item'>"; ?>
			            <a href='{{ url("/showOneUser/$a->id") }}'>
			            <?php
						echo  $i . " <span class='	fa fa-check-square-o' ></span> " .
				            $a->name . ", " . $a->email .
						"</a>" .
				    "</div>";
		   }
		   ?>
		</div>
		
    </div>
</div>
@endsection
