//autocomplete for .....
//JQ autocomplete UI,(+ must include JQ_UI.js + JQ_UI.css in index.php)
$(document).ready(function(){
	 
	//var productsX is passed in View with var productsX = {!! $allProductsSearchBar->toJson() !!};
	
	//to make this script works only on SiteController/ViewOne
	if (typeof productsX === 'undefined') { 
	    alert ('Products are not passed');
		return false;
	} else {
		//alert ('Users are passed');
		//console.log(productsX );
	}
	
	//Getting current URL to construct <a href> in autocomplete. Must ne redone after pretty URLS
	var path = window.location.href;
	var urlX = path.substring(0, path.lastIndexOf("/") /*- 1*/);
	//alert(urlX);
	
	
	//array which will contain all products for autocomplete
	var arrayAutocomplete = [];
	
	
	//Loop through passed php object, object is echoed in JSON in Controller Product/action Shop
	for (var key in productsX) {
		arrayAutocomplete.push(  { label: productsX[key]['shop_title'] + "  => " +  productsX[key]['shop_price'], value: productsX[key]['shop_id'] }  ); //gets name of every user and form in this format to get and lable and value(Name & ID)

	}
	

	
    //Autocomplete itself
    $( function() {	
	
	     //fix function for autocomplete (u type email in <input id="userName">, get autocomplete hints and onSelect puts email value (i.e user ID to) to hidden <input id="userID">)
	     function displaySelectedCategoryLabel(event, ui) {
            $("#searchProduct").val(ui.item.label); //ui.item.label
            //$("#userID").val(ui.item.value); //hidden <input id="userID"> to contain user (get from autocomplete array)
            //event.preventDefault();
        };
		
		
	
		//Autocomplete 
		/*
		$("#searchUser").autocomplete({
           minLength: 1,
           source: arrayAutocomplete, //array for autocomplete
		   
		   select: function (event, ui) {
                displaySelectedCategoryLabel(event, ui);
            },
        });
		*/
		
		//Autocomplete, wrap hints in URL <a href>
		$("#searchProduct").autocomplete({
           minLength: 1,
           source: arrayAutocomplete, //array from where take autocomplete
		   
		   select: function (event, ui) {
                displaySelectedCategoryLabel(event, ui);
            },
        }).data("ui-autocomplete")._renderItem = function (a, b) {
            return $("<li></li>")
            .data("item.autocomplete", b)
            .append('<a href="' + urlX + '/showOneProduct/' + b.value + '"> ' + b.label + '</a>  ')
            .appendTo(a);
			//$("#searchProduct").val(b.label);
        };
		//END Autocomplete wrap hints in URL <a href>
	
		
   } );
   
   
   
   


});