<?php
//shows my profile (a profile of currently logged user)
?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Your profile</div>

                <div class="panel-body">
                  
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
					
					<i class="fa fa-address-card-o" style="font-size:48px; padding:0.1em; margin:0.1em 0em;"></i>


                   <div class="panel panel-default">
			          <div class="panel-heading">ID:   {{ $id}}</div>
                      <div class="panel-heading">Name: {{ $name}}</div>
				      <div class="panel-heading">Email: {{ $email}}</div>
				      <div class="panel-heading"> You have <b> {{$yourArticles->count()}} </b>  {{($yourArticles->count() > 1 || $yourArticles->count() == 0 ) ? 'articles' : 'article'}} </div>
			       </div>
					{{-- Auth::user()->name --}} <!-- works, return user's name -->
					
                </div>
				
				
				
				<!-- Display all your articles in Botstrap collapsible accordition -->
				<div class="col-sm-12 col-xs-12 all-your-articles">
				    
				    @if ($yourArticles->count() > 0 )
						<h4></br> List of your articles <i class="fa fa-cogs" style="font-size:24px"></i> <h4>
			            
						<!-- here goes Botstrap collapsible accordition itself -->
						<div class="panel-group" id="accordionMy">
						@foreach ($yourArticles as $a)
				            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h6 class="">
                                        <a data-toggle="collapse" data-parent="#accordionMy" href="#collapsedArticle{{$loop->iteration}}"> <!-- generetes unique id, i.e id="collapsedArticle + $i". If same id, accordition crashes -->
                                           <p> Article number {{ $loop->iteration }} : {{ $a->wpBlog_title  }} </p>
										</a>
                                    </h6>
                                </div>
								<!-- hidden/collapsed content -->
                                <div id="collapsedArticle{{$loop->iteration}}" class="panel-collapse collapse"> <!-- generetes unique id, i.e id="collapsedArticle + $i" -->
                                    <div class="panel-body">
									<p class='small'> {{ $a->wpBlog_text   }} <p>
									<p class='small font-italic'>Author:   {{ $a->authorName->name  }}   {{-- $a->authorName['name']   --}}</p> <!-- hasOne relations to show author name --> <!--  " $a->wpBlog_author" returns id, "authorName()" is a model hasOne function    }}</p> -->
									<p class='small font-italic'>Category: {{ $a->categoryNames->wpCategory_name }}</p> <!-- hasMany relations to show category name, "$a->wpBlog_category" returns id of category, "categoryNames" is a model hasMany function  -->
									<p class='small font-italic'>Status:   {{ $a->getIfPublished($a->wpBlog_status)    }}</p>   <!-- $a->wpBlog_status is DB value Enum (0/1) -->
									</div>
									<!-- End hidden/collapsed content -->
                                </div>
                            </div>
                        @endforeach
                    @endif
				    </div> <!-- End here goes Botstrap collapsible accordition itself -->
				</div><!-- .all-your-articles -->
				<!-- End Display all your articles in Botstrap collapsible accordition  -->
				
				
				
				
				<!-- Displays List of current logged user's rbac roles. Uses Helper method displayUserRoles($a)  -->
				<div class="col-sm-12 col-xs-12 all-your-roles">
				  <div class="panel panel-default">
                    <div class="panel-heading"> Your RBAC roles: </div>
	                <div class="panel-heading">{!! \App\Http\MyHelpers\Rbac\Helper_Rbac::displayUserRoles($user, false) !!}<hr><!-- hr is a fix --></div>
                  </div>
				</div> <!-- . all-your-roles -->
				
				
				
				<!--<div style="height:40px;"></div>-->
            </div>
        </div>
    </div>
</div>
@endsection
