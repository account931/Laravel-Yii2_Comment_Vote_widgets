<!-- template for one room -->
<template>
    
		<div class="subfolder shadowX" v-on:click="greet($event)" v-bind:data-id="this.itemZ.r_id" :title="this.itemZ.r_host_name + this.itemZ.r_address">
			<a href="javascript:void(0)"> <img class="my-img" src="images/item.png"  alt=""/> 
			    <p> Room  {{this.itemZ.r_room}} <br> 
				<span class="small-text">{{this.itemZ.r_host_name}}</span> </p> <br>   <!--passed as props from parent <rooms-in-loop/>-->
			</a>
		</div>
                   
				   
	
</template>





<script>
    
	//import function from other external file
	import {ScrollExternalFile} from '../my_functions/scroll_function.js';  //name in {} i.e 'ScrollExternalFile' must be cooherent to name in "export const ScrollExternalFile" in '/scroll_function.js'

	
    export default {
	    props: ['itemZ',], //passed as props from parent </>
		
		//i.e props
		data: function () {
            return {
			    /* calendar: "Cal";
                companies: [],
				myStateTextX: "I am an appoint state",
				cssState: false,
				info: {}, */
            }
        },
		
        mounted() {
            
        },
		
		
		
		
		
		//method/functions
		methods: {
            changeEntry() {
			},
			
			greet: function (event) {
			    //alert(event.currentTarget.getAttribute('data-id'));
                
				
				//uplift to parent clicked ID
				var idClicked = event.currentTarget.getAttribute('data-id');
				this.$emit('clickedChild', idClicked);
				
				
				
				//show and hide loader
				$("#loaderX").show(400);
				
				 setTimeout(function() {
				     $("#loaderX").fadeOut(800);
	                 //$("#loaderX").css('opacity', '0'); 
	             }, 2000); 
				 
				 
				//Creating overlay while changing content of selected room. The one used in React Sms
				$(".child-div").css('opacity', '1'); 
				
				
				 setTimeout(function() {
	                 $(".child-div").css('opacity', '0'); //hides yellow overlay div -> react imitation of animation, analogue of $(".del-st").stop().fadeOut("slow",function(){ $(this).html(finalText) }).fadeIn(3000);
	            }, 3000);
				 
				 //alert('sends calendar ajax');
				 this.sendCalendarRequest();
				 
				 //Scroll to results in Mobile only
		         if(screen.width <= 640){ 
				     ScrollExternalFile.scrollResults(".selected-room"); //calling function from external file '/my_functions/scroll_function.js'
				 }
				 
			},
			
			
			
			
			
			//send ajax to calendar
			sendCalendarRequest: function(){
			
			    var self = this; //mega fix
				
			    //gets url route for ajax
			    var loc = window.location.pathname;
                var dir = loc.substring(0, loc.lastIndexOf('/'));  ///laravel+Yii2_widgets/blog_Laravel/public    
                var urlX = dir + '/api/getCalendar';
	   
			
			    //working ajax variant (Promise variant)
			 
			    $.get(urlX, {
                    method: 'get',
                    headers: { 'Content-Type': 'application/json' },
                })
			    .then(function(dataZ) {  // 
			        console.log( 'Ajax Rooms is OK' );
	                console.log( dataZ ); // 
				    //self.calendar = dataZ; //works
					
				    //uplift to parent ajax results
				    self.$emit('passCalendarAjax', dataZ);

	            })
			    .catch(err => alert("Ajax Calendar Loading failed =>  " + err)); // catch any error
			},
			
			
			
	
	
		}
                    
    }
</script>
