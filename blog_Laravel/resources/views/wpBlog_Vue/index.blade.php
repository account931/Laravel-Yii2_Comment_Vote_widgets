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
				 
				 
				 
				 
					
				<!----------- Vue.js VUEX ------------>	 
				<div class="row" >
				    <p> Vue </p>
					
                    <div id="createPost" class="col-md-6">
                        <create-post/> 
                    </div>
					
                    <div id="app2" class="col-md-6 posts-container" style="height: 35rem; overflow-y: scroll">
                        <all-posts />
                    </div>
                </div>		
				<!----------- End Vue.js VUEX ------------>	 		
					
					
					
					
               
            </div>
        </div>
    </div>
</div>
@endsection
