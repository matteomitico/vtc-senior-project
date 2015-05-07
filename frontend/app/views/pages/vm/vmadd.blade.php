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
							<h1>Add New VM</h1>
							 
							{{ Form::open(array('route' => 'vm.add.process')) }}
							 
							<div class="form-group">
							 	{{ Form::label('vmType', 'Type:') }}
							  	{{ Form::select('vmType', $vmTypes, Input::old('vmType'), array('class' => 'form-control') )}}
							</div>
							
							<div class="form-group">
							 	{{ Form::label('vmName', 'VM Name') . ':  ' . Auth::user()->username . '-'}}
							  	{{Form::text('vmName' , Input::old('vmName'), array('placeholder' => 'VM Name', 'class' => 'form-control')) }}
							</div>

							 <div class="form-group">
								{{ Form::submit('Create VM', array( 'class' => ' btn btn-primary') ) }}
							</div>

							<div class="form-group">
								{{ link_to('vm/show', 'Cancel', array('class' => ' btn btn-primary'), null) }}
							</div>
							 
							{{ Form::close() }}
						</div>
					</div>
				</div><!--'row' -->
			</div><!--content-->
	</div><!--wrapper clearfix-->

@stop
