<template>
    
    <div class='col-sm-12 col-xs-12 shadowX' >
	    <center>
			
		    <div class='shadowX selected-room parent-div show-div'>
			   
			    <!--overlay loader, hidden by default -->
			    <div class="child-div">  
                   <p>This should be over the parent</p>
				   <div class="loader-child"> <img src="images/loader.gif"  alt=""/>  </div>
                   				   
                </div>
			
			
		        You selected 
			    <a href="#">  
			       <p id="selectedRoom"> Room {{  this.clickedX }}  <br> {{this.hostname}} </p> <br>
			    </a>
				
		    </div> 
			
		</center>
    </div>			   
	
</template>





<script>
    
	
    export default {
		props: ['clickedX', 'hostname'], //passed as props from parent <rooms-in-loop/>
		
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
