<template>
    
		<div class='col-sm-12 col-xs-12 shadowX' >
		<center><div class='shadowX'>
		    You selected 
			<a href="#">  
			    <p id="selectedRoom"> Room {{  this.clickedX }}  </p> <br>
			</a>
		</div> </center>
		</div>
                   
				   
	
</template>





<script>
    
	
    export default {
		props: ['clickedX',], //passed as props from parent <rooms-in-loop/>
		
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
			
		
		}
                    
    }
</script>
