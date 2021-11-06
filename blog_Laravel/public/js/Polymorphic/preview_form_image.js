//used both in \views\polymorphic\edit-product.blade.php + \views\polymorphic\create-new-product.blade. Injected directly in these views.

(function(){ //START IIFE (Immediately Invoked Function Expression)
$(document).ready(function(){
	
	//Show preview of an image before it is uploaded (when u select image in <input type="file">). Images are appended to $('#previewDiv')
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     **  
	$(document).on("change", '.my-img-input-x', function(event) {   // this click is used to react to newly generated cicles;
          readURL(this, event);
    });
	 
	 
	 
	 function readURL(input, event) { 
	    //alert(input.files[0]);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function(e) {

			    //$('#imagePreview').html("<img src='" + e.target.result + "' class='small-img' alt='' />");
			    //$('#imagePreview').append("<img src='" + e.target.result + "' class='preview-x' alt='' />");
				
				//html with animation
				$("#imagePreview").stop().fadeOut( 200 ,function(){
					$('#imagePreview').html("<img src='" + e.target.result + "' class='small-img' alt='' />");
				}).fadeIn(2000);

			
			    /*
			    //if users has prev selected the 1st <input type="file"> and then wants to change it, remove the 1st old image
			    if (event.target.id == "imgPrimary" && $('#previewDiv img').length > 1) { 
			        $('#previewDiv img').first().remove();  //remove first added image  
				    //prepend to the beginning of $('#previewDiv') new image
				    $('#previewDiv').prepend("<img src='" + e.target.result + "' class='preview-x' alt='' />");
			       //if user selects 1st image(for the first time) or 2nd, 3rd, 4th etc images
			    } else {
			          //append to the end of $('#previewDiv') new image
			          $('#previewDiv').append("<img src='" + e.target.result + "' class='preview-x' alt='' />");
			    }
			    */
			 
            }
    
        reader.readAsDataURL(input.files[0]); // convert to base64 string. Is a must
  }
}
	
	

	
});// end ready			
}()); //END IIFE (Immediately Invoked Function Expression)
	