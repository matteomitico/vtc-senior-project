@extends('layouts.default')
@section('content')
	<div class="wrapper clearfix">
			<div class="content">
				<div class='row' >
					<div class='col-md-4' style="float:none; margin:0 auto;">
						<div align="left">
							<h1>Password Recovery</h1>
							<p>{{ $errors->first('email') }}</p>
							<p>{{ $errors->first('password') }}</p>
							<p>{{ $errors->first('password_confirmation') }}</p>
							<p>{{ $errors->first('token') }}</p>
							<p>{{ $errors->first('error') }}</p>

							<form class="center-block" action="{{ action('RemindersController@postReset') }}" method="POST">
							    
							    <div class="form-group">
								    <label for="email">Email address</label>
								    {{Form::email('email',Input::old('email'), array(
								    						'class' => "form-control",
								    						'placeholder' => "youremail@example.com"
								    					) )}} 
								</div> 

								<div class="form-group">
								    <label for="password">New Password</label>
								    <input type="password" class="form-control" id="password" name="password">
								</div>
								<div class="form-group">
								    <label for="password">New Password Again</label>
								    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
								</div>
								<div class="form-group">
									<label for="password">Auth Token</label>
								    {{ Form::text('token', $token,
								     array('class' => "form-control") ) }}
								</div>

								<div class="form-group">
							    	<button type="submit" class="btn btn-primary">Submit</button>
							    </div>
							    <div class="form-group">
									{{ link_to('auth/login', 'Back to login page', array('class' => ' btn btn-link'), null) }}
								</div>
							</form>
						</div>
					</div>
				</div>
			</div><!--content-->
	</div><!--wrapper clearfix-->
@stop