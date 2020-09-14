@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Error happened</div>

                <div class="panel-body">
				
                    <div class="alert alert-danger">
                        Details: <b>{{ $exception->getMessage() }}</b>
					</div>
					
					<img class="img-responsive " src="{{URL::to('/')}}/images/error.png"  alt=""/> <!-- image -->

					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
