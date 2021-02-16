@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-xs-12 col-md-8 col-md-offset-2  panel panel-default"> 
            <div class="panel-heading">Edit your WpBlog  <img class="img-responsive my-cph" src="{{URL::to("/")}}/images/edit.png"  alt="a"/></div>
			    <p><a href="{{ route('wpblog') }}"><button>Back to blogs</button></a></p>
				
				
				
				
				    <!------------------------------- FORM ----------------------------------->
					
					<div class="col-sm-12 col-xs-12">
					    
					    
						<!-- Display errors var 1 -->
				        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div><br />
                        @endif
						
						
						
						
						<!-- Display errors var 2 -->
						<!--@if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                 </ul>
                            </div>
                        @endif-->
                        <!-- Display errors var 2 -->

						
						<!-- Flash message -->
						@if(session()->has('success'))
                            <div class="alert alert-success">
                           {{ session()->get('success') }}
                            </div>
                        @endif
						
                        <div class="row">
						<?php $thisID = $articleOne[0]->wpBlog_id; ?>
				
                            <form method="post" action='{{ url("/update/$thisID" ) }}'>
							{{-- Form::open(array('url' => 'storeNewWpress')) --}}

							
                                <div class="form-group">
                                    <input type="hidden" value="{{csrf_token()}}" name="_token" />

                                    <label for="title">Article Title:</label>
                                    <input type="text" class="form-control" name="title" value="{{old('title', $articleOne[0]->wpBlog_title)}}"/>
                                </div>
								
                                <div class="form-group">
                                   <label for="description">Article Text:</label>
                                   <textarea cols="5" rows="5" class="form-control" name="description">{{old('description', $articleOne[0]->wpBlog_text)}}</textarea>
                                </div>
								
								<div class="form-group">
                                   <select name="category_sel" class="mdb-select md-form">
						              <option  disabled="disabled"  selected="selected">Choose category</option>
		                              @foreach ($categories as $a)
									      @php
								          //gets to know what select <option> to make selected 
			                              if( $a->wpCategory_id == $articleOne[0]->wpBlog_category){
				                            $selectStatus = 'selected="selected"';
			                              } else {
					                        $selectStatus = '';
								          }
									       //$a->wpCategory_id
								          @endphp
									 
									      <option value={{ $a->wpCategory_id }} {{$selectStatus }} > {{ $a->wpCategory_name}} </option>
					                  @endforeach
						            </select>
								
                                </div>
								
                                <button type="submit" class="btn btn-primary">Update</button>
								{{-- Form::close() --}}
                             </form>
							 </br>
                    </div>
					
					<!------------------------------- END FORM ----------------------------------->

					 
					
					
					
					
					
					
					
                    </div>
            </div>
	</div>
</div>

@endsection
