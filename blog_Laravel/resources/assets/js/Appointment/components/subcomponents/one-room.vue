<template>
    
		<div class='subfolder shadowX' v-on:click="greet" v-bind:data-id="this.itemZ" >
			<a href="#"> <img class="my-img" src="images/item.png"  alt=""/> 
			    <p> Room  {{this.itemZ}} </p> <br>   <!--passed as props from parent <rooms-in-loop/>-->
			</a>
		</div>
                   
				   
	
</template>





<script>
    
	
    export default {
	    props: ['itemZ',], //passed as props from parent </>
		
		//i.e props
		data: function () {
            return {
                /*companies: [],
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
			    alert(event.currentTarget.getAttribute('data-id'));
             
				//uplift to parent clicked ID
				this.$emit('clicked', event.currentTarget.getAttribute('data-id'));
				
				this.scrollResults("#cc");
			},
			
			scrollResults: function(divName, parent){ //arg(DivID, levels to go up from DivID)
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
	        }
	
	
		}
                    
    }
</script>
