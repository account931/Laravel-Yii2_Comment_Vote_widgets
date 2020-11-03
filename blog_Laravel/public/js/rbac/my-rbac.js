  
(function(){ //START IIFE (Immediately Invoked Function Expression)


$(document).ready(function(){
	
    
	
	
	//Click "assign' button
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	  $(document).on("click", '.sbmBtnPREV', function() {   // this  click  is  used  to   react  to  newly generated cicles;
		   
		   var userName = this.getAttribute("data-uName"); //gets user name u want to assign any role. Set in hml by adding to button data-uName="{{$a->name}}" 
		   
		   
		   //check if user selected any role. Just for front-end check, relevant back-end validation rule is also available
		   //if($(this).closest("form").find(":selected").val() == "select"){
			if($(this).parent().find(":selected").text() == "select"){
			  //alert("Please select user role to assign. Back-end validation is also available");
			  swal({html:true, title:'Attention!', text:'Please select rbac role for <b>' + userName + '</b> to assign.</br>  NB:Back-end validation is also available.', type: 'error'});

			  return false;
		   }
		   
		   //console.log($(this).parent().find(":selected").text());  
		   var selectedRoleText = $(this).parent().find(":selected").text(); //Mega FIX ????
		   //var selectedRoleText = $(this).closest("form").find(":selected").text();  //gets text of selected <select>, i.e 'manager'. If u use .val() instead of text(), u'll ger value, i.e 14
		   //var selectedRoleText = $(this).parents('form').find(":selected").text(); //gets this current form
		   var userRolesTextList = $(this).parent().parent().parent().find( $(".user-roles-list" )).html();  //gets the <td> text with user roles, i.e "owner, manager"
		   
		   //remove html tags from userRolesTextList
		   var regexHTMLTags = /(<([^>]+)>)/ig; //regExp for html tags
		   var result = userRolesTextList.replace(regexHTMLTags, ""); //admin, manager, etc
		   alert(result + "; Selected role=>  " + selectedRoleText);
		   
		   //alert(selectedRoleText); // a role selected by admin
		   //check if <td> text with user's roles contains the role selected from dropdown
		   if( new RegExp(selectedRoleText).test(result) ){ 
		      
		       swal({html:true, title:'Attention!', text:'User <b>' + userName + '</b> has already selected role <b> ' + selectedRoleText + ' </b>.</br>  NB:Back-end validation is also available.', type: 'error'});
			   return false;
		   }
		   
		   return true;
		   
		   
		   
	  });
	
    // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	

	
	//When Click "delete' icon to detach/delete a certain role from certain role user. Uses SWAL confirm dialogue
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	  $(document).on("click", '.detach-role', function(e) {   // this  click  is  used  to   react  to  newly generated cicles;
		e.preventDefault(); //prevent submit form
		var form = $(this).parents('form'); //gets this current form //FIX
		
		var classNumber = $('.detach-role').index(this); //index of clicked class .detach-role, e.g 0
		
		var userName = this.getAttribute("data-uName"); //gets user name u want detach a role. Set in html by adding to button data-uName="{{$a->name}}". Set in \App\Http\MyHelpers\Rbac\Helper_Rbac::displayUserRoles($a, true)
        var roleName = this.getAttribute("data-uRole"); //gets role name u want to detach. Set in html by adding to button data-uRole="{{$a->name}}" 

        swal({html:true, title:'Attention!', text:'User </br>  NB:Back-end validation is also available.', type: 'error'});


		swal({
			    html:true,
                title: "Are you sure to detach role <i>{" + roleName + "}</i> from user <i> " + userName + " </i>?",
                text: "Role will be detached from this user!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, go ahead!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
                closeOnCancel: false
           },
           function(isConfirm){
               if (isConfirm){
			       	swal({ html:true, title:'Attention!', text:'Deleting <b>here</b>....</br>  ', type: 'error'});
                    //$(this).unbind('submit').submit();
					//$(".detach-role").get(0).allowDefault = true;
					//e.trigger('click');
					 //$("form:not('#press')").submit()
					 form.submit(); //$(".detach").eq(classNumber).submit();
					 return true; 
	
                
				
               } else {
                   swal("Cancelled", "You cancelled deleting.", "error");
                   //e.preventDefault();
				   return false;
               }
            });	     
	 
	 	   
	  });
	
    // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	 
	 
	
});
// end ready	
	
	
}()); //END IIFE (Immediately Invoked Function Expression)