<?php 
//if use here <!-- --> to comment (out of php, it causes html errors????)
//Select by category. Categories are taken from SQL DB table {shop_categories} ?>
<select class="mdb-select md-form" id="dropdowShop">
    <option value={{ url("/shopSimple") }}  selected="selected">All items</option>
   @foreach ($allCategories as $a)
   @php
   //gets to know what select <option> to make selected according to $_GET['']
   if(isset($_GET['shop-category']) && $_GET['shop-category'] == $a->categ_id){
	    $selectStatus = 'selected="selected"';
   } else {
       $selectStatus = '';
   }
   @endphp
					 
   <option value={{ url("/shopSimple?shop-category=$a->categ_id") }}  {{$selectStatus }} > {{ $a->categ_name}} </option>
   @endforeach
</select>