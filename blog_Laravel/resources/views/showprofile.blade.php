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
					
					<i class="fa fa-address-card-o" style="font-size:48px;color:red; padding:0.1em; margin:0.1em 0em; border:1px solid red;"></i>

					<p> ID:    {{ $id}}</p>
					
					<p> Name:  {{ $name}} </p>
					
					<p> Email: {{ $email}}</p>
					
					{{-- Auth::user()->name --}}
					{{-- Auth::user()->name --}}
					</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
