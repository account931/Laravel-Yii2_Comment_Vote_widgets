(function(){ //START IIFE (Immediately Invoked Function Expression)

$(document).ready(function(){
	
	let captchaValuesArr = []; // array for all values;
	
	/*
    |--------------------------------------------------------------------------
    | ????
    |--------------------------------------------------------------------------
    |
    |
    */
	
	$(document).on("click", '.my-cph', function() {   // this  click  is  used  to   react  to  newly generated cicles;
	    
		
	    let selectedRoleText = this.getAttribute('src');
		const myArray = selectedRoleText.split("/");
		let imgName = myArray[myArray.length -1]; //img name
		
		if ($(this).hasClass("captcha-clicked")) {
			$(this).removeClass("captcha-clicked");
			//remove from array
			
             let position = captchaValuesArr.indexOf(imgName); //alert(position);// search  the  index of  specified  value
             captchaValuesArr.splice(position, 1);// erase  the  last added  array  element 
			
		} else {
			$(this).addClass("captcha-clicked");
			//add to array 
			captchaValuesArr.push(imgName);
		}
		
		//alert(captchaValuesArr);
        //swal({html:true, title:'Attention!', text:'You selected <b> ' + imgName + ' </b>.</br>  .', type: 'error'});
	});
	
	
});
// end ready	
	
	
}()); //END IIFE (Immediately Invoked Function Expression)