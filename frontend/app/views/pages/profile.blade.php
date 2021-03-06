@extends('layouts.default')
@section('content')
	<div class="wrapper clearfix">
		<div class="content">
			<div class='row' >
				<div class='col-md-4' style="float:none; margin:0 auto;">
					<div align="left">
						<h2>My Profile</h2>
						{{ Form::open(array('url' => 'profile/edit', 'class' => '  center-block')) }}

							<!-- if there are login errors, show them here -->
							@if($errors->any())
							  <ul>
							    {{-- 
							    	preg_replace(
							    			'/settings\[(\w+)\]/', 
							    			'$1' , 
							    			implode('', $errors->all( '<li>:message</li>' ) )
							     	)
							     --}}
							     {{implode('', $errors->all( '<li>:message</li>')) }}
							  </ul>
							 <hr/>
							@endif

							
							<div class="form-group">
							    {{ Form::label('', 'Email Address: ' . $user->email) }}
							    <br/>
							    {{ Form::label('', 'Username: ' . $user->username) }}
							</div>

							<div class="form-group">
							    {{ Form::label('firstname', 'Firstname') }}
							    {{ Form::text('firstname', $user->first_name, 
							    	array('placeholder' => 'Your First Name', 
							    			'class' => 'form-control',
							    			$disabled )) }}
							</div>
							<div class="form-group">
							    {{ Form::label('lastname', 'Lastname') }}
							    {{ Form::text('lastname', $user->last_name, 
							    	array('placeholder' => 'Your Last Name', 
							    			'class' => 'form-control',
							    			$disabled )) }}
							</div>
							@foreach ($user->settings as $key => $value)
								<div class="form-group">
								    {{ Form::label("$key", ucfirst($key)) }}
								    {{ Form::text( "$key", $value, 
								    	array('placeholder' => ucwords($key), 
								    			'class' => 'form-control',
								    			$disabled )) }}
								</div>
								
							@endforeach

							<div class="form-group">
							    {{ Form::label('', 'All fields are required.') }}
							</div>
							@if ($edit)
								<div class="form-group">
									{{ Form::submit('Save', array( 'class' => ' btn btn-primary') ) }}
									{{ link_to('profile', 'Cancel', array('class' => ' btn btn-link'), null) }}
									
								</div>
							@else
								<div class="form-group">
									{{ link_to('profile/edit', 'Edit', array('class' => ' btn btn-link'), null) }}
									
								</div>
							@endif
							

							{{ Form::close() }}

					</div>
				</div><!--col-md-4-->
			</div><!--row-->
		


		</div><!--content-->
	</div><!--wrapper clearfix-->
@stop
