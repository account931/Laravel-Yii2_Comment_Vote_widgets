@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
	
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard22</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged
                </div>
            </div>
        </div>
		
		<div class="col-md-12">
		   All users list by Eloquent <span class="glyphicon glyphicon-cutlery" style="font-size:2em;"></span>
		   <?php
		    foreach ($f as $a){
			   echo "<div class='list-group-item'>" .$a->email . "</div>";
		   }
		   ?>
		</div>
		
    </div>
</div>
@endsection
