<!-- Display captcha set -->

<template>
	<div class="blog">
		<h1>{{title}}</h1>
		
			
		<p> You have to find all <b> {{ this.$store.state.checkCategory }} </b> </p>
		<p> There are {{ this.$store.state.checkCategoryLength }} of them </p>
		<p> CSS swicth is  {{ this.isCaptchaClicked }} </p> <!-- delete -->
		<p>You selected img ->  {{ this.captchaValuesArr }} </p> <!-- delete -->
		
		
		
		
		<!-- Display 9 captcha images ------> <!-- :class="isCaptchaClicked ? ' captcha-clicked' : ' no' " -->
		<div class="row">
		    <div v-for="(captcha, i) in this.$store.state.randomNine" :key=i class="col-sm-4 col-xs-4 captcha-img">      <!-- or this.$store.state.randomNine --> 
			    <center>
				     <!-- captcha image -->
					<img v-if="captcha.length" :src="`images/Captcha_2022/${captcha}`"  
					    class="img-responsive my-cph" :class="isCaptchaClicked ? ' captcha-clicked' : ' no' "
					    @error="imageUrlAlt"
                        @click="selected = i"						
					    v-on:click="userClicksCaptcha(i, captcha)" alt="a"/>     <!-- @error - is a method to run if image url is invalid or broken or image physically not available in folder -->

                    <i class="fa fa-check watermark" style="font-size:44px; color:black;"></i>	 <!-- watermark check -->								
			    </center>
		    </div>
		</div>
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
				captchaValuesArr: [],   // array to store selected all captcha values;
				selected: undefined,
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
            
			
            //set currentPost for viewing one article
            userClicksCaptcha(postIndex) {
			    
                const captchaSelected = this.$store.state.randomNine[postIndex]; //gets the scr of clicked image
				//alert(postIndex + " " + captchaSelected);
                //this.currentPost = post;
                //this.postDialogVisible = true;
				
				
				//event.target.classList.toggle('isCaptchaClicked');
				
				if(this.isCaptchaClicked){
				    //remove from array
                    let position = this.captchaValuesArr.indexOf(captchaSelected); //alert(position);// search  the  index of  specified  value
				    this.captchaValuesArr.splice(position, 1);// erase  the  last added  array  element     
				} else { 
				    // add to array
				    this.captchaValuesArr.push(captchaSelected);
					
				   
				}
				
				this.isCaptchaClicked = !this.isCaptchaClicked; //switch state to change class
            },			
    			
		},
		 
		 
	}
</script>


<style scoped>
	
</style>