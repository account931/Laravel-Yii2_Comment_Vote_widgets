<template>
    <div class="col-sm-12 col-xs-12 rooms">
        <h4>Hello from /subcomponents/room-in-loops. Rooms are build with component iteration  </h4>
		
		<!-- iterate over array creating components <one-room/> according to length of this.companies array -->
        <one-room  @clicked="onClickChild" v-for="(item, index) in companies" :key="index" :itemZ="item"  /> <!-- sendin props-->
        <!-- iterate over array -->
		
		
		<selectedRoom :clickedX="this.idClicked"/>
	   	<div id="cc"></div>
	</div>
</template>





<script>
     //using other sub-component 
     import oneRoom from './one-room.vue';
	 import selRoom from './selected-room.vue';
	
    export default {
	    //using other sub-component 
	    components: {
          'one-room': oneRoom,
		  'selectedRoom': selRoom 
       },
	   
		//i.e props
		data: function () {
            return {
                companies: [1,2,3,4,5,6,7,8,9],
				idClicked: "some default value",
				
				/*myStateTextX: "I am an appoint state",
				cssState: false,
				info: {}, */
            }
        },
		
        mounted() {
            
        },
		
		created: function() {
           
        },
		
		
		
		//method/functions
		methods: {
            changeEntry() {
			},
		
		//uplifted to parent from child
		onClickChild (value) { 
          console.log(value) // someValue
		  this.idClicked = value;
		  
		
        }
	
		}
                    
    }
</script>
