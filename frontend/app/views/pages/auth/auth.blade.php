@extends('layouts.default')
@section('content')
	<div class="wrapper clearfix">
			<div class="content">
				<div class='row' >
					<div class='col-md-4' style="float:none; margin:0 auto;">
						<div align="left">
							<h1>Login</h1>
							{{ Form::open(array('url' => 'auth/login', 'class' => '  center-block')) }}

							<!-- if there are login errors, show them here -->
							<p>
							    {{ $errors->first('email') }}
							    {{ $errors->first('password') }}
							    {{ $errors->first('custom') }}
							</p>

							<div class="form-group">
							    {{ Form::label('email', 'Email Address') }}
							    {{ Form::text('email', Input::old('email'), array('placeholder' => 'youremail@example.com', 'class' => 'form-control')) }}
							</div>
							<div class="form-group">
							    {{ Form::label('password', 'Password') }}
							    {{ Form::password('password', array('class' => 'form-control') ) }}
							</div>

							<div class="form-group">
								{{ Form::submit('Login', array( 'class' => ' btn btn-primary') ) }}
								
							</div>
							<div class="form-group">
								{{ link_to('auth/register', 'Register', array('class' => ' btn btn-link'), null) }}
								{{ link_to('password/remind', 'Forgot Password', array('class' => ' btn btn-link'), null) }}
							</div>

							{{ Form::close() }}
						</div>
					</div>
				</div>
			</div><!--content-->
	</div><!--wrapper clearfix-->
@stop