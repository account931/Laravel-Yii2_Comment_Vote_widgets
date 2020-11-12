//Lazy Load (to use: 1.download js=> <script src="jquery.lazyload.js"></script> 2. use in html=> <img class="lazy" data-original="img/example1.jpg"; 3. use code below in js
//https://vash-webmaster.ru/2017/08/11/lazyload-js/

$(function() {
	
	
    $("img.lazy").lazyload({
		 effect : "fadeIn", //appear effect
		 effectspeed: 200,
		 placeholder : "images/grey.gif", //preloader image
         //threshold : 0 //content will load only on scrolling down 10px
    });
	
	//my fix. As lazy images used to load on scroll only and onload remained with placeholder, we load with delay first 4 images, rest would load on scroll
	setTimeout(function(){  
    //$("img.lazy").trigger('appear');
	  $("img.lazy:lt(4)").trigger('appear'); //show 4 first images
	}, 3000);
	
});

//Lazy Load




//Js for front SHOP {Simple}, (main) part of the shop (page with products)
  
(function(){ //START IIFE (Immediately Invoked Function Expression)


$(document).ready(function(){
	
	
    
	
	
	//Shop products/items category Dropdown. On change redirect to <option> href
   // **************************************************************************************
   // **************************************************************************************
   //                                                                                     ** 
	if(document.getElementById("dropdowShop") !== null){ //additional check to avoid errors in console in actions, other than actionShowAllBlogs(), when this id does not exist
	   document.getElementById("dropdowShop").onchange = function() {
          //if (this.selectedIndex!==0) {
              window.location.href = this.value;
          //}        
       };
	}
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************






	
	 //==============================================
	 //on opening a modal pop-up (when u click a product), do reset any changes if they were applied early (e.g <button> css was changed)
	 $('.modal-trigger').on('click', function(){ 
		normalizeAddToCartButton(this);
	 });
	 
	 
	 
	 
	
	 //==================================================================
     //[ +/- num product ]*/
	
	//Plus ++
    $('.button-plus').on('click', function(){ 
		
		
		var numProduct = Number($(this).closest('div').next().find('input:eq(1)').val()); //gets current input quantity. Use {input:eq(1)}, as {input:eq(0)} is a CSRF token
		
		$(this).closest('div').next().find('input:eq(1)').val(Number(numProduct) + 1); //html new value++
		
		
		//var price = $(this).parent().parent().siblings().find('.price-x').html(); //gets price-x. Working, but reassigned to {data-priceX}
		var price = this.getAttribute("data-priceX"); //gets price from {data-priceX}
		var currency = this.getAttribute("data-currX"); //gets DB currency from {data-currX} 
		console.log("price " + price);
		calcPrice(numProduct+1, price, currency);
		
		//normalizeAddToCartButton();
    });
	
	 

	 
	  
	 
	//*==================================================================
	//Minus --
    $('.button-minus').on('click', function(){
		var numProduct = Number($(this).closest('div').prev().find('input:eq(1)').val()); //gets current input quantity. Use {input:eq(1)}, as {input:eq(0)} is a CSRF token
		
		if(numProduct == 0){
			swal("Stop!", "Can't go further", "warning");
			return false;
		}
		
		if(numProduct <= 1){
			if(this.getAttribute("data-cartFlag")=="true"){ //if product was prev selected and now is in cartFlag
			    $('.submitX').html('Remove from cart?'); 
				$('.submitX').css('background', 'red'); //change button style 
			} else {
			    swal("Stop!", "Can't select zero items", "warning");
			    return false;
			}
		}
		
		$(this).closest('div').prev().find('input:eq(1)').val(numProduct - 1); //html new value--
		
		//var price = $(this).parent().parent().siblings().find('.price-x').html(); //gets the price from modal, price-x. Working, but reassigned to {data-priceX}
		var price = this.getAttribute("data-priceX"); //gets price from {data-priceX}
		var currency = this.getAttribute("data-currX"); //gets DB currency from {data-currX}
		
		
		calcPrice((numProduct-1), price, currency); //quantity*price
    });
	
	
	 
	 //==================================================================
	 //calcs & html the amount of sum for all items, i,e 2x16.66 = N
	 function calcPrice(quant, itemPrice, currencyArg){
		//$('.sum').html(Number(quant) + ' item x ' + itemPrice + '₴ = ' + (quant*itemPrice).toFixed(2) + '₴' );
		  $('.sum').stop().hide(100,function(){ $(this).html( Number(quant) + ' item x ' + itemPrice + ' ' + currencyArg + ' = ' + (quant*itemPrice).toFixed(2) + ' ' + currencyArg  )}).fadeIn(200);

	 }

	 
	
	//*==================================================================
	//on change the input, do recalculating
	//$('.item-quantity').on('change', function() {alert( "Handler." );});
	//$('.item-quantity').on('input', function(){ alert('changed input ') }); 
	//DOES NOT WORK!!!!!!!!
	$("body").on('DOMSubtreeModified', ".item-quantity", function() {
        alert('changed');
    });
	
	





	
	
	// Allow input in form quantity field digits only, using a RegExp. Actually id does not allow to print eaither int or string
	  $('.item-quantity').keydown(function(e) { alert('OK2');
        //this.value = this.value.replace(/[^0-9]/g, '');
		
		var digits = /\D/g;		
		 if (digits.test(Number(this.value))){
              // Filter non-digits from input value.
              this.value = this.value.replace(/\D/g, ''); alert('Ok int');
          } else {
			  alert("NaN");
			  e.preventDefault();
		  }
    });
	
	
  //return normal text, bg and attribute to "Add to cart" button if it was changed by -- for instance when you  -- last item in modal window
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **                                                                                  **
	function normalizeAddToCartButton(thisX){
		//$('.my-button-x').prop('disabled', false);
		$('.submitX').html('Add to cart');
		$('.submitX').css('background', '#717fe0');
		$('.sum').html(''); //clear field with summing, e.g 16.16 x 2 = 33.28
		var q = thisX.getAttribute("data-quantityZ");
		$('.item-quantity').val(q);  
		
    }
	
  
	  


	
});
// end ready	
	
	
}()); //END IIFE (Immediately Invoked Function Expression)