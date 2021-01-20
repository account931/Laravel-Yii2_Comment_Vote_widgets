<template>
    <div class="col-sm-12 col-xs-12 rooms">
        <h4>Hello from /subcomponents/room-in-loops. <br>Rooms are build with component iteration and by ajax load from Db table {appoint-room-list}  </h4>
		
		<!-- iterate over array creating components <one-room/> according to length of this.companies array -->
        <one-room  @clicked="onClickChild" v-for="(item, index) in roomsX" :key="index" :itemZ="item"  /> <!-- sendin props-->
        <!-- iterate over array -->
		
		
		<selectedRoom :clickedX="this.idClicked" :hostname="typeof(this.idClicked)=== 'string' ? 'No select so far' : this.roomsX[this.idClicked].r_host_name "/>
		
		
	   	<div id="cc"></div>
		
		<!-- testing this data.roomsX-->
		<div v-for="(value, name) in roomsX" class="col-sm-12 col-xs-12">
            {{ value.r_host_name }} {{ value.r_address }} 
        </div>
		
		
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
			    roomsX: [], //to contain ajax results from api/rooms
                companies: [1,2,3,4,5,6,7,8,9], //was used just for testing in v-for
				idClicked: "nothing selected",
				
				
				/*myStateTextX: "I am an appoint state",
				cssState: false,
				info: {}, */
            }
        },
		
		//---------------------------
        mounted() {
		
		   
		
		    //getting Rest data with rooms
		    console.log('Component mounted Rooms.')
			
			var self = this; //mega fix
			
			
			//gets url route for ajax
			var loc = window.location.pathname;
            var dir = loc.substring(0, loc.lastIndexOf('/'));  ///laravel+Yii2_widgets/blog_Laravel/public    
            var urlX = dir + '/api/rooms';
	   
	   
			
			 //working ajax variant (Promise variant)
			 //$.get(urlX) 
			 
			 $.get(urlX, {
                method: 'get',
                headers: { 'Content-Type': 'application/json' },
              })
			 .then(function(dataZ) {  // 
			    console.log( 'Ajax Rooms is OK' );
	            console.log( dataZ ); // 
				self.roomsX = dataZ; //works
				

				console.log(self.roomsX);
	        })
			.catch(err => alert("Ajax Rooms Loading failed =>  " + err)); // catch any error
			
			
            
        },
		//---------------------------
		
		created: function() {
           
        },
		
		
		
		//method/functions
		methods: {
            changeEntry() {
			},
		
		//uplifted to parent from child
		onClickChild (value) { 
          console.log(value) // someValue
		  this.idClicked = parseInt(value);
		  
		
        }
	
		}
                    
    }
</script>
