<!-- Display captcha set -->

<template>
	<div class="blog">
		<h3>{{title}}</h3>
		
			{{this.$store.state.randomNine}}
		<p> You have to find all <b> {{ this.$store.state.checkCategory }} </b> </p>
		<p> There are {{ this.$store.state.checkCategoryLength }} of them </p>
		<p> 
		  CSS swicth is  {{ this.isCaptchaClicked }}  <!-- delete -->
		  You selected img ->  {{ this.captchaValuesArr }} {{ this.captchaValuesArr.length }} 
		</p> <!-- delete -->
		
		
		
		
		<!-- Display 9 captcha images ------> 
		<transition name="bounce">  <!--- Animation wrapper, var 1 name="fade" ------>
		<div v-if="this.$store.state.show" class="col-sm-8 col-xs-12" id="captchaSet"> <!-- state.show is state to trigger animation -->
		
		    <div v-for="(captcha, i) in this.$store.state.randomNine" :key=i class="col-sm-4 col-xs-4 captcha-img">      <!-- this.$store.state.randomNine = ["Cars/car1.jpeg", "Boats/boat3.jpeg" ] ] -->   <!-- or this.$store.state.randomNine --> 
			    <center>
				
				    <!-- captcha images in loop.  1st variant of CSS switch class, works if only one item only  :class="isCaptchaClicked ? ' captcha-clicked' : ' no' "   2nd variant  :class="{ captcha_clicked : active_el == captcha.id }" -->
					<img v-if="captcha.length" :src="`images/Captcha_2022/${captcha}`"  v-bind:id="i"
					    class="img-responsive my-cph"   
					    @error="imageUrlAlt"	
					    v-on:click="userClicksCaptcha(i, captcha)" alt="a"/>     <!-- @error - is a method to run if image url is invalid or broken or image physically not available in folder -->
                        <!-- captcha is an image, i.e  "Cars/car2.jpeg" -->
							
                    <i class="fa fa-check watermark"  style="font-size:44px; color:black;"></i>	 <!-- watermark check -->								
			    </center>
		    </div>
			
			<!-- Button to send ajax captcha check (at back-end)--> 
			<button v-on:click="sendAjaxCaptchaCheck" class="btn btn-success"> Send me </button>
			
		</div>
		</transition>
		<!-- End Display 9 captcha images -->
		
		
		
	</div>
	
</template>




<script>
	export default{
		name:'Captcha',
		data (){
			return{
				title:'Captcha ',
				isCaptchaClicked: false, //CSS flag
				captchaValuesArr: [],   // array to store all captcha images selected by the user (+ is sent to back-end for checking);
				selected: undefined,
				active_el:undefined,
				 
			}
		},
		
		computed: {
		    checkCSS() {
			   return this.isCaptchaClicked;
			},
		},
		
		 //before mount
        beforeMount() {
		    this.$store.dispatch('getCaptchaSet'); //trigger ajax function getCaptchaSet(), which is executed in Vuex store to REST Endpoint => /public/post/get_all	
			
		},
		
		mounted(){ 
		    //Scroll to results in Mobile only (use with delay or it won't see the DOM)
		    //if(screen.width <= 640){ 
			    var that = this;
			    const myTimeout = setTimeout(function(){ that.scrollResults("#captchaSet"); }, 3000);;	
		    //}
		},
		
		
		
		
		
		methods: {
		    
            /*
            |--------------------------------------------------------------------------
            | If image url is invalid or broken or image physically not available in folder, then use 'images/image-corrupted.jpg"
            |--------------------------------------------------------------------------
            |
            |
            */
		    imageUrlAlt(event) {
                event.target.src = "images/image-corrupted.jpg"
            },
            
			
            
			/*
            |--------------------------------------------------------------------------
            | If user clicks/select any captcha image, set CSS and add this image to temp array
            |--------------------------------------------------------------------------
            |
            |
            */
            userClicksCaptcha(postIndex, selectedCaptchaImage) { //postIndex is i
			   
                const captchaSelected = this.$store.state.randomNine[postIndex]; //gets the scr of clicked image
				//alert(postIndex + " " + captchaSelected);
                //this.currentPost = post;
                //this.postDialogVisible = true;
				console.log(selectedCaptchaImage); //returns image, e.g  "Cars/car2.jpeg"}
				//alert(selectedCaptchaImage); //e.g "Cars/car2.jpeg"
				console.log(event.target);    //returns <img src="images/Captcha_2022/Cars/car4.jpg" alt="" class="img-responsive my-cph  captcha-clicked"/>    //event.target.classList.toggle('isCaptchaClicked');
				console.log(event.target.id); //get the id of clicked img
				
				//this.active_el = event.target.id; //event.target.id == id of clicked img //NOT USED, ok to select only 1 elem, not several
				
				
				
				event.target.classList.toggle('captcha-clicked'); //switch on/off class='captcha-clicked', while on - image is selcted
				
				event.target.nextElementSibling.classList.toggle('watermark_visible');   //toggle on/off class="watermark_visible" for next sibling (i.e watermark), while on - watermark is hidden
				event.target.nextElementSibling.classList.toggle('watermark');           //toggle on/off class="watermark"  for next sibling (i.e watermark), while on - watermark is visble
				
				
				if(!event.target.classList.contains('captcha-clicked')){ //if(this.isCaptchaClicked){
				    //remove selected image from array
                    let position = this.captchaValuesArr.indexOf(captchaSelected); //alert(position);// search  the  index of  specified  value
					if(position == -1){
					    swal("Error happened", "Something crashed, reload the page", "error");
					}
				    this.captchaValuesArr.splice(position, 1);// erase  the  last added  array  element     
				} else { 
				    // add selected image to array (to be sent via ajax for back-end check)
				    this.captchaValuesArr.push(captchaSelected);
					
				   
				}
				
				//this.isCaptchaClicked = !this.isCaptchaClicked; //switch state to change class. NOT USED!!!!!!!!
            },	

 			
    		
            /*
            |--------------------------------------------------------------------------
            | If user clicks button to send his captcha images selected for check at back-end
            |--------------------------------------------------------------------------
            |
            |
            */
            sendAjaxCaptchaCheck(){
			
			    if(this.captchaValuesArr.length <= 0){
				    swal("Nothing selected", "Select some images", "error");
					return false;
				}
				
				swal("OK", "Sending ajax", "success");
			
			
			
            }, 
			
		    /*
            |--------------------------------------------------------------------------
            | Scroll function
            |--------------------------------------------------------------------------
            |
            |
            */
			scrollResults(divName, parent){ //arg(DivID, levels to go up from DivID)
			    //alert($("#captchaSet").html());
			    //if 2nd arg is not provided while calling the function with one arg
		        if (typeof(parent)==='undefined') {
		
                     $('html, body').animate({
                     scrollTop: $(divName).offset().top
                     //scrollTop: $('.your-class').offset().top
                 }, 'slow'); 
		         // END Scroll the page to results
		        } else {
			        //if 2nd argument is provided
			        var stringX = "$(divName)" + parent + "offset().top";  //i.e constructs -> $("#divID").parent().parent().offset().top
			        $('html, body').animate({
                    scrollTop: eval(stringX)         //eval is must-have, crashes without it
                    }, 'slow'); 
		        }
	        },
			
			
		},
		 
		 
	}
</script>








<style scoped>

/* ---  Vue animation */

/*--- Animation Var 1 */
.fade-enter-active, .fade-leave-active {
  transition: opacity 6.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
  opacity: 0;
}

/*--- Animation Var 2 */	
.bounce-enter-active {
  animation: bounce-in 2.5s; /* fade in time */
}
.bounce-leave-active {
  animation: bounce-in 1.5s reverse;
}
@keyframes bounce-in {
  0%   { transform: scale(0); }
  50% { -webkit-transform : rotate(480deg) scale(0.3); /* Chrome, Opera 15+, Safari 3.1+ */  transform: rotate(490deg) scale(0.2); /* Firefox 16+, IE 10+, Opera */ }     /* transform: scale(1.5); */
  100% { transform: scale(1); }
}
/* --- End  Vue animation */

</style>