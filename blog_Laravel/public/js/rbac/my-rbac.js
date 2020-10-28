  
(function(){ //START IIFE (Immediately Invoked Function Expression)


$(document).ready(function(){
	
    
	
	
	//Click assign
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	  $(document).on("click", '#sbmBtn', function() {   // this  click  is  used  to   react  to  newly generated cicles;
		   if($(this).closest("form").find(":selected").val() == "select"){
			  alert("Please select user role to assign");
			  //return false;
		   }
		   
	  });
	
    // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	

	 
	
});
// end ready	
	
	
}()); //END IIFE (Immediately Invoked Function Expression)