<?php
//snow is in JS, scrips are attached in view/layout/app.php
//https://github.com/loktar00/JQuery-Snowfall
//<script type="text/javascript" src="https://unpkg.com/jquery-snowfall@1.7.4/dist/snowfall.jquery.min.js"></script>  <!--Snow lib JS-->

?>
@extends('layouts.app')


@section('content')


	
<div class="container mt-5">
    <h2 class="mb-4">Laravel 7|8 Yajra Datatables Example</h2>
    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Phone</th>
                <th>DOB</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
	
	<div class="col-sm-12 col-xs-12 alert-danger">
	   <h4>
	      Admin LTE3 and Yajra DataTables are implemented IN {abz_Laravel_6_LTS} as they encounter difficulties on Laravel 5.2 </p>
       </h4>
	</div>
	
	
	<!-- Snow Contols -->
	<!-- https://github.com/loktar00/JQuery-Snowfall -->
	<div class="col-sm-6 col-xs-8 alert-info" style="margin-top:1em; padding:1em;">
	   <h4> Snow controls </h4>
        <input type="button" class="btn" id="clear" value="Click to clear"/>
		<div class="visible-xs">-</div> <!-- Visible on mobile only -->
        <input type="button" class="btn" id="round" value="Snow white"/>
		<div class="visible-xs">-</div><!-- Visible on mobile only -->
		<input type="button" class="btn" id="imgbut" value="Images"/>
		<div class="visible-xs">-</div> <!-- Visible on mobile only -->
		<input type="button" class="btn" id="snowDef" value="Snow default"/>
	</div>
	
	
</div>


@endsection

