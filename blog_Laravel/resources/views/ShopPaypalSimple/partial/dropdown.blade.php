
<select class="mdb-select md-form" id="dropdownnn">
    <option value={{ url("/wpBlogg") }}  selected="selected">All items</option>
   @foreach ($allCategories as $a)
   @php
   //gets to know what select <option> to make selected according to $_GET['']
   if(isset($_GET['category']) && $_GET['category'] == $a->categ_id){
	    $selectStatus = 'selected="selected"';
   } else {
       $selectStatus = '';
   }
   //$a->wpCategory_id
   @endphp
					 
   <option value={{ url("/wpBlogg?category=$a->categ_name") }}  {{$selectStatus }} > {{ $a->categ_name}} </option>
   @endforeach
						    </select>