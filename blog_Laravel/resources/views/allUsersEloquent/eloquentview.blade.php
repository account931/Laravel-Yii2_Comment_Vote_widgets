
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
		
		
		
		<!------------ Search -->
	    <div class="col-sm-12 col-xs-12">
	        <div class="search-container">
                <form action="#">
                <input type="text"  placeholder="Search by name.." name="search" id="searchUser" autofocus>
                <button type="button"><i class="fa fa-search"></i></button>
                </form>
            </div>
	   </div>
	   <!-------- END Search -->
		
		
		<div class="col-md-12">
		   <h4>All users list by Eloquent  <i class="fa fa-free-code-camp" style="font-size:2em; color:red;" aria-hidden="true"></i></h4>
		   {{-- HTMLimage('images/cph.jpg', 'alt text', array('class' = 'css-class')) --}}
		   <img class="img-responsive my-cph" src="{{URL::to('/')}}/images/item.png"  alt=""/> <!-- image -->
           
		   
		   

		   
		   <?php
		   $i =0;
		    foreach ($f as $a){
				$i++;
			   echo "<div class='list-group-item'>" . 
			          $i . " <span class='	fa fa-check-square-o' ></span> " .
				      $a->name . ", " . $a->email .
				    "</div>";
		   }
		   ?>
		</div>
		
    </div>
</div>
@endsection
