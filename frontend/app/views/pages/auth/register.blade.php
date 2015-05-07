@extends('layouts.default')
@section('content')
	<div class="wrapper clearfix">
			<div class="content">
				<div class='row' >
					<div class='col-md-4' style="float:none; margin:0 auto;">
						<div align="left">
							@if($errors->any())
							  <ul>
							    {{ implode('', $errors->all('<li>:message</li>'))}}
							  </ul>
							@endif
							<h1>Register</h1>
							 
							{{ Form::open(array('route' => 'auth.register.store')) }}
							 
							<div class="form-group">
							 	{{ Form::label('firstname', 'Firstname') }}
							  	{{ Form::text('firstname' , Input::old('firstname'), array('placeholder' => 'Firstname', 'class' => 'form-control')) }}
							</div>
							
							<div class="form-group">
							 	{{ Form::label('lastname', 'Lastname') }}
							  	{{ Form::text('lastname' , Input::old('lasttname'), array('placeholder' => 'Lastname', 'class' => 'form-control')) }}
							</div>

							<div class="form-group">
							 	{{ Form::label('username', 'Username') }}
							  	{{ Form::text('username' , Input::old('username'), array('placeholder' => 'Username', 'class' => 'form-control')) }}
							</div>

							 
							 <div class="form-group">
							  	{{ Form::label('email', 'Email') }}
							  	{{ Form::text('email', Input::old('email'), array('placeholder' => 'youremail@example.com', 'class' => 'form-control')) }}
							 </div>
							 
							 <div class="form-group">
							  	{{ Form::label('password', 'Password') }}
							  	{{ Form::password('password',array('class' => 'form-control')) }}
							 </div>
							 
							 <div class="form-group">
							  	{{ Form::label('password_confirmation', 'Password confirm') }}
							  	{{ Form::password('password_confirmation',array( 'class' => 'form-control')) }}
							 </div>
							 
							 <div class="form-group">
								{{ Form::submit('Register', array( 'class' => ' btn btn-primary') ) }}
							</div>

							<div class="form-group">
								{{ link_to('auth/login', 'Back to login page', array('class' => ' btn btn-link'), null) }}
							</div>
							 
							{{ Form::close() }}
						</div>
					</div>
				</div>
			</div><!--content-->
	</div><!--wrapper clearfix-->
@stop