@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
			
			
			    <!-- Flash message if Success -->
				@if(session()->has('flashMessageX'))
                    <div class="alert alert-success">
                        {!! session()->get('flashMessageX') !!} <!--Displays content without html escaping -->
                    </div>
                @endif
				<!-- Flash message -->
				

                <!-- Flash message if Failed -->
				@if(session()->has('flashMessageFailX'))
                    <div class="alert alert-danger">
                        {!! session()->get('flashMessageFailX') !!} <!--Displays content without html escaping -->
                    </div>
                @endif
				<!-- Flash message if Failed -->				
				

                <!-- Display form validation errors var 2 -->
				@if (count($errors) > 0)
                    <div class="alert alert-danger">
                      <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                      </ul>
                    </div>
                @endif
                <!-- End Display form validation errors var 2 -->				
					
					
                <div class="panel-heading text-warning">My testing 2024 <span class="small text-danger">*</span> </div>

                    <div class="panel-body">
					
					Example: NB: <b>%</b> is <b>Modulus</b> not <b>devision</b>, it returns the Remainder of $x divided by $y, i.e  (5%2 = 1, 8%2=0, 1%2=0, 3%2=1, 1%2=1)</br>
					<code></br>
					$a = '1112031584'; </br>
		            $s = ''; </br>
		            for ($i = 1; $i < strlen($a); $i++){ </br>
			
			            if($a[$i] % 2 == $a[$i -1]){ </br>
				            $s.= max($a[$i], $a[$i -1]); </br>
			            } </br>
		            }</br>
					
					</code>
					Answer: $s is : {{ $s }}
				    </div>
					
				
				
					
					
					
				
            </div>
        </div>
    </div>
</div>
@endsection
