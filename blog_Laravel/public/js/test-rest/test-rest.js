  
(function(){ //START IIFE (Immediately Invoked Function Expression)


$(document).ready(function(){

//Rest Api Uses separated Rest Wpress model for table {wpress_blog_post} => /models/rest/WpressRest.php. (Model isstrictly for REST Api requests)  !!!!!!!!!
	
	
  /*
  |--------------------------------------------------------------------------
  | when user clicks "Show one Article" (by ID) button
  |--------------------------------------------------------------------------
  |
  |
  */
  //click "ShowOne" button
  $(document).on("click", '#showOne', function() {  //for newly generated 
  
  
      var id = $('#category_select').val();
	   
      if(id == null){
		  alert("not selected");
		  return false;
	  }
   
       
	  //getting the path to current folder with JS to form url for ajax, i.e /yii2_REST_and_Rbac_2019/yii-basic-app-2.0.15/basic/web/booking-cph/ajax_get_6_month
		var loc = window.location.pathname;
        var dir = loc.substring(0, loc.lastIndexOf('/'));  ///laravel+Yii2_widgets/blog_Laravel/public    //yii2_REST_and_Rbac_2019/yii-basic-app-2.0.15/basic/web/manual-auto-quiz
		//alert(dir);
		var urlX = dir + '/api/articles/'+id;
		//alert(urlX);
      
	  // send ajax onLoad to PHP handler action to get list of questions  ************ 
        $.ajax({
            url: urlX ,
            type: 'GET',
			dataType: 'JSON', // without this it returned string(that can be alerted), now it returns object
            data: { 
			    //serverCity: id
			},
            success: function(data) {
                // do something;			    
				//alert(JSON.stringify(data));
				//alert(data.questionList[0].questions);
				
				//Promise, otherwise proccessFiledset() does not see loaded by ajax new DOM elemnets. UPDATE => Promise is not necessary????
				/*constructQuestionsList(data)
				.then(
				   proccessFiledset()
                 ).then(
				   setProgressBarQ(currentQ)
				 );
				 */
				
				 //if article is found by ID
				 if (data.status == 'OK') {  //data = {'status' => 'OK', 'messageX'=> 'Article found', 'contentX'=> $wpressEloquent} 
				     var finalText = "";
				     for(var i = 0; i < data.contentX.length; i++){
					     finalText+= "<p> ID: "    + data.contentX[i].wpBlog_id    + "</p>"; 
					     finalText+= "<p> Title: " + data.contentX[i].wpBlog_title + "</p>";
					     finalText+= "<p> Text: " +  data.contentX[i].wpBlog_text  + "</p>";
					     finalText+= "<p> Author <span class='small'>(hasOne)</span>: "   +  data.contentX[i].author_name.name + "</p>";   //(while DB field name is {wpBlog_author}), author_name is model hasOne function, {name} is DB field)   //data[i].wpBlog_author is an foreign key ID
					     finalText+= "<p> Category <span class='small'>(hasMany)</span>: " + data.contentX[i].category_names.wpCategory_name  + "</p>";  //data[i].wpBlog_category is an foreign key ID

				     }
				 //if article IS NOT found by ID, e.g ID does not exist
				 } else if (data.status == 'Fail') {
					 finalText = "<p class='text-danger'>" + data.messageX + "</p>"; //e.g "ID does not exist"
				 }
			   
				 $("#result").stop().fadeOut("slow",function(){ $(this).html(finalText)}).fadeIn(2000);

				
            },  //end success
			
				
			error: function (error) {
				$("#result").stop().fadeOut("slow",function(){ $(this).html("<h4 style='color:red;padding:3em;'>ERROR!!! <br> Rest failed" + JSON.stringify(error) + "</h4>")}).fadeIn(2000);
            }	
        });
	  
      
     });
  
  
 

    // **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
   
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************

    
	
	
	
	
 /*
  |--------------------------------------------------------------------------
  | when user clicks CREATE button (REST POST)
  |--------------------------------------------------------------------------
  |
  |
  */
  //click "Create" button. TEST_2 =>  /POST  HTTP REQUEST, i.e  INSERT (create a new article) -----------------------> 

  $(document).on("click", '#createArticle', function(e) {  //for newly generated 
    e.preventDefault(); //prevent submit form
    //alert("Api saving new article must be implemented here......");
	
	
	
	//getting the path to current folder with JS to form url for ajax, i.e /yii2_REST_and_Rbac_2019/yii-basic-app-2.0.15/basic/web/booking-cph/ajax_get_6_month
	var loc = window.location.pathname;
    var dir = loc.substring(0, loc.lastIndexOf('/'));  ///laravel+Yii2_widgets/blog_Laravel/public    //yii2_REST_and_Rbac_2019/yii-basic-app-2.0.15/basic/web/manual-auto-quiz
	//alert(dir);
	var urlX = dir + '/api/articles';
	;
	
	$.ajax({
						  //url: '../web/rest',  //url if 'authenticator' => is disabled in controllers/RestController
                          
						  url: urlX, //'../web/rests?access-token=57Wpa-dlg-EonG6kB3myfsEjpo7v8R5b', //we use here url with this user access-token(from DB), it is universal, if authenticator' => is disabled, the script just won't pay attaention to this $_GET['access-token']
                          type: 'POST', //POST is to create a new user
						  //crossDomain: true,
						  contentType: "application/json; charset=utf-8",
			              //dataType: 'json', //In Laravel causes crash!!!!!// without this it returned string(that can be alerted), now it returns object
						  
						  headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                          contentType: 'application/x-www-form-urlencoded; charset=utf-8',
						   
			              //passing the data
                          data: //dataX//JSON.stringify(dataX)  ('#createNew').serialize()
						  {   //username and password_reset_token musr be UNIQUE!!!!!
			                  wpBlog_title:    $('#product-name').val(), 
							  wpBlog_text:     $('#product-desr').val(), 
							  wpBlog_category: $('#categgg option:selected').val() , //same == $('#categgg').val(), 
							  wpBlog_author: 2,  //minor conflict, anyone can save with my ID
							  wpBlog_status: 1 //wpBlog_created_at: '2020-10-04 10:54:50'
							 
			              },
                          success: function(data) {
                            // do something;
                            //alert(JSON.stringify(data, null, 4));
			                //alert(data);
							console.log(data);
							var ress =  JSON.stringify(data, null, 4);
							
							/*for (var i = 0; i < data.length; i++){
								ress+= data[i].username + "-> " + data[i].email + "<br>";
							}
							*/
							
							//if saving was OK
							if (data.status == "OK") {
								$('#product-name').val(''); //reset the fields 
								$('#product-desr').val(''); 
								$('#categgg').val('');
							    ress = "<p class='text-primary'> Saved succesfully </p>" + ress + "<hr>";
								
							//if saving crashed, e/g due to validation
							} else if (data.status == "Fail") {
								ress = "<p class='text-danger'>Saving failed. <br> " + data.messageX + "</p>"; //e.g "Validation failed"
							}
							
							$("#result").stop().fadeOut("slow", function(){ $(this).html(ress) }).fadeIn(2000);
				
                          },  //end success
			              error: function (error) {
				              $("#result").stop().fadeOut("slow",function(){ $(this).html("<h4 style='color:red;padding:3em;'>ERROR!!! <br> Rest API crashed <br><br>" + JSON.stringify(error, null, 4) + "<br>" + error.responseJSON + "</h4>")}).fadeIn(2000);
                              console.log(error);
						  }	  
                     });                             
                    //END AJAXed  part 
	
   });
	
	
	
	
	
	
	
	
	
});
// end ready	
	
	
}()); //END IIFE (Immediately Invoked Function Expression)