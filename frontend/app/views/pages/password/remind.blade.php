@extends('layouts.default')
@section('content')
	<div class="wrapper clearfix">
			<div class="content">
				<div class='row' >
					<div class='col-md-4' style="float:none; margin:0 auto;">
						<div align="left">
							{{-- print_r(Session::all(), true) --}}
							<h1>Password Recovery</h1>
							<p>{{ $errors->first('email') }}</p>
							<p>{{ $errors->first('error') }}</p>
							@if (Session::has('error'))
							  	{{ trans(Session::get('reason')) }}
							@elseif (Session::has('success'))
							  	{{Session::get('success') }}
							@endif

							<form class="center-block" action="{{ action('RemindersController@postRemind') }}" method="POST">
							    <div class="form-group">
								    <label for="email">Email address</label>
								    {{ Form::text('email', Input::old('email'), array('placeholder' => 'youremail@example.com', 'class' => 'form-control')) }}
								</div>
								<div class="form-group">
							    	<button type="submit" class="btn btn-primary">Submit</button>
							    </div>
							    <div class="form-group">
									{{ link_to('password/reset', 'Already have the auth code', array('class' => ' btn btn-link'), null) }}
									{{ link_to('auth/login', 'Back to login page', array('class' => ' btn btn-link'), null) }}
								</div>
							</form>
						</div>
					</div>
				</div>
			</div><!--content-->
	</div><!--wrapper clearfix-->
@stop