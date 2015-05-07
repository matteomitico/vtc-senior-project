@extends('layouts.default')
@section('content')
// this went to password/remind.blad.php delete this if you don't need it
	<div class="wrapper clearfix">
			<div class="content">
				print_r(Session::all());
				@if (Session::has('error'))
				  	{{ trans(Session::get('reason')) }}
				@elseif (Session::has('success'))
				  	 {{Input::('email')}
				@endif
				 
				{{ Form::open(array('route' => 'password.request')) }}
				 
				  <p>{{ Form::label('email', 'Email') }}
				  {{ Form::text('email', Input::old('email'), array('placeholder' => 'youremail@example.com', 'class' => 'form-control')) }}
				</p>
				 
				  <p>{{ Form::submit('Submit') }}</p>
				 
				{{ Form::close() }}
			</div><!--content-->
	</div><!--wrapper clearfix-->
@stop