@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
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
                            <li> {{ $error }} </li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                <!-- End Display form validation errors var 2 -->		
                
						
						
						
                <div class="panel-heading text-warning">
                    <h3>
                        <i class="fa fa-recycle" style="font-size:36px"></i>  
                        SQL _where_having difference <span class="small text-danger">*</span>
						<p>Uses queries to Db table <b> {shop_simple} </b> </p>
                    </h3>
                    <p></p> 
                    <p></p>                  
                </div>


                <div class="panel-body">
				    
			
           
                
				
				
				
                
				    <!--------------- Simpe Eloquent Where Statement ---------------->
					<div class="col-sm-12 col-xs-12"></br>
					    <p><b> Simpe Eloquent Where </b></p>
					    @foreach($findModel as $product)
						    <p> {{$product->shop_title}} </p>
						@endforeach
					    
					</div> 
                    <!------------ End Simpe Eloquent Where Statement ------------------->					


                    
					
					
				    <!--------------- Sql Having section ------------------->
					<div class="col-sm-12 col-xs-12"></br>
					    <p><b> Sql Having section </b></p>
						
					    @foreach($findModel2 as $product)
						    <p> {{$product->shop_title}}  {{$product->shop_price}}$ </p>
						@endforeach
					    
					</div> 
                    <!------------ End Sql Having section ------------------->

                    
					
					
					 <!--------------- Sql Having SUM by category + hasOne relation ------------------->
					<div class="col-sm-12 col-xs-12"></br>
					    <p><b> Sql Having SUM by category + hasOne relation </b></p>
						<p> Shows all categories with overall sum price of each category product price </p>
					    @foreach($findModel3 as $product)
						    
						    <p> Category {{$product->productCategoryX}} =>         <!-- i.e 1,2 --> <!-- can also us $product->shop_categ-->
							             {{$product->categoryName->categ_name}} =>  <!-- hasOne relation i.e Desktop --> 
										 {{$product->shop_categ}}  {{$product->total_category_price}}$ 
							</p>
						@endforeach
					    
					</div> 
                    <!------------ End Sql Having SUM by category------------------->
					
				








					
                </div>
				
            </div>
        </div>
    </div>
</div>


<script>

</script>

@endsection
