(function(){ //START IIFE (Immediately Invoked Function Expression)

$(document).ready(function(){
	
	
	// Init snow fall
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	    setTimeout(function (argument) {
           $(document).snowfall({
			   //image :"images/flake.png",
			   flakeCount : 100, 
			   minSize:1, maxSize:4, 
			   round: 4, 
			   flakeColor: "blue", 
			   //maxSpeed, minSpeed
			}); 
	       
        }, 800);                                                           
	//                                                                                     **
    // **************************************************************************************
    // **************************************************************************************	 
	
});
// end ready	
	
	
}()); //END IIFE (Immediately Invoked Function Expression)