(function(){ //START IIFE (Immediately Invoked Function Expression)

$(document).ready(function(){
	
	let captchaValuesArr = []; // array to store selected all captcha values;
	
	/*
    |--------------------------------------------------------------------------
    | If user clicks any captcha images
    |--------------------------------------------------------------------------
    |
    |
    */
	
	$(document).on("click", '.my-cph', function() {   // this  click  is  used  to   react  to  newly generated cicles;
	    
		
	    let selectedRoleText = this.getAttribute('src'); //http://localhost/laravel+Yii2_comment_widget/blog_Laravel/public/images/Captcha_2022/Turntables/turn4.jpg
		const myArray = selectedRoleText.split("/");
		let imgName = myArray[myArray.length -2] + "/" + myArray[myArray.length -1]; //folder + img name, i.e returns "Turntables/turn2.jpg"
		
		//if element is already clicked/selected, then unclick it and delete from array
		if ($(this).hasClass("captcha-clicked")) {
			$(this).removeClass("captcha-clicked");
			
			//remove from array
             let position = captchaValuesArr.indexOf(imgName); //alert(position);// search  the  index of  specified  value
             captchaValuesArr.splice(position, 1);// erase  the  last added  array  element 
			 
			//hide watermark check
			console.log($(this).next());
			$(this).next().css({"display": "none"});
		
        //if element has not been clicked, then make it clicked/selected and add to array	
		} else {
			$(this).addClass("captcha-clicked");
			//add to array 
			captchaValuesArr.push(imgName);
			
			//show watermark
			console.log($(this).next());
			$(this).next().css({"display": "block"}); //$(this).next().find('.watermark')
			
		}
		
		//alert(captchaValuesArr);
        //swal({html:true, title:'Attention!', text:'You selected <b> ' + imgName + ' </b>.</br>  .', type: 'error'});
		
		
		//Atttach captchaValuesArr to form input name="hidden-captcha-array' id='captcha-array'
		let myJSON = JSON.stringify(captchaValuesArr); 
		$('input:hidden[name=hidden-captcha-array]').val(myJSON); //this variant since the input is hidden
		//$('[name="hidden-captcha-array[]"]').val(myJSON);
		
	});
	
	
	
	/*
    |--------------------------------------------------------------------------
    | If user clicks form submit button client-side check if any captcah was selected
    |--------------------------------------------------------------------------
    |
    |
    */
	
	$(document).on("click", '#submBtn', function(e) {   // this  click  is  used  to   react  to  newly generated cicles;
	    if( $('input:hidden[name=hidden-captcha-array]').val() == "" || $('input:hidden[name=hidden-captcha-array]').val() == "[]" ){
			swal({html:true, title:'Attention!', text:'No captcha was <b> selected </b>.</br>  Back-end validation is also available.', type: 'error'});
			e.preventDefault();

		}
	});    
	
	
});
// end ready	
	
	
}()); //END IIFE (Immediately Invoked Function Expression)