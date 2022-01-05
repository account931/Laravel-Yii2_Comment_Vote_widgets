<?php
//https://medium.com/js-dojo/build-a-simple-blog-with-multiple-image-upload-using-laravel-vue-5517de920796
?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
			
			
			    <!-- Flash message -->
				@if(session()->has('flashMessage'))
                    <div class="alert alert-danger">
                        {{ session()->get('flashMessage') }}
                    </div>
                @endif
						
						
						
                <div class="panel-heading text-warning borderX" style="border:1px solid black;">
				    <p>
					    <img class="vue-logo" src="{{URL::to("/")}}/images/vue.png"  alt="a"/>
				        <button style="font-size:24px">Wpress <i class="fa fa-book"></i></button>
					</p>
				    WpBlog with Images on Vue.js framework + Vuex Store <span class="small text-danger">(It is a Vue.js version of Wpress Images (blog article with one or more images). 
					Images are LightBox-ed. This WpRess Vue.js Blog uses 3-table DB (same as Wpress Image Blog). Pagination is set by $_GET['page'], i.e if there is NO $_GET['page'] in URL, it displays first n articles)</span> 
				</div>

                <div class="panel-body">
				    
					
					<p><a href="{{ route('createNewWpressImg') }}"><button class="btn btn-large btn-success">Create new</button></a></p>
				
				    <div class="alert alert-success borderX">
				        This WpBlog_Vue is done only up to 60% only. If want to see full code of WpBlog_Vue => go to <b> Laravel_Vue_Blog_V6_Passport</b>
				    </div>

					<!-- Not used, reassigned to Vue component -->
                    <div class="alert alert-info borderX">
					    Aricles found: {{-- $countArticles->count() --}}
					</div>
					
					<!--<img class="img-responsive " src="{{URL::to('/')}}/images/error.png"  alt=""/>--> <!-- image -->
					
					
					
					
					
					
					<!-- Display pagination (only if NO $_GET, i.e display all articles) -->
					@if(!isset($_GET['category']))
					    {{-- $articles->links() --}}
					@endif
					
				    <!-- End Display WP Blogs with Blade (variant 1) -->

					
					
				 
		           
				   
		          </div>
				 </div>
				 
				 
				 
				 
					
				<!----------- Vue.js Components + VUEX Store + VUE ROUTER ------------>	 
				<div class="col-sm-12 col-xs-12" >

					
					<!-- Vue route menu -->
					<div  id="vue-menu" class="col-sm-12 col-xs-12"> <!--  id="vue-menu" --> 
					    <h3><b>Menu with Vue-Router</b></h3>
					    <vue-router-menu-with-link-content-display/> <!-- My Vue component with Menu Links -->
                    </div>
					
					<!-- Show blogs quantity component -->
					<div id="quant" class="col-sm-12 col-xs-12">
					    <h3><b>Blog articles on Vue<b></h3>
					    <show-quantity-of-posts/> <!-- Vue component -->
                    </div>
					
					<!-- Form component -->
                    <div id="createPost" class="col-md-6">
                        <create-post/> <!-- Vue component -->
                    </div>
					
					<!-- Show all posts component -->
                    <div id="app2" class="col-md-6 posts-container" style="height: 45em; overflow-y: scroll">
                        <all-posts /> <!-- Vue component -->
                    </div>
                </div>		
				<!----------- Vue.js Componenet + VUEX ------------>	 		
					
					
					
					
               
            </div>
        </div>
    </div>
</div>


<!--------- Loader (for ajax, hidden by default) ----------------->
<div class="loader-x">
    <img src="{{URL::to("/")}}/images/loader-black.gif"  alt="a"/>
</div>
<!--------- Loader (for ajax, hidden by default)  ----------------->


@endsection
