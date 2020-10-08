  
(function(){ //START IIFE (Immediately Invoked Function Expression)


$(document).ready(function(){
	
	
  /*
  |--------------------------------------------------------------------------
  | when user clicks NEXT button
  |--------------------------------------------------------------------------
  |
  |
  */
  //click "Next" button
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
				 
				 var finalText = "";
				 for(var i = 0; i < data.length; i++){
					 finalText+= "<p> ID: "    + data[i].wpBlog_id    + "</p>";
					 finalText+= "<p> Title: " + data[i].wpBlog_title + "</p>";
					 finalText+= "<p> Text: " +  data[i].wpBlog_text  + "</p>";
					 finalText+= "<p> Author <span class='small'>(hasOne)</span>: "   +  data[i].author_name.name + "</p>";   //(while DB field name is {wpBlog_author}), author_name is model hasOne function, {name} is DB field)   //data[i].wpBlog_author is an foreign key ID
					 finalText+= "<p> Category <span class='small'>(hasMany)</span>: " + data[i].category_names.wpCategory_name  + "</p>";  //data[i].wpBlog_category is an foreign key ID

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




	
});
// end ready	
	
	
}()); //END IIFE (Immediately Invoked Function Expression)