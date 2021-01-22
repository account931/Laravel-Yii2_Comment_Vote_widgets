<!-- Contains <OneRoomX component in loop based on ajax + selected room component + loader +  Calendar ajax response component --> 
<template>
    <div class="col-sm-12 col-xs-12 rooms">
        <h3>Hello from /subcomponents/room-in-loops. <br>Rooms are build with component iteration and by ajax load from Db table {appoint-room-list}  </h3>
		<hr>
		
		
		<!-- iterate over array creating components <one-room/> according to length of this.companies array -->
        <OneRoomX  @clickedChild="onClickChild" @passCalendarAjax="calendarGet" v-for="(item, index) in roomsX" :key="index" :itemZ="item"  /> <!-- sendin props-->
        <!-- iterate over array -->
		
		<!-- Selected room appearance -->
		<selectedRoom :clickedX="this.idClicked" :hostname="typeof(this.idClicked)=== 'string' ? 'No select so far' : this.roomsX[this.idClicked-1].r_host_name "/>
		
		
		
		
		<!-- testing ITERATION FOR this data.roomsX-->
		<!--
		<div v-for="(value, name) in roomsX" class="col-sm-12 col-xs-12">
            {{ value.r_host_name }} {{ value.r_address }} 
        </div> 
		-->
		
		
		<!-- Loader -->
		<div id="loaderX" class='col-sm-12 col-xs-12'>
		</div>
			
		
		<!-- Calendar ajax goes here -->
		<div class='col-sm-12 col-xs-12 calendar'>
		   {{ this.calendarData}}
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
          'OneRoomX': oneRoom,
		  'selectedRoom': selRoom 
       },
	   
		//i.e props
		data: function () {
            return {
			    roomsX: [], //to contain ajax results from api/rooms
                companies: [1,2,3,4,5,6,7,8,9], //was used just for testing in v-for
				idClicked: "nothing selected",
				calendarData : ' Calendar ajax data goes here',
				
				
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
		
		//get uplifted value from child to this parent component
		onClickChild (value) { 
            console.log(value) // someValue
		    this.idClicked = parseInt(value); 
        },
		
		//get uplifted value from child to this parent component
		calendarGet(value){
		   this.calendarData = value;
		},
		
		

	
		}
                    
    }
</script>
