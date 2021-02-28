(function(){ //START IIFE (Immediately Invoked Function Expression)

$(document).ready(function(){
	
	
	// Init snow fall //scrips are attached in view/layout/app.php
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	    setTimeout(function (argument) {
           $(document).snowfall({
			   //image :"images/flake.png",
			   flakeCount : 100, 
			   minSize:1, maxSize:7, 
			   round: true, 
			   flakeColor: "blue", 
			   //maxSpeed, minSpeed
			}); 
	       
        }, 800);                                                           
	//                                                                                     **
    // **************************************************************************************
    // **************************************************************************************	 
	
	
	//stop snow
	$("#clear").click(function(){
        $(document).snowfall('clear'); // How you clear
    });
     
    //snow with white color	 
    $("#round").click(function(){
        document.body.className  = "darkBg";
        $(document).snowfall('clear');
        $(document).snowfall({round : true, minSize: 5, maxSize:8}); // add rounded
    });
	
	
	
	//snow ad by default	 
    $("#snowDef").click(function(){
        $(document).snowfall('clear');
        $(document).snowfall({flakeCount : 100,  minSize:1, maxSize:7, round: true, flakeColor: "blue", }); // add rounded
    });
	
	
});
// end ready	
	
	
}()); //END IIFE (Immediately Invoked Function Expression)