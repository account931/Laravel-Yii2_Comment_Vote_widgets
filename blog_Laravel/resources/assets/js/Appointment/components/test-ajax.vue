<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
				
                    <div class="panel-heading pointer" v-on:click="changeEntry()">Test Ajax Component</div>

                    <div class="panel-body" :class="cssState? ' text-primary bg-danger' : ''"> <!-- change css based on props -->
                        I'm a Vue Appointment </br>
						{{ myStateTextX }}
                    </div>
					
					<!-- Iterate over Object (Object that is from data, i.e equivalent of React State) {{ value }}-->
					<div class="panel-body">
					    <p>Info</p>
				        <div v-for="(value, name) in info">
                            {{ name }}: {{ value.wpBlog_id }} {{ value.wpBlog_title }} 
                        </div>
					</div>
					<!-- End Iterate over Object (Object that is from data, i.e equivalent of React State) -->
					
					
                </div>
            </div>
        </div>
    </div>
</template>





<script>
    export default {
	    
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
            console.log('Component mounted.')
			
			var thisXCursor = this; //mega fix
			
			
			//gets url route for ajax
			var loc = window.location.pathname;
            var dir = loc.substring(0, loc.lastIndexOf('/'));  ///laravel+Yii2_widgets/blog_Laravel/public    
            var urlX = dir + '/api/articles';
	   
	   
			
			 //variant 1, working (Promise variant)
			 $.get(urlX) 
			 .then(function(dataZ) {  // добавляем обработчик при удачном выполнении запроса
			    console.log( 'Ajax 1 is OK' );
	            console.log( dataZ ); // выводим в консоль текстовую информацию
				thisXCursor.info = dataZ; //works
				
				//works, adds new values to Object info{}. Just for testing
				thisXCursor.info = Object.assign({}, thisXCursor.info, {
                   newProperty1: 'myNewValue',
                   newProperty2: 9311
                });
				console.log('Main');
				console.log(thisXCursor.info);
	        })
			.catch(err => alert("Ajax var 1 send failed =>  " + err)); // catch any error
			
			
			
			
			 
			 //variant 2, Working (JQ ajax variant)
			 $.ajax({
               url:  urlX,
               type: 'GET',
			   dataType: 'JSON',
			   
			    success: function(data) {
				    //alert('OK');
					//console.log(data);
                },  //end success
				
			    error: function (error) {
                    alert('failed variant 2');
                }	
			})
			.then(function(dataZ) {  // добавляем обработчик при удачном выполнении запроса
			    console.log( 'Ajax is OK 2' );
	            console.log( dataZ ); // выводим в консоль текстовую информацию
				
	        })
			.then(function(dataZ) {  
			    console.log( 'Ajax is OK 3' );
				//var app = this;
	            //thisXCursor.info = dataZ;
				console.log(thisXCursor.info);
				//thisXCursor.info = dataZ; //works
	        });
			//.then(response => (this.info = response))
			//.then(var app = this console.log(this.info) );
			
			 
			
			/*axios
             .get('https://api.coindesk.com/v1/bpi/currentprice.json')
             .then(response => (this.info = response));*/
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
			}
		}
                    
    }
</script>
