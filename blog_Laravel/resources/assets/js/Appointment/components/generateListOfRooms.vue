<template>
    
        <rooms-in-loop1></rooms-in-loop1>
    
	
</template>





<script>
    //using other sub-component 
    import roomzzzz from './subcomponents/rooms-in-loop.vue';
	
    export default {
	    //using other sub-component 
	    components: {
          'rooms-in-loop1': roomzzzz 
       },
	
		//i.e props
		data: function () {
            return {
                companies: [],
				myStateTextX: "I am an appoint state",
				cssState: false,
				info: {},
            }
        },
		
        mounted() {
            
        },
		
		
		
		
		
		//method/functions
		methods: {
            changeEntry() {
                //if (confirm("Do you really want to proceed?")) {
				
                    var app = this;
					if(app.myStateTextX != 'Appointment state'){
					    app.myStateTextX = 'Appointment state';
						app.cssState = true;
					} else {
					    app.myStateTextX = 'State is changed';
						app.cssState = false;
					}
					
				//}
			},
			
			onClickChild (value) { alert('ddddd');
          console.log(value) // someValue
        }
		}
                    
    }
</script>
