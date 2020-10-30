  
(function(){ //START IIFE (Immediately Invoked Function Expression)


$(document).ready(function(){
	
    
	
	
	//Click "assign' button
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	  $(document).on("click", '.sbmBtn', function() {   // this  click  is  used  to   react  to  newly generated cicles;
		   
		   //check if user selected any role. Just for front-end check, relevant back-end validation rule is also available
		   if($(this).closest("form").find(":selected").val() == "select"){
			  //alert("Please select user role to assign. Back-end validation is also available");
			  swal("Attention!", "Please select user role to assign. Back-end validation is also available.", "error");
			  return false;
		   }
		   
		   
		   var selectedRoleText = $(this).closest("form").find(":selected").text();  //gets text of selected <select>, i.e 'manager'. If u use .val() instead of text(), u'll ger value, i.e 14
		   var userRolesTextList = $(this).parent().parent().parent().find( $(".user-roles-list" )).html();  //gets the <td> text with user roles, i.e "owner, manager"
		   
		   //remove html tags from userRolesTextList
		   var regexHTMLTags = /(<([^>]+)>)/ig; //regExp for html tags
		   var result = userRolesTextList.replace(regexHTMLTags, "");
		   //alert(result);
		   
		   //alert(selectedRoleText); // a role selected by admin
		   //check if <td> text with user's roles contains the role selected from dropdown
		   if( new RegExp(selectedRoleText).test(result) ){ 
		       swal("Attention!", "User has already selected role <b> " + selectedRoleText + " </b>  Back-end validation is also available.", "error");
			   return false;
		   }
		   return false;
		   
		   
		   
	  });
	
    // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	

	 
	 
	 
	 
	 
	
});
// end ready	
	
	
}()); //END IIFE (Immediately Invoked Function Expression)