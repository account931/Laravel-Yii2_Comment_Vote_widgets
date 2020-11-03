@extends('layouts.app')

@section('content')
<div id="all" class="container animate-bottom">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="panel panel-default xo">
			
			
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
					
					
                <div class="panel-heading text-warning">
				    Shop PayPal <span class="small text-danger">*</span> 
				</div>

                  <div class="panel-body shop">
				      <!-------------------- Progress Status Icons by component ----------------->
	                  <!--display shop timeline progress via Helper => Progress Status Icons-->
	                  {!! \App\Http\MyHelpers\ShopSimple\ShopTimelineProgress2::showProgress2("Shop") !!}
	                  <!--------------  END  Progress Status Icons by component ----------------->
				  </div> <!-- end .shop -->
				    
					
			
					
                
            </div> <!-- end .panel-default xo -->
        </div>
    </div>
</div> <!-- end . animate-bottom -->

<!-- Include js/css file for this view only -->
<script src="{{ asset('js/ShopPaypalSimple/shopSimple.js')}}"></script>
<link href="{{ asset('css/ShopPaypalSimple/shopSimple.css') }}" rel="stylesheet">
<link href="{{ asset('css/ShopPaypalSimple/shopSimple_Loader.css') }}" rel="stylesheet">
<!-- Include js file for thisview only -->


@endsection
