@extends('layouts.app')


@section('page-script')
    	
@stop
	
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Test Rest</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
					
					
					<!---- DropDown seelect -->
					<div class="form-group">
					       </form>
                                   <select id="category_select" name="category_sel" class="mdb-select md-form">
						              <option  disabled="disabled"  selected="selected">Choose article</option>
		                              @foreach ($articles as $a)
									      <option value={{ $a->wpBlog_id }} > {{ $a->wpBlog_id}} </option>
					                  @endforeach
						            </select>
									 <button type="submit" id="showOne" class="btn btn-primary">Show</button>
								
                             </form>	
                     </div>
					 <!---- DropDown seelect -->
					 
					 
					 
					 <!---- Rest Api response, html() by ajax -->
					 <div class="col-sm-12 col-xs-12" id="result">
					     Response
					 </div>

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

