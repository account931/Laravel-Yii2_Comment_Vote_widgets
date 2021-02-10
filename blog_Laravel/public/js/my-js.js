  
(function(){ //START IIFE (Immediately Invoked Function Expression)


$(document).ready(function(){
	
    
	
	
	//Show My custom Submenu on click on "Drop"
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	  $(document).on("click", '.navbar-nav1', function() {   // this  click  is  used  to   react  to  newly generated cicles;
		  $('.dropdown-submenu').show(100);  
	  });
	
    // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	

	 //any click except on .navbar-nav1 -> hide the menu
	 $(document).on("click", 'body', function(e) {   // this  click  is  used  to   react  to  newly generated cicles;
		   /* exept elements with class someClass */ 
        if($(e.target).hasClass('navbar-nav1')){
            e.preventDefault();
            return;
        }

        /* but be carefull the contained links! to be clickable */
        if($(e.target).is('a')){
            return;
        }

        /* here you can code what to do when click on html */
         $('.dropdown-submenu').hide(300);   
	  });
	
	
	
});
// end ready	
	
	
}()); //END IIFE (Immediately Invoked Function Expression)