  
(function(){ //START IIFE (Immediately Invoked Function Expression)


$(document).ready(function(){
	
 //alert ('npm run watch ');	
 
//WP Blog Dropdown
// **************************************************************************************
// **************************************************************************************
//                                                                                     ** 
	if(document.getElementById("dropdownnn") !== null){ //additional check to avoid errors in console in actions, other than actionShowAllBlogs(), when this id does not exist
	   document.getElementById("dropdownnn").onchange = function() {
          //if (this.selectedIndex!==0) {
              window.location.href = this.value;
          //}        
       };
	}
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************



	
	
	
	//on click on cut/truncated text (class .text-truncated) show all text
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	  $(document).on("click", '.text-truncated', function() {   // this  click  is  used  to   react  to  newly generated cicles;
	      $('.text-hidden').fadeOut(300);  $('.text-truncated').show(400); //if there is any prev opened texts, hide them all it & show all truncated
		  $(this).fadeOut(300); //hide truncated
		  $(this).next($('.text-hidden')).show(400);
		  
	  });
	
    // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	//on click on Full expended text (class .text-hidden) show cut/truncated text
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	  $(document).on("click", '.text-hidden', function() {   // this  click  is  used  to   react  to  newly generated cicles;
	      $(this).fadeOut(300);
		  $(this).prev($('.text-truncated')).show(400);
		  
	  });
	
    // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	
	//LightBox init
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	 lightbox.option({
      'resizeDuration': 200,
	  'fadeDuration': 600,
      'wrapAround': true,
	  'fitImagesInViewport':true, //img fit the screen
	  'alwaysShowNavOnTouchDevices': true
    });

     // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************





	//code to populate the input file/image field (+/-) (to copy and paste new input on ++/--)
	//to populate <input type="file"> with JS (on click "+", adds a new <input>
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	$(".btn-populate-x").click(function(){  
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });
	
});
// end ready	
	
	
}()); //END IIFE (Immediately Invoked Function Expression)