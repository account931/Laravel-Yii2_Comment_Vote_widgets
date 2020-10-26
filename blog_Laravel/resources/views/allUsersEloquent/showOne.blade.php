
@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
	
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> 
				    <p>One user profile</p>
				</div>
				
				<!-- Link to go back -->
				<div>
				    &nbsp;<i class="fa fa-hand-o-left" style="font-size:24px"></i>
				    <a href="{{ url('/EloquentExample') }}">back to users </a>
                </div>
				 
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                
                </div>
            </div>
        </div>
		
		
		
	
		
		<div class="panel panel-default">
		  <div class="panel-body ">
	
			
		    <div class="panel panel-default">
			    <div class="panel-heading">{{ $userOne[0]->id}}</div>
                <div class="panel-heading">{{ $userOne[0]->name}}</div>
				<div class="panel-heading">{{ $userOne[0]->email}}</div>
				<div class="panel-heading">User <b>{{ $userOne[0]->name}}</b> has <b> {{$userOneArticles->count()}} </b>  {{($userOneArticles->count() > 1 || $userOneArticles->count() == 0 ) ? 'articles' : 'article'}} </div>
			</div>
		   
			
		  
		  
		  <!-- Display all your articles in Botstrap collapsible accordition -->
				<div class="col-sm-12 col-xs-12 all-your-articles">
				    
				    @if ($userOneArticles->count() > 0 ) {{-- if user has articles count < 0 --}}
						<h4></br> List of <b>{{ $userOne[0]->name}}</b> articles <i class="fa fa-cogs" style="font-size:24px"></i> <h4>
			            
						<!-- here goes Botstrap collapsible accordition itself -->
						<div class="panel-group" id="accordionUserOne">
						@foreach ($userOneArticles as $a)
				            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h6 class="">
                                        <a data-toggle="collapse" data-parent="#accordionUserOne" href="#collArticle{{$loop->iteration}}"> <!-- generetes unique id, i.e id="collArticle + $i". If same id, accordition crashes -->
                                           <p> Article number {{ $loop->iteration }} : {{ $a->wpBlog_title  }} </p>
										</a>
                                    </h6>
                                </div>
								<!-- hidden/collapsed content -->
                                <div id="collArticle{{$loop->iteration}}" class="panel-collapse collapse"> <!-- generetes unique id, i.e id="collArticle + $i" -->
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
				    </div> <!-- END here goes Botstrap collapsible accordition itself -->
				</div><!-- .all-your-articles -->
				<!-- End Display all your articles in Botstrap collapsible accordition  -->
				
		        
				
				
				<!-- Displays List of selected user's rbac roles. Uses Helper method displayUserRoles($a)  -->
				<div class="col-sm-12 col-xs-12 all-your-roles">
				  <div class="panel panel-default">
                    <div class="panel-heading">User has RBAC roles:</div>
	                <div class="panel-heading">
					
					    {!! \App\Http\MyHelpers\Rbac\Helper_Rbac::displayUserRoles($userOne[0]) !!}
					</div>
                  </div>
				</div> <!-- . all-your-roles -->
				
				
				
		  </div>
		</div>
		
    </div>
</div>
@endsection
