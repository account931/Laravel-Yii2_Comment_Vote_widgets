
//Start Lazy Load
//Lazy Load (to use: 1.download js=> <script src="jquery.lazyload.js"></script> 2. use in html=> <img class="lazy" data-original="img/example1.jpg"; 3. use code below in js
//https://vash-webmaster.ru/2017/08/11/lazyload-js/

//<!-- Lazy load is loaded in views/app.blade.php, otherwise it wont work -->
$(function() {
	
	
	//Lame fix, must be rethinked to better variant
	//Amendmenents in order LazyLoad placeholder image path can work both on user 'shopSimple', 'shopSimple?page=2' or admin 'showOneProduct/8' routes
	//Redirects to different placeholder images path
	//we see here what is the route and determines what image path to use, when users 
	var path = window.location.href;                              //http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/admin-products
	var allPath = path.split('/');
	var currentRoute = allPath[allPath.length -1]; //returns 'admin-products' or 'shopSimple'
	//alert(currentRoute); //if route  'showOneProduct/8' returns 8, if route 'shopSimple?page=2' returns 'shopSimple?page=2'
	
	//var reg = new RegExp('^[0-9]+$'); //RegExp to  contain only ONE number.
	var regExpPattern = new RegExp('^[0-9]*$'); //RegExp to  contain only  numbers (any quantity).
		
		
	if(regExpPattern.test(currentRoute)){ // Case when the current route is 'showOneProduct/8'. In this case var currentRoute is 8. Test() must Return a boolean(true). //url when it shows one product (as result of autcomplete or click on direct URl in pop-up window)
		var placeHolderImageURL = "../images/grey.gif"
	
	} else { // Case when the current route is 'shopSimple' or 'shopSimple?page=2'. In this case var currentRoute is 'shopSimple?page=2'. Url when it shows all products main page
		var placeHolderImageURL = "images/grey.gif";  
	}
	//End Amendmenents in order one autocomplete can work both on user '/shopSimple' or admin '/admin-products' routes

	
	
	
	
	
    $("img.lazy").lazyload({
		 effect : "fadeIn", //appear effect
		 effectspeed: 200,
		 placeholder : placeHolderImageURL , //"images/grey.gif", //preloader image  
		 //LazyLoader Placeholder Does not work(image is not found) in path /blog_Laravel/public/showOneProduct/3 . Works if image path is "../images/grey.gif", but then image not found in path '/blog_Laravel/public/shopSimple'
         //threshold : 0 //content will load only on scrolling down 10px
    });
	
	//my fix. As lazy images used to load on scroll only and onload remained with placeholder, we load with delay first 4 images, rest would load on scroll
	setTimeout(function(){  
    //$("img.lazy").trigger('appear');
	  $("img.lazy:lt(4)").trigger('appear'); //show 4 first images
	}, 4000);
	
});

//End Lazy Load

//----------------------------------------------------------------

