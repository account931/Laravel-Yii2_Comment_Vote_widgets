@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
				   Form Example. Very minor exmaple. 
				   For real major one, look at <a href="https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/app/Http/Controllers/WpBlog.php"> look here => </a>
				   /app/Http/Controllers/WpBlog.php => function create() + function store(Request $request) || function edit($id) 
                </div>

                <div class="panel-body">
				
                    <div class="alert alert-success">
                        Example
					</div>
					
					<!--<img class="img-responsive " src="{{URL::to('/')}}/images/error.png"  alt=""/>--> <!-- image -->
					
					
					
					
					<!-- Display Form validate errors if any -->
					@if (count($errors) > 0)
                        <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                             <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                        </div>
                    @endif
					<!-- END Display Form validate errors if any -->

										
					
					<!-- Form -->
					{{-- Form::open(array('url' => 'foo/bar', 'method' => 'post)) --}}
					{{-- Form::text('username') --}}
					{{-- Form::submit('Click Me!') --}} 
                    {{-- Form::close() --}}
					
					
					
					
					<!--------------------------  FORM 1----------------------->
                    <center><h2>Form 1 </h2></center>
					<form class="form-horizontal" method="GET" action="">
	                   <input type="text" name="text">
	                   <input type="submit">
                    </form>
                    <!--------------------------  END FORM 1 ----------------------->

					
					
					
					
					
					
					
					<!--------------------------  FORM 2 ----------------------->
					<div class="col-sm-12 col-xs-12">
					<hr>
					<center><h2>Form 2 </h2></center>
					 <form class="form-horizontal" method="POST" action="">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" >

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" >

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
					</div>
					<!--------------------------  END FORM 2 ----------------------->

					
					
					
					
					
					
					
					 
					
					
					
					
					
					
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
