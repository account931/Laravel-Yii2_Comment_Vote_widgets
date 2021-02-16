@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-xs-12 col-md-8 col-md-offset-2  panel panel-default"> 
            <div class="panel-heading">Create new WpBlog </div>
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
                            <form method="post" action="{{url('/storeNewWpress')}}">
							{{-- Form::open(array('url' => 'storeNewWpress')) --}}

							
                                <div class="form-group">
                                    <input type="hidden" value="{{csrf_token()}}" name="_token" />

                                    <label for="title">Article Title:</label>
                                    <input type="text" class="form-control" name="title" value="{{old('title','')}}"/>
                                </div>
								
                                <div class="form-group">
                                   <label for="description">Article Text:</label>
                                   <textarea cols="5" rows="5" class="form-control" name="description">{{old('description','')}}</textarea>
                                </div>
								
								<div class="form-group">
                                   <select name="category_sel" class="mdb-select md-form">
						              <option  disabled="disabled"  selected="selected">Choose category</option>
		                              @foreach ($categories as $a)
									      <option value={{ $a->wpCategory_id }} > {{ $a->wpCategory_name}} </option>
					                  @endforeach
						            </select>
								
                                </div>
								
                                <button type="submit" class="btn btn-primary">Create</button>
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
